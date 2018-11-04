<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\Model\Provider_Login;
use App\User;

class LoginApiController extends Controller
{  
   public function __construct(Provider_Login $provider,User $user)
   {
   		$this->provider = $provider;
         $this->user = $user;
   }
   public function redirectToProvider($serve)
   {
   	 return Socialite::driver($serve)->redirect();
   }

   public function handleProviderCallback($serve)
   {

	$user = Socialite::driver($serve)->user();

	$dataUser = $this->findOrCreate($serve,$user);

   Auth::login($dataUser);

   return redirect()->route('user-list');

   }
   /* To check user in provder_login table 
   *  Or create new user 
   */
   private function findOrCreate($serve,$user)
   {	 
         //get provider ;
   		$provider = $this->provider->findProviderId($user->id);
         //get user from database ; 
   		$userCreate = $this->user->findEmailOrId($user->email);

   		if($provider)
   		{   
   			return $userCreate;
   		}
         else
         {  
            

            $provider = new Provider_Login([
               'provider'     =>    $serve,
               'provider_id'  => $user->id
            ]);

            if(!$userCreate)
            {  
               $userCreate = $this->user->create([
                  'name'   => $user->name,
                  'email'  => $user->email,
                  'password'  =>$user->token,

               ]);
            }
            
            $provider->user()->associate($userCreate);
            $provider->save();

            return $userCreate;
         }
   		
   }
}
