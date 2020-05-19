<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserSkillService;


class UserSkillController extends Controller
{
	public function __construct(UserSkillService $userSkillService)
	{
		$this->userSkillService = $userSkillService;
	}
	public function viewUserSkill(){
		$userSkills = $this->userSkillService->listUserSkill();
		$skills = $this->userSkillService->getSkill();
		$levels = $this->userSkillService->getLevel();
		$sections = $this->userSkillService->getSection();
		return view('userskill.userskill')->with(compact('skills'))->with(compact('userSkills'))->with(compact('levels'))->with(compact('sections'));
	}
	public function createLevelSkill(Request $request){
		return $this->userSkillService->addLevelSkill($request);
	}
	public function viewSkillUp(){
		$data = $this->userSkillService->listSkillUp();

		$levels = $this->userSkillService->getLevel();
		return view('userskill.skillup', ['data'=>$data],['levels'=>$levels]);
	}
	public function updateSkill(Request $request){
		return $this->userSkillService->updateLevelSkill($request);
	}

	public function showSection($id){
		$check = $this->userSkillService->getSectionById($id);
		if($check == null){
			return view('404');
		}else{
			$data = array();
			$data['userValues'] = $this->userSkillService->filterBySection($id);
			$data['skills'] = $this->userSkillService->getSkill();
			$data['levels'] = $this->userSkillService->getLevel();
			$data['sections'] = $this->userSkillService->getSection();
			return view('userskill.filter-section', $data);
		}
	}
}