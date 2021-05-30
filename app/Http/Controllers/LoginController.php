<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    function login(Request $request){
        
        $email = $request->email;
        $senha  = $request->password;

        if(Auth::attempt(['email'=>$email, 'password'=>$senha])){
            $user = $request->user();
            return redirect("dashboard");
        }else{
            return redirect("login")->with(["erro"=>"Email ou senha incorretos", "email"=>$email]);

        }
    }
}
