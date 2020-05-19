<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Group::create([
    		'id' =>'1',
    		'name' =>'Operating System',
    		'description' =>''
    	]);
    	App\Models\Group::create([
    		'id' =>'2',
    		'name' =>'Program Language',
    		'description' =>''
    	]);
    	App\Models\Group::create([
    		'id' =>'3',
    		'name' =>'Database',
    		'description' =>''
    	]);
    }
}
