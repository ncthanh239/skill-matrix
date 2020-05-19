<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\LoginService;
use Auth;

class AccountController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/userskill';

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function loginForm(){
        if(Auth::check()){
            return redirect('/userskill');
        }
        else{
            return view('welcome'); 
        }
    }

    public function getProvider($provider)
    {
        return $this->loginService->redirectToProvider($provider);
    }
    public function postLogin($provider)
    {
        $login = $this->loginService->handleProviderCallback($provider);
        if($login == false){
            return view('auth.login');
        }else{
            Auth::login($login,true);
            return redirect($this->redirectTo);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


}
