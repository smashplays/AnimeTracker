<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
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
            return response()->json($response);
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function getById(Request $request, $id)
    {
        if (!Character::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            $character = Character::find($id);
            $response = [
                'success' => true,
                'message' => "Character obtained successfully",
                'data' => $character
            ];
            return response()->json($response);
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function create(Request $request)
    {
        try {
            Character::insert($request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'age' => 'nullable|integer',
                'image' => 'nullable|string|'
            ]));
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }


    public function modify(Request  $request, $id)
    {
        if (!Character::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            Character::findOrFail($id)->update($request->validate([
                'name' => 'string',
                'description' => 'string',
                'age' => 'integer',
                'image' => 'string'
            ]));
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function delete(Request $request, $id)
    {
        if (!Character::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            Character::findOrFail($id)->delete();
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function actor(Request $request, $id){
        if (!Character::find($id)) {
            return response('ERROR: Id not found', 404);
        }
        $character = Character::findOrFail($id);
        $response = [
            'success' => true,
            'message' => "Actor obtained successfully",
            'data' => $character->actor
        ];
        return response()->json($response);
    }
}
