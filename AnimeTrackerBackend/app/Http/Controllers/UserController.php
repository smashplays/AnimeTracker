<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;


class UserController extends Controller
{
    public function getAll(Request $request)
    {

        try {
            $users= User::all();

            $response = [
                'success' => true,
                'message' => "User Of Calendar obtained successfully",
                'data' => $users
            ];

            return response($response,200);


        } catch (PDOException $ex) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];
            return response($response, 500);
        }
    }


    public function getById(Request $request, $id)
    {


        try {
            if (User::find($id)) {
                $user= User::findOrFail($id);



                $response = [
                    'success' => true,
                    'message' => "User Of Calendar obtained successfully",
                    'data' => $user
                ];
    
                return response($response,200);

            } else {
                
                $response = [
                    'success' => false,
                    'message' => "User Not Found",
                    'data' => null
                ];

                return response($response, 404);
            }
        } catch (PDOException $ex) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];
            return response($response, 500);
        }
    }


    public function delete(Request $request, $id)
    {

        try {
            if (User::find($id)) {

                User::findOrFail($id)->delete();
                return response('Ha sido eliminado', 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "User Not Found",
                    'data' => null
                ];

                return response($response, 404);
              
            }
        } catch (PDOException $ex) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];

            return response($response, 500);
            
        }
    }

    public function post(Request $request)
    {
        try {
                User::create($request->validate([
                'name' => 'required|string',
                'age' => 'required|integer',
                'password' => 'required|string',
                'email' => 'required|email:rfc|unique:users',
                'rol_id' => 'nullable|integer'
            ]));
            $response = [
                'success' => true,
                'message' => "User Created",
                'data' => User::find(DB::getPdo()->lastInsertId())
            ];
        } catch (PDOException $ex) {
            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];

            return response($response, 500);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            if (User::find($id)) {

                User::findOrFail($id)->update($request->validate([
                    'name' => 'nullable|string',
                    'age' => 'nullable|integer',
                    'password' => 'nullable|string',
                    'email' => 'nullable||email:rfc|unique:users',
                    'rol_id' => 'nullable|integer'
                ]));
            } else {
                $response = [
                    'success' => false,
                    'message' => "User Not Found",
                    'data' => null
                ];

                return response($response, 404);
            }
        } catch (PDOException $ex) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];

            return response($response, 500);
        }
    }


    


    public function calendar(Request $request, $id)
    {

        if (!User::find($id)) {
            return response('ERROR: Id not found', 404);
        }
        

        $response = [
            'success' => true,
            'message' => "User Of Calendar obtained successfully",
            'data' => User::find($id)->calendar
        ];

        return response($response,200);
    }
}
