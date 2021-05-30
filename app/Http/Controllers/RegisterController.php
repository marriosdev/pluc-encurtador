<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(User $user, Request $request)
    {
        $nameErro = ""; $passErro=""; $emailErro="";

        $save = true; //Variável verificadora

        $user->created_at = Date("h:m:s Y/m/d");
        $user->updated_at = Date("h:m:s Y/m/d");
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->where("email", "=", $request->email)->first()){
            $emailErro = "Email já existente";
            $save = false;
        }
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $emailErro = "Email inválido";
            $save = false;
        }
        if($request->password != $request->password_confirmation or $request->password == ""){
            $passErro = "As senhas não coincidem";
            $save = false;
        }
        if(!preg_match('|^[\pL\s]+$|u', $request->name)){
            $nameErro = "Nome iválido";
            $save = false;
        }
        if($save){
            $user->save();        
            $user = $request->user();
            return redirect("login");
        }
        else{
            return redirect("register")->with(["email"=>$request->email, "name"=>$request->name, "erroEmail"=>$emailErro, "erroName"=>$nameErro, "passErro"=>$passErro]);
        }
    }
}
