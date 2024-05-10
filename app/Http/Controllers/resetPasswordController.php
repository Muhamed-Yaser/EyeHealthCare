<?php

namespace App\Http\Controllers;

use App\Mail\SendCodeResetPassword;
use App\Models\resetCodePassword;
use App\Models\User;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class resetPasswordController extends Controller
{
    use GeneralTrait;

    // Send code to Email
    public function send(Request $request){
        // check Email

           $validation = Validator::make($request->only('email'), [
                'email' => ['required', 'string', 'email','exists:users']
            ]);
            
            if($validation->fails()){
                
                return $this->returnValidationError(400 , $validation);
            }
            resetCodePassword::where("email" , $request->email)->delete();
    
            $code = mt_rand(100000,999999);
            
            $data = resetCodePassword::create([
                "email" => $request->email,
                'code' => $code
            ]);
    
            Mail::to($request->email)->send(new SendCodeResetPassword($data->code));
            
            return $this->returnSuccessMessage("Code has sent to email ." );
        
    }

    // check code
    public function checkCode(Request $request){
        $validation =validator::make($request->only('code') ,[
            'code' => 'required|string|exists:reset_code_passwords'
        ]);

        if($validation->fails()){
                return $this->returnValidationError(400 , $validation);
        }
        else{
            $passwordReset = resetCodePassword::where('code' , $request->code)->first();
        
        if($passwordReset->created_at < now()->addHour()){
            return $this->returnSuccessMessage("code is current.");
        }
        
            return $this->returnError(400,"the code is expire.");
        
        }
       
    }

    //reset password
    public function reset(Request $request){
        $validation =validator::make($request->all(),[
            'code' => 'required | string | exists:reset_code_passwords',
            'password' =>'required|string|min:6|confirmed'
        ]);
        if($validation->fails()){
            return $this->returnValidationError(400 , $validation);
        }else{
        
            $passwordReset = resetCodePassword::where('code' , $request->code)->first();
        
        if($passwordReset->created_at < now()->addHour()){
            

            $user = User::where('email' , $passwordReset->email)->first();
            $user -> update([
                'password' => bcrypt($request->password)
            ]);
            $passwordReset ->delete();
            return $this->returnSuccessMessage("Password has updated successfully");
        }
        
            return $this->returnError(400,"Code is expire.");
        }
       
    }
}
