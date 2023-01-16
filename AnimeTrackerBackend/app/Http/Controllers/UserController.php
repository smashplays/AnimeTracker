<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use PDOException;


class UserController extends Controller
{
    public function getAll(Request $request)
    {

        try {
            return User::all();
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }


    public function getById(Request $request, $id)
    {


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
                'age' => 'required|integer',
                'password' => 'required|string',
                'email' => 'required|email:rfc|unique:users',
                'rol_id' => 'nullable|integer'
            ]));
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
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
                return response('Id no encontrada', 404);
            }
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }


    public function rol(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json($user->rol);
    }


    public function calendar(Request $request, $id)
    {
        $user = User::find($id);
        return response()->json($user->calendar);
    }
}
