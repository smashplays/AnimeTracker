<?php

namespace App\Http\Controllers;

use App\Models\Microphone;
use Illuminate\Http\Request;
use PDOException;

class MicrophoneController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $microphones = Microphone::all();
            $response = [
                'success' => true,
                'message' => "Microphones obtained successfully",
                'data' => $microphones
            ];
            return response()->json($response);
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function getById(Request $request, $id)
    {
        if (!Microphone::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            $microphone = Microphone::find($id);
            $response = [
                'success' => true,
                'message' => "Microphone obtained successfully",
                'data' => $microphone
            ];
            return response()->json($response);
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function create(Request $request)
    {
        try {
            Microphone::insert($request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'image' => 'nullable|string|'
            ]));
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }


    public function modify(Request  $request, $id)
    {
        if (!Microphone::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            Microphone::findOrFail($id)->update($request->validate([
                'name' => 'string',
                'description' => 'string',
                'image' => 'string'
            ]));
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function delete(Request $request, $id)
    {
        if (!Microphone::find($id)) {
            return response('ERROR: Id not found', 404);
        }

        try {
            Microphone::findOrFail($id)->delete();
        } catch (PDOException $exception) {
            return response($exception->errorInfo, 500);
        }
    }

    public function actor(Request $request, $id){
        if (!Microphone::find($id)) {
            return response('ERROR: Id not found', 404);
        }
        $microphone = Microphone::findOrFail($id);
        $response = [
            'success' => true,
            'message' => "Actor obtained successfully",
            'data' => $microphone->actor
        ];
        return response()->json($response);
    }
}
