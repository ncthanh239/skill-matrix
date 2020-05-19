<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkillUp extends Model
{
    protected $fillable = ['id', 'user_id', 'skill_id', 'skill_level_id', 'level_up_at', 'update_by_user'];
}