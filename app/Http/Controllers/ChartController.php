<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Services\SkillService;
use App\Services\UserSkillService;

class ChartController extends Controller
{
	public function __construct(UserService $userService, SkillService $skillService,
		UserSkillService $userSkillService )
	{
		$this->userService = $userService;
		$this->skillService = $skillService;
		$this->userSkillService = $userSkillService;
	}

	public function viewChart()
	{
		$dataUser = $this->userService->getInfoUsers();
		$dataSkill = $this->skillService->getInfoSkills();
		if($dataUser->count() != 0 && $dataSkill->count() != 0) {
			return view('pages.chart', ['dataSkill' => $dataSkill, 'dataUser' => $dataUser]);
		}else {
			echo __('msg.nulldata');
		}
	}

	public function showChart(Request $req)
	{
		return response()->json($this->userSkillService->getDataChart($req));
	}

	public function getUserId($id)
	{
		$dataUser = $this->userService->getInfoUsers();
		$dataSkill = $this->skillService->getInfoSkills();
		if($dataUser->count() != 0 && $dataSkill->count() != 0) {
			return view('pages.chart', ['dataSkill' => $dataSkill, 'dataUser' => $dataUser, 'id' => $id]);
		}else {
			echo __('msg.nulldata');
		}
	}
}