<?php 
namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillService{

	public function getInfoSkills()
	{
		return Skill::select('id', 'name')->get();
	}
}

?>