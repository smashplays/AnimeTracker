<?php

namespace App\Http\Controllers;

use App\Models\Anime_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class AnimeUserController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $anime_user = Anime_User::all();

            $response = [
                'success' => true,
                'message' => "User Animes obtained successfully",
                'data' => $anime_user
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
            if (Anime_User::find($id)) {
                $anime_user = Anime_User::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "User Anime obtained successfully",
                    'data' => $anime_user
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "User Anime Not Found",
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
            Anime_User::create($request->validate([
                'user_id' => 'required|integer',
                'anime_id' => 'required|integer'
            ]));

            $response = [
                'success' => true,
                'message' => "Anime User Created",
                'data' => Anime_User::find(DB::getPdo()->lastInsertId())
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
            if (Anime_User::find($id)) {

                Anime_User::findOrFail($id)->update($request->validate([
                    'user_id' => 'nullable|integer',
                    'anime_id' => 'nullable|integer'
                ]));

                $response = [
                    'success' => true,
                    'message' => "Anime User Updated",
                    'data' => Anime_User::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Anime User Not Found",
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
            if (Anime_User::find($id)) {

                $anime_user = Anime_User::findOrFail($id);

                Anime_User::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Anime User deleted",
                    'data' => $anime_user
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Anime User Not Found",
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
