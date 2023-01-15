<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PDOException;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        //return DB::table('students')->get();
        //$students = 
        try {
            return User::all();
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }


    public function getById(Request $request, $id)
    {
        //return DB::table('students')->where('id',$id)->get();

        try {
            if (User::find($id)) {
                return User::findOrFail($id);
            } else {
                return response('Id no encontrada', 404);
            }
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }


    public function delete(Request $request, $id)
    {

        try {
            if (User::find($id)) {

                User::findOrFail($id)->delete();
                return response('Ha sido eliminado', 200);
                //return $student->delete();
            } else {
                return response('Id no encontrada', 404);
            }
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }

    public function post(Request $request)
    {
        try {
            User::create($request->validate([
                'name' => 'required|string',
                'age'=> 'required|integer',
                'password' => 'required|string',
                'email' => 'required|string|unique:users'
            ]));
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
        //return Student::upsetOrCreate();
    }

    public function update(Request $request, $id)
    {

        try {
            if (User::find($id)) {

                User::findOrFail($id)->update($request->validate([
                    'name' => 'nullable|string',
                    'age' => 'nullable|integer',
                    'password' => 'nullable|string',
                    'email' => 'nullable|string|unique:users',
                   
                ]));
            } else {
                return response('Id no encontrada', 404);
            }
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }
}
