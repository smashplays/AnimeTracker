<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use PDOException;

class CalendarController extends Controller
{
    //
    public function getAll(Request $request)
    {
    
        try {
            return Calendar::all();
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }


    public function getById(Request $request, $id)
    {
        //return DB::table('students')->where('id',$id)->get();

        try {
            if (Calendar::find($id)) {
                return Calendar::findOrFail($id);
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
            if (Calendar::find($id)) {

                Calendar::findOrFail($id)->delete();
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
            Calendar::create($request->validate([
                'id' => 'required|integer',
            ]));
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
        //return Student::upsetOrCreate();
    }

    public function update(Request $request, $id)
    {

        try {
            if (Calendar::find($id)) {

                Calendar::findOrFail($id)->update($request->validate([
                    'id' => 'nullable|integer',
                    
                ]));
            } else {
                return response('Id no encontrada', 404);
            }
        } catch (PDOException $ex) {
            return response($ex->errorInfo, 500);
        }
    }
}
