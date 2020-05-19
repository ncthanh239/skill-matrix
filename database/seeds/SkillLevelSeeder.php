<?php

use Illuminate\Database\Seeder;

class SkillLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\SkillLevel::create([
    		'level_number' =>'-1',
    		'description' =>'Chưa biết, không có nhu cầu học',
    		'color' =>'#A59DBD'
    	]);
    	 App\Models\SkillLevel::create([
    		'level_number' =>'0',
    		'description' =>'Chưa biết, có thời gian sẽ học',
    		'color' =>'#8778AF'
    	]);
    	  App\Models\SkillLevel::create([
    		'level_number' =>'1',
    		'description' =>'Cần đào tạo thêm mới làm được',
    		'color' =>'#EA9999'
    	]);
    	   App\Models\SkillLevel::create([
    		'level_number' =>'2',
    		'description' =>'Có thể làm những task đơn giản',
    		'color' =>'#E06666'
    	]);
    	    App\Models\SkillLevel::create([
    		'level_number' =>'3',
    		'description' =>'Có thể làm được ngay',
    		'color' =>'#B6D7A8'
    	]);
    	     App\Models\SkillLevel::create([
    		'level_number' =>'4',
    		'description' =>'Có kinh nghiệm',
    		'color' =>'#7FB468'
    	]);
    	      App\Models\SkillLevel::create([
    		'level_number' =>'5',
    		'description' =>'Expert',
    		'color' =>'#83D1F4'
    	]);
    }
}
