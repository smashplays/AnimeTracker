<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class PetitionController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $petitions = Petition::all();

            $response = [
                'success' => true,
                'message' => "Petitions obtained successfully",
                'data' => $petitions
            ];

            return response($response, 200);
        } catch (PDOException $exception) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $exception->errorInfo
            ];

            return response($response, 500);
        }
    }

    public function getById(Request $request, $id)
    {
        try {
            if (Petition::find($id)) {
                $petition = Petition::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Petition obtained successfully",
                    'data' => $petition
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "Petition Not Found",
                    'data' => null
                ];

                return response($response, 404);
            }
        } catch (PDOException $exception) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $exception->errorInfo
            ];

            return response($response, 500);
        }
    }

    public function post(Request $request)
    {
        try {
            Petition::create($request->validate([
                'name' => 'required|string',
                'url' => 'required|string',
                'justification' => 'required|string'
            ]));

            $response = [
                'success' => true,
                'message' => "Petition Created",
                'data' => Petition::find(DB::getPdo()->lastInsertId())
            ];

            return response($response, 201);
        } catch (PDOException $exception) {
            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $exception->errorInfo
            ];

            return response($response, 500);
        }
    }

    public function update(Request  $request, $id)
    {
        try {
            if (Petition::find($id)) {

                Petition::findOrFail($id)->update($request->validate([
                    'name' => 'string',
                    'url' => 'string',
                    'justification' => 'string'
                ]));

                $response = [
                    'success' => true,
                    'message' => "Petition Updated",
                    'data' => Petition::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Petition Not Found",
                    'data' => null
                ];

                return response($response, 404);
            }
        } catch (PDOException $exception) {
            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $exception->errorInfo
            ];

            return response($response, 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            if (Petition::find($id)) {

                $petition = Petition::findOrFail($id);

                Petition::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Anime deleted",
                    'data' => $petition
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Petition Not Found",
                    'data' => null
                ];

                return response($response, 404);
            }
        } catch (PDOException $exception) {
            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $exception->errorInfo
            ];

            return response($response, 500);
        }
    }
}
