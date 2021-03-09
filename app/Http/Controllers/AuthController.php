<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
use App\User ;
use App\Traits\ApiResponser ;
use Laravel\Passport\Passport;


class AuthController extends Controller
{
    use ApiResponser ;
     //note:the used function from triat apiresponser
    public  function signup(Request $request){
        
        $attrr = $this->validateSignup($request);
  
     User::create([
       
        'name' => $attrr['name'],
        'email' => $attrr['email'],
        'password' => bcrypt($attrr['password']),
      //  'role_id' => $attrr['role_id'],
       // 'category_id' => $attrr['category_id'],
    ]);
    
      // check (user exist) if exists return true and create session user
    Auth::attempt(['email' => $attrr['email'], 'password' => $attrr['password']]);
     
    return $this->token($this->getPersonalAccessToken(),'created user',201);  

    }

    public function login (Request $request){
       
       $attrr = $this->validateLogin($request);

       
        if(Auth::attempt(['email' => $attrr['email'], 'password' => $attrr['password']])){

            return $this->token($this->getPersonalAccessToken());  
        }
            return $this->error('mismatch',401);

    }

    public function  user(){

        return $this->success(Auth::user());
    }

    public function logout (){
        Auth::user()->token()->revoke();
        return $this->success('loged out',200);
    }


    public function getPersonalAccessToken()
    {
        if (request()->remember_me === 'true'){
            //for determine livetime token
           // Passport::personalAccessTokensExpireIn(now()->addDays(15));
           //$u =Auth::user();
           //echo $u;
          // dd();
        return Auth::user()->createToken('Personal Access Token');
        }
    
    }










    protected function validateLogin ($request){
       return  $request->validate(
            ['email' => 'required|email|exists:users,email',
            'password' => 'required']  );
    }
    protected function validateSignup ($request){
        return  $request->validate(
            [
                'name'=> 'required',
                'email'=> 'required|email|unique:users',
                'password'=> 'required|min:6',
               // 'role_id'=> 'required',
               // 'category_id'=> 'required',
            ]
        );
     }

   


}
