<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{
    protected $fillable = ['id', 'level_number', 'description', 'color'];
}