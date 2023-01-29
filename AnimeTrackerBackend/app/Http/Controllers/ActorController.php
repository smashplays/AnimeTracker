<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ActorController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $actors = Actor::all();

            $response = [
                'success' => true,
                'message' => "Actors obtained successfully",
                'data' => $actors
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
            if (Actor::find($id)) {
                $actor = Actor::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Actor obtained successfully",
                    'data' => $actor
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "Actor Not Found",
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
            Actor::create($request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'age' => 'nullable|integer',
                'image' => 'nullable|string|'
            ]));
            $response = [
                'success' => true,
                'message' => "Actor Created",
                'data' => Actor::find(DB::getPdo()->lastInsertId())
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
            if (Actor::find($id)) {
                Actor::findOrFail($id)->update($request->validate([
                    'name' => 'string',
                    'description' => 'string',
                    'age' => 'integer',
                    'image' => 'string'
                ]));

                $response = [
                    'success' => true,
                    'message' => "Actor Updated",
                    'data' => Actor::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Actor Not Found",
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
            if (Actor::find($id)) {

                $actor = Actor::findOrFail($id);

                Actor::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Actor deleted",
                    'data' => $actor
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Actor Not Found",
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

    public function characters(Request $request, $id)
    {
        try {
            if (Actor::find($id)) {
                $actor = Actor::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Characters obtained successfully",
                    'data' => $actor->characters
                ];
                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Actor Not Found",
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
