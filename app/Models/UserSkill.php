<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{	
	protected $table = 'user_skills';
    protected $fillable = ['id', 'user_id', 'skill_id', 'skill_level_id'];
}