<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDOException;

class LoginController extends Controller
{
    //

    public function login(Request $request)
    {
            $comprobar="";

        if (!Auth::guard('api')->check()){
           
            if ($request->has('name')){
                $comprobar='name';
            }
            else if ($request->has('email')){
                $comprobar='email';
            }
            
            $data = $request->validate([
                
                $comprobar => 'required | string',
                'password' => 'required | string',
                
            ]);
            
            if (Auth::attempt($data)) {

                $response = [
                    "success" => true,
                    "message" => "Logged",
                    "data" => Auth::user()->createToken("AuthToken")->accessToken,
                ];

                return response($response, 200);
            }
            else{

                $response = [
                    "success" => false,
                    "message" => "Failed password or user",
                    "data" => Auth::user()
                ];
                
    
                return response($response, 400);
                }
        }

            
         {
            $response = [
                "success" => false,
                "message" => "You have already logged",
                "data" => null
            ];


            return response($response, 200);
        }
    }


    public function logout(Request $request)
    {


        Auth::guard('api')->user()->tokens()->delete();


        $response = [
            "success" => true,
            "message" => "Logout",
            "data" => null
        ];


        return response($response, 200);
    }


    public function whoAmI(Request $request)
    {



        $response = [
            "success" => true,
            "message" => "User Info",
            "data" => Auth::guard('api')->user()
        ];


        return response($response, 200);
    }



    public function crearUser(Request $request)
    {
        try{

        

            $request->validate([
                'name' => "required | string",
                'email' => "required | email:rfc | unique:users",
                'password' => "required | string",
                'rpassword' => "required | same:password",
                'age' => "required | Integer",

            ]);


            User::create([
                "name"=> $request -> name,
                "email" => $request -> email,
                "password" => Hash::make($request -> password),
                "age" => $request -> age,
                "role" => "User"
            ]);


            $response=[
                "success" => true,
                "message" => "User Created",
                "data" => User::find(DB::getPdo()->lastInsertId())
            ];


            return response($response,201);
        }
        catch(PDOException $ex){
            return response($ex->errorInfo,500);
        }



    
    }
}
