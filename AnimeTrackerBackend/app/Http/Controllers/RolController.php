<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use PDOException;

class RolController extends Controller
{
    //
    public function getAll(Request $request)
    {
        //return DB::table('students')->get();
        //$students = 
        try {
            return Rol::all();
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }


    public function getById(Request $request, $id)
    {
        //return DB::table('students')->where('id',$id)->get();

        try {
            if (Rol::find($id)) {
                return Rol::findOrFail($id);
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
        //return Student::upsetOrCreate();
    }

    public function update(Request $request, $id)
    {

        try {
            if (Rol::find($id)) {

                Rol::findOrFail($id)->update($request->validate([
                    'name' => 'nullable|string',
                    'descripcion'=>'nullable|string',
                ]));
            } else {
                return response('Id no encontrada', 404);
            }
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }
}
