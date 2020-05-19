<?php
namespace App\Services;
use App\Models\UserSkill;
use App\Models\User;
use App\Models\Skill;
use App\Models\SkillLevel;
use App\Models\UserSkillUp;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
/**
*
*/
class UserSkillService
{
	const QUARTER1 = "Q1";
	const QUARTER2 = "Q2";
	const QUARTER3 = "Q3";
	const QUARTER4 = "Q4";
	const active = 1;
	const ZERO = 0;

	public function getDataChart($req)
	{
		//get request from client
		$userId = $req->id;
		$skills = array();
		if ($req->arrSkill == null) {
			$temps = Skill::select('id')->get();
			foreach ($temps as $temp) {
				array_push($skills, $temp->id);
			}
		} else {
			$skills = $req->arrSkill;
		}
		$priorities = array();
		if ($req->arrPriority != null) {	
			$priorities = $req->arrPriority;
			//update "display_No" for each skill in array
			$this->updatePriority($skills, $priorities);
		}
		$startDate = $req->startDate;
		$endDate = $req->endDate;	
		//get data user skill return view
		return $this->getDataUserSkill($userId, $skills, $startDate, $endDate);
	}
	public function updatePriority($arrSkills, $arrPriorities)
	{
		$skills = Skill::whereIn('id', $arrSkills)->get();
		for ($i = 0; $i < count($arrPriorities) ; $i++) {
			if ($arrPriorities[$i] != self::ZERO) {
				$skills[$i]->display_No = $arrPriorities[$i];
				$skills[$i]->save();
			}
		}
	}
	public function getDataUserSkill($userId, $arrSkills, $startDate, $endDate)
	{
		$data = array();
		$rows = UserSkill::join('skills', 'user_skills.skill_id', '=', 'skills.id')
		->where('user_skills.user_id', $userId)->orderBy('skills.display_No', 'asc')->get();
		foreach ($rows as $value) {
			foreach ($arrSkills as $skill) {
				if ($value->skill_id == $skill) {
					//create element to add $data
					$record = $this->getObjSkillLevel($value->skill_level_id, $value->name);
					if ($record) {
						$record['timerange'] = $this->getTimeRange($userId, $value->skill_id, $startDate, $endDate);
						array_push($data, $record);
					}
				}
			}
		}
		return $data;
	}
	public function getObjSkillLevel($levelId, $skillName)
	{
		$levelNumber = SkillLevel::where('id', $levelId)->value('level_number');
		if ($levelNumber > self::ZERO) {
			$record = array();
			$record['skill_name'] = $skillName;
			$record['skill_level'] = $levelNumber;
			return $record;
		} else {
			return null;
		}
	}
	public function getTimeRange($userId, $skillId, $startDate, $endDate)
	{
		$timeUps = UserSkillUp::where('user_id', $userId)->where('skill_id', $skillId)->where('level_up_at', '>', $startDate)
		->where('level_up_at', '<=', $endDate)->orderBy('level_up_at', 'asc')->get('level_up_at');
		if (count($timeUps) != self::ZERO) {
			$timeRange = array();
			foreach ($timeUps as $timeUp) {
				array_push($timeRange, $timeUp->level_up_at);
			}
			$start = new Carbon($startDate);
			$end = new Carbon($endDate);
			//add limit time
			array_push($timeRange, $end->addMonths(1)->toDateString());
			// update $end again
			$end = $end->subMonths(1);
			$data = $this->getLevelDate($start, $end->addDay(), $timeRange);
			// get drilldown skill time range data
			return $this->getDrilldownData($data);
		} else {
			return null;
		}
	}
	public function getLevelDate($startDate, $endDate, $arrDate)
	{
		$data = array();
		$index = 0;
		$levelNumber;
		while ($startDate <= $endDate) {
			if ($startDate->month == Carbon::create($arrDate[$index])->month 
				&& $startDate->day == Carbon::create($arrDate[$index])->day
				&& $startDate->year == Carbon::create($arrDate[$index])->year) {
				//update next $index value
				$index ++;
		} else {
				//get old level skill value
			if ($index == self::ZERO) {
				$levelNumber = $this->getLevelOffset($startDate);
			} else {
				$levelNumber = $this->getLevelNumberByDate($arrDate[$index-1]);
			}
		}
		array_push($data, [
			"month" => $startDate->month,
			"year" => $startDate->year,
			"level_number" => $levelNumber
		]);
		$startDate->addDay();
	}
	return $data;
}
public function getLevelNumberByDate($date)
{
	$levelId = UserSkillUp::where('level_up_at', $date)->value('skill_level_id');
	return SkillLevel::where('id', $levelId)->value('level_number');
}
		//get skill level before start date
public function getLevelOffset($startDate)
{
	$value = UserSkillUp::where('level_up_at', '<', $startDate)
	->orderBy('level_up_at', 'desc')->value('level_up_at');
	if ($value == null) {
		return self::ZERO;
	} else {
		return $this->getLevelNumberByDate($value);
	}
}
public function getDrilldownData($data)
{
	$drilldown = array();
	$index = -1;
	foreach ($data as $value) {
		$quarter = $this->getQuarter($value['month']);
		$this->addItem($drilldown, $index, $quarter."/".$value['year'], $value['level_number']);
	}
	return $drilldown;
}
public function getQuarter($month)
{
	if ($month == 1 || $month == 2 || $month == 3) {
		return self::QUARTER1;
	}
	if ($month == 4 || $month == 5 || $month == 6) {
		return self::QUARTER2;
	}
	if ($month == 7 || $month == 8 || $month == 9) {
		return self::QUARTER3;
	}
	if ($month == 10 || $month == 11 || $month == 12) {
		return self::QUARTER4;
	}
}
public function addItem(&$drilldown, &$index, $quarter, $levelNumber)
{
	if($drilldown == null || $drilldown[$index]['quarter'] != $quarter) {
		$index++;
	} else {
		if ($drilldown[$index]['value'] <= $levelNumber) {
			array_pop($drilldown);
		}
	}
	array_push($drilldown, [
		"quarter" => $quarter,
		"value" => $levelNumber
	]);
}
	/**
	* [getListUserSkill description]
	* @return [type] [return user skill list]
	* add info columns to return user skill list
	*/
	public function listUserSkill(){
		$dataUserSkills = DB::table('user_skills')->join('skills', 'user_skills.skill_id', '=', 'skills.id')->join('users', 'user_skills.user_id', '=', 'users.id')->join('skill_levels', 'user_skills.skill_level_id', '=', 'skill_levels.id')->select( 'user_skills.id','user_skills.user_id','user_skills.skill_id', 'user_skills.skill_level_id', 'skills.name as skill', 'users.first_name', 'users.last_name', 'skill_levels.level_number','skill_levels.color')->where('skills.active', '=', self::active)->get();
		if($dataUserSkills != null){
			$userNull = $this->getUserNull();
			$array = json_decode(json_encode($dataUserSkills), true);
			$userSkill = $this->getArraySkill($array);
			return $this->dataUserSkill(array_merge($userSkill, $userNull));
		}
		else{
			return null;
		}
	}
	public function getArraySkill($userSkill){
		$skillID = Skill::select('id')->where('active', self::active)->get();
		$skillId = array();
		if($skillID){
			foreach ($skillID as $key1 => $value1) {
				$skillId[$key1] = $value1->id;
			}
			foreach ($userSkill as $key => $value) {
				$userSkill[$key]['skillId'] = $skillId;
			}
			return $userSkill;
		}else{
			return null;
		}
	}
	public function getIdSkill(){
		$skillID = Skill::select('id')->where('active', self::active)->get();
		$skillId = array();
		if($skillID!=null){
			foreach ($skillID as $key1 => $value1) {
				$skillId[$key1] = $value1->id;
			}
			return $skillId;
		}
		else{
			return null;
		}

	}
	public function getUserNull(){
		$userId = DB::table('users')->leftJoin('user_skills', 'users.id', '=', 'user_skills.user_id')->whereNull('user_skills.user_id')
		->get([
			'users.id',
			'users.first_name',
			'users.last_name',
		]);
		if($userId){
			$array = json_decode(json_encode($userId), true);
			$data = array();
			foreach ($array as $key => $value){
				$data[$key]['user_id'] = $value['id'];
				$data[$key]['first_name'] = $value['first_name'];
				$data[$key]['last_name'] = $value['last_name'];
				$data[$key]['skill_level_id'] = '';
				$data[$key]['skill'] = '';
				$data[$key]['level_number'] = '';
				$data[$key]['color'] = '';
				$data[$key]['skillId'] = $this->getIdSkill();
				$data[$key]['skill_id'] = '';
			}
			return $data;
		}
		else{
			return null;
		}	
	}
	public function getSkill(){
		return Skill::where('active',self::active)->get();
	}
	public function getLevel(){
		return SkillLevel::all();
	}
	public function addLevelSkill($param){
		$updateByUser = 0;
		$data = array();
		$data['user_id'] = $param->userId;
		$data['skill_id'] = $param->skillId;
		$data['skill_level_id'] = $param->levelSkill;
		$data['level_up_at'] = $param->date;
		$data['update_by_user'] = $updateByUser;
		return UserSkillUp::create($data);
	}
	public function listSkillUp(){
		$defaultUser = null;
		$check = 0;
		$userSkillUp = DB::table('user_skill_ups')->join('users', 'user_skill_ups.user_id', '=', 'users.id')->join('skills', 'user_skill_ups.skill_id', '=', 'skills.id')->join('skill_levels', 'user_skill_ups.skill_level_id', '=', 'skill_levels.id')->select('users.id', 'users.first_name', 'users.last_name','skills.name as skill', 'skill_levels.level_number', 'user_skill_ups.level_up_at', 'user_skill_ups.update_by_user')->get();
		if($userSkillUp){
			$array = json_decode(json_encode($userSkillUp), true);
			$userUpdateId = array();
			$data = array();
			foreach ($array as $key => $value) {
				$data[$key]['id'] = $value['id'];
				$data[$key]['first_name'] = $value['first_name'];
				$data[$key]['last_name'] = $value['last_name'];
				$data[$key]['name'] = $data[$key]['last_name']." ".$data[$key]['first_name'];
				$data[$key]['skill'] = $value['skill'];
				$data[$key]['level'] = $value['level_number'];
				$data[$key]['level_up_at'] = $value['level_up_at'];
				if($value['update_by_user']==$check){
					$data[$key]['update_by'] = $defaultUser;
				}else{
					$data[$key]['update_by'] = $this->getUserName($value['update_by_user']);
				}
			}
			return $data;
		}
		else{
			return null;
		}
	}

