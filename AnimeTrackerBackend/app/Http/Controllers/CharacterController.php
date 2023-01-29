<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class CharacterController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $characters = Character::all();

            $response = [
                'success' => true,
                'message' => "Characters obtained successfully",
                'data' => $characters
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
            if (Character::find($id)) {
                $character = Character::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Character obtained successfully",
                    'data' => $character
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "Character Not Found",
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
            Character::create($request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'age' => 'nullable|integer',
                'image' => 'nullable|string|'
            ]));

            $response = [
                'success' => true,
                'message' => "Character Created",
                'data' => Character::find(DB::getPdo()->lastInsertId())
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
            if (Character::find($id)) {

                Character::findOrFail($id)->update($request->validate([
                    'name' => 'string',
                    'description' => 'string',
                    'age' => 'integer',
                    'image' => 'string'
                ]));

                $response = [
                    'success' => true,
                    'message' => "Character Updated",
                    'data' => Character::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Character Not Found",
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
            if (Character::find($id)) {

                $character = Character::findOrFail($id);

                Character::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Character deleted",
                    'data' => $character
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Character Not Found",
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

    public function actor(Request $request, $id)
    {
        try {
            if (Character::find($id)) {
                $character = Character::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Actor obtained successfully",
                    'data' => $character->actor
                ];
                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Character Not Found",
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
