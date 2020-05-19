<?php 
namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Socialite;

class LoginService
{
	public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
	public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $authUser = $this->findOrCreateUser($user,$provider);
        return $authUser;
    }

    public function findOrCreateUser($user, $provider){
    	$defaultSection = 1;
        $authUser = User::where("email", $user->email)->first();
        if($authUser){
            if($authUser->provider_id == $user->id){
            return $authUser;
            }
            else{
                return false;
            }
        }
        
        return User::create([
            'first_name'  => $user->user['given_name'],
            'last_name'   => $user->user['family_name'],
            'email'       => $user->email,
            'provider'    => strtoupper($provider),
            'provider_id' => $user->id,
            'avatar'      => $user->avatar,
            'section_id'  => $defaultSection
        ]);
    }
}
