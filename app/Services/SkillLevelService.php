<?php

namespace App\Services;

use App\Models\SkillLevel;
use DB;

/**
 * 
 */
class SkillLevelService
{
	public function all()
	{

		$skillLevels = DB::table('skill_levels')->select('skill_levels.id', 'skill_levels.level_number', 'skill_levels.description', 'skill_levels.color')->get();
		return $skillLevels;
	}

	public function createSkillLevel($req)
	{
		$dataLevel = array();
		$dataLevel['level_number'] = $req->input('inputLevelNumber');
		$dataLevel['description'] = $req->input('inputDescription');
		$dataLevel['color'] = $req->input('inputLevelColor');
		try{
			//create Skill Level
			$skillLevels = SkillLevel::create($dataLevel);
		}
		catch(Exception $e){
			return $e->getMessage();
		}
		return true;
	}		

	public function updateSkillLevel($req, $id)
	{
		$skillLevels = SkillLevel::find($id);
		if ($skillLevels != null) {
			$skillLevels->level_number = $req->input('inputLevelNumber');
			$skillLevels->description = $req->input('inputDescription');
			$skillLevels->color = $req->input('inputLevelColor');
			$skillLevels->update();
			return true;
		}
		else{
			return false;
		}
	}

	public function getAllLevel()
	{
		return SkillLevel::get();
	}

	public function getLevelById($id){
		if (SkillLevel::find($id) != null) {
			return SkillLevel::find($id);
		}
		else{
			return null;
		}
	}

	public function delLevelById($id)
	{
		try{
			SkillLevel::find($id)->delete();
		}
		catch(Exception $e){
			return $e->getMessage();
		}
		return true;
	}
}