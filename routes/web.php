<?php

// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware grioup. Now create something great!
|
*/

Route::get('/test', function(){
	return view('levelskill.editLevel');
});

Route::get('/', function () {
	return view('welcome');
});

Route::get('/menu', function () {
	return view('layouts.master');
});


Route::get('level', 'SkillLevelController@index')->name('level');

// group route skill levels
Route::group(['prefix'=> 'level'], function() {

	//return view add skill levels
	Route::get('add', 'SkillLevelController@viewadd')->name('viewadd');
	//post value create skill levels
	Route::post('addLevel', 'SkillLevelController@addLevel')->name('addLevel');

	//return view edit skill levels
	Route::get('viewedit/{id}', 'SkillLevelController@viewedit');

	Route::post('editLevel/{id}', 'SkillLevelController@editLevel');

	Route::post('delete/{id}', 'SkillLevelController@delete');
});


Route::get('login', 'AccountController@loginForm')->name('login');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/', 'AccountController@loginForm');
Route::get('/login', 'AccountController@loginForm')->name('login');
Route::get('auth/{provider}', 'AccountController@getProvider');
Route::get('auth/{provider}/callback', 'AccountController@postLogin');
Route::get('/logout','AccountController@logout')->name('logout');
Route::group(['middleware'=>'auth'], function(){

	Route::group(['prefix' => 'userskill'], function() {
		Route::get('/', 'UserSkillController@viewUserSkill');
		Route::post('/addLevel', 'UserSkillController@createLevelSkill');
		Route::post('/updateSkill', 'UserSkillController@updateSkill');
		Route::get('/section/{id}', 'UserSkillController@showSection');
	});
	//userskillup
	Route::get('userskillup', 'UserSkillController@viewSkillUp');
	//chart
	Route::group(['prefix' => 'chart'], function() {
		Route::get('/', 'ChartController@viewChart')->name('chart');
		Route::get('/display', 'ChartController@showChart');
		Route::get('/Id/{id}', 'ChartController@getUserId');
	});
});