	public function getUserName($id){
		$first = User::where('id', $id)->first()->first_name;
		$last = User::where('id',$id)->first()->last_name;
		return $first." ".$last;
	}
	public function updateLevelSkill($param){
		$data = array();
		$skillId = Skill::where('name', $param->skill)->first()->id;
		$skill_level_id = SkillLevel::where('level_number', $param->level)->first()->id;
		$data['user_id'] = $param->user_id;
		$data['skill_id'] = $skillId;
		$data['skill_level_id'] = $skill_level_id;
		$userSkill = UserSkill::where('user_id', $param->user_id)->where('skill_id', $skillId)->first();
		$userSkillUp = UserSkillUp::where('user_id', $param->user_id)->where('skill_id', $skillId)->where('skill_level_id', $skill_level_id)->first();
		if($userSkill){
			UserSkill::find($userSkill->id)->update($data);
		}else{
			UserSkill::create($data);
		}
		$userSkillUp->update_by_user = Auth::user()->id;
		$userSkillUp->save();
	}
	public function getSection(){
		return Section::all();
	}
	public function getSectionById($id){
		return Section::find($id);
	}
	public function filterBySection($id){
		$dataUserSkills = DB::table('user_skills')->join('skills', 'user_skills.skill_id', '=', 'skills.id')->join('users', 'user_skills.user_id', '=', 'users.id')->join('skill_levels', 'user_skills.skill_level_id', '=', 'skill_levels.id')->select( 'user_skills.id','user_skills.user_id','user_skills.skill_id', 'user_skills.skill_level_id', 'skills.name as skill', 'users.first_name', 'users.last_name', 'skill_levels.level_number','skill_levels.color')->where('skills.active', '=', self::active)->where('users.section_id', '=', $id)->get();
		if($dataUserSkills){
			$array = json_decode(json_encode($dataUserSkills), true);
			return $this->dataUserSkill($this->getArraySkill($array));	
		}
		else{
			return null;
		}
	}
	public function dataUserSkill($dataUsers){
		$data = array();
		$code = '00';
		$defaultSkill = '-';
		$defaultColor = '';
		foreach ($dataUsers as $key => $value) {
			$user = isset($data[$value['user_id']]) ? $data[$value['user_id']] : [];
			$user['id'] = $value['user_id'];
			$user['code'] = $code.$value['user_id'];
			$user['name'] = $value['last_name']." ".$value['first_name'];
			if($value['skill_level_id']==''){
				foreach($value['skillId'] as $key1 => $value1){
					$user['level'][$value1] = $defaultSkill;
					$user['color'][$value1] = $defaultColor;
				}
			}
			else{
				$user['level'][$value['skill_id']] = $value['level_number'];
				$user['color'][$value['skill_id']] = $value['color'];
				foreach($value['skillId'] as $key1 => $value1){
					if(isset($user['level'][$value1])){
						$user['level'][$value['skill_id']] = $value['level_number'];
					}
					else{
						$user['level'][$value1] = $defaultSkill;
					}
					if(isset($user['color'][$value1])){
						$user['color'][$value['skill_id']] = $value['color'];
					}
					else{
						$user['color'][$value1] = $defaultColor;
					}
				}
			}
			$data[$value['user_id']] = $user;
		}
		return $data;
	}
}
