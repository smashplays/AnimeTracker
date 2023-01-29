<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class CalendarController extends Controller
{
    //
    public function getAll(Request $request)
    {

        try {


            $calendars = Calendar::all();

            $response = [
                'success' => true,
                'message' => "Calendar obtained successfully",
                'data' => $calendars
            ];

            return response($response, 200);
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
            if (Calendar::find($id)) {


                $calendar = Calendar::find($id);

                $response = [
                    'success' => true,
                    'message' => "Calendar obtained successfully",
                    'data' => $calendar
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "Calendar Not Found",
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
            if (Calendar::find($id)) {

                $calendar = Calendar::findOrFail($id);

                Calendar::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Calendar deleted",
                    'data' => $calendar
                ];
                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Calendar Not Found",
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
            Calendar::create($request->validate([
                'id' => 'required|integer',
                'user_id' => 'required|integer|unique:calendars'
            ]));
            $response = [
                'success' => true,
                'message' => "Calendar Created",
                'data' => Calendar::find(DB::getPdo()->lastInsertId())
            ];

            return response($response, 201);
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
            if (Calendar::find($id)) {

                Calendar::findOrFail($id)->update($request->validate([
                    'id' => 'nullable|integer',
                    'user_id' => 'nullable|integer|unique:calendars'

                ]));
                $response = [
                    'success' => true,
                    'message' => "Calendar Updated",
                    'data' => Calendar::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Calendar Not Found",
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


    public function user(Request $request, $id)
    {
        try {
            if (!Calendar::find($id)) {
                $response = [
                    'success' => false,
                    'message' => "User Not Found",
                    'data' => null
                ];

                return response($response, 404);
            }

            $response = [
                'success' => true,
                'message' => "User Of Calendar obtained successfully",
                'data' => Calendar::findOrFail($id)->user
            ];

            return response($response, 200);
        } catch (PDOException $ex) {
            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];
            return response($response, 500);
        }
    }
}
