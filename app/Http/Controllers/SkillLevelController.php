<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\SkillLevelService;
use Illuminate\Http\Request;


class SkillLevelController extends Controller
{

	public function __construct(SkillLevelService $skillLevelService)
	{
		$this->skillLevelService = $skillLevelService;
	}

	public function index()
	{
		$skillLevels = $this->skillLevelService->all();
		return view("pages.level", ['skill_levels'=>$skillLevels]);
	}

	public function viewadd(Request $request)
	{
		$skillLevels = $this->skillLevelService->getAllLevel();
		return view('levelskill.addLevel')->with(compact('skillLevels'));
	}	

	public function addLevel(Request $req)
	{
		if ($this->skillLevelService->createSkillLevel($req)) {
			return redirect()->route('level');
		}
		else{
			return view('404');
		}
	}
	
	public function viewedit($id)
	{
		$skillLevels = $this->skillLevelService->getLevelById($id);
		return view('levelskill.editLevel')->with(compact('skillLevels'));
	}
	

	public function editLevel(Request $req, $id)
	{
		
		$this->skillLevelService->updateSkillLevel($req, $id);
		return redirect()->route('level');
		
	}

	public function delete($id)
	{
		$this->skillLevelService->delLevelById($id);
		return redirect()->route('level');
	}
}