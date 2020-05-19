<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSkillUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_skill_ups', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('skill_id');
            $table->integer('skill_level_id');
            $table->date('level_up_at');
            $table->integer('update_by_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_skill_ups');
    }
}
