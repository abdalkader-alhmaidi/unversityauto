<?php 
namespace App\Traits ;


use Carbon\Carbon ;


Trait ApiResponser {

protected function token($personlAccessToken,$message=null,$code=200){


    $tokenData = [

       'access_token' => $personlAccessToken->accessToken,
       'token_type' => 'Bearer',
       'expires_at' => Carbon::parse($personlAccessToken->token->expires_at)->toDateTimeString(),
       
    ];
    return $this->success($tokenData,$message,$code);
}

protected function success ($data,$message=null,$code=200){

    return response()->json(
        [
            'status'=> 'sucess',
            'message'=> $message,
            'data'=> $data,
        ], $code);



}

protected function erorr ($message =null , $code){
    return response()->json(
    [
        'status'=> 'erorr',
        'message'=> $message,
        'data'=> null,
    ], $code);
}


}