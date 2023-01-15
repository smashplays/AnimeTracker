<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
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
            return response()->json($response);
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function getById(Request $request, $id)
    {
        if (!Actor::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            $actor = Actor::find($id);
            $response = [
                'success' => true,
                'message' => "Actor obtained successfully",
                'data' => $actor
            ];
            return response()->json($response);
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function create(Request $request)
    {
        try {
            Actor::insert($request->validate([
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
        if (!Actor::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            Actor::findOrFail($id)->update($request->validate([
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
        if (!Actor::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            Actor::findOrFail($id)->delete();
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function characters(Request $request, $id)
    {
        if (!Actor::find($id)) {
            return response('ERROR: Id not found', 404);
        }
        $actor = Actor::findOrFail($id);
        $response = [
            'success' => true,
            'message' => "Characters obtained successfully",
            'data' => $actor->characters
        ];
        return response()->json($response);
    }

    public function microphone(Request $request, $id)
    {
        if (!Actor::find($id)) {
            return response('ERROR: Id not found', 404);
        }
        $actor = Actor::findOrFail($id);
        $response = [
            'success' => true,
            'message' => "Microphone obtained successfully",
            'data' => $actor->microphone
        ];
        return response()->json($response);
    }
}
