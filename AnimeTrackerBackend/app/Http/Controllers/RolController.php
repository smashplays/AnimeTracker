<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use PDOException;

class RolController extends Controller
{
    //
    public function getAll(Request $request)
    {

        try {

            $roles= Rol::all();

            $response = [
                'success' => true,
                'message' => "Rols obtained successfully",
                'data' => $roles
            ];

            return response()->json($response);

        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }


    public function getById(Request $request, $id)
    {

        try {
            if (Rol::find($id)) {
                

                $rol= Rol::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Rol obtained successfully",
                    'data' => $rol
                ];
    
                return response()->json($response);


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
            if (Rol::find($id)) {

                Rol::findOrFail($id)->delete();
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
            Rol::create($request->validate([
                'name' => 'required|string',
                'descripcion' => 'required|string',
            ]));
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            if (Rol::find($id)) {

                Rol::findOrFail($id)->update($request->validate([
                    'name' => 'nullable|string',
                    'descripcion' => 'nullable|string',
                ]));
            } else {
                return response('Id no encontrada', 404);
            }
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }

    public function users(Request $request, $id)
    {

        if (!Rol::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        $rol = Rol::find($id);

        $response = [
            'success' => true,
            'message' => "Users of Rol obtained successfully",
            'data' => $rol->usuarios
        ];

        return response()->json($response);
    }
}
