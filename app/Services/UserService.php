<?php

namespace App\Services;

use App\Models\User;

/**
 * 
 */
 class UserService
 {
 	public function getInfoUsers()
	{

		return User::select('id', 'first_name', 'last_name')->get();
	}
 }


