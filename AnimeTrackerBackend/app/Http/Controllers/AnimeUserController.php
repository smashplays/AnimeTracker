<?php

namespace App\Http\Controllers;

use App\Models\AnimeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class AnimeUserController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $AnimeUser = AnimeUser::all();

            $response = [
                'success' => true,
                'message' => "User Animes obtained successfully",
                'data' => $AnimeUser
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
            if (AnimeUser::where('user_id',$id)) {
                $AnimeUser = AnimeUser::findOrFail($id)->anime;


                // $AnimeUser2 = User::whereHas('animes', function($query){
                //     return $query->where('id', $id )->get();
                // }) ;

                $response = [
                    'success' => true,
                    'message' => "User Anime obtained successfully",
                    'data' => $AnimeUser
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
            AnimeUser::create($request->validate([
                'user_id' => 'required|integer',
                'anime_id' => 'required|integer'
            ]));

            $response = [
                'success' => true,
                'message' => "Anime User Created",
                'data' => AnimeUser::find(DB::getPdo()->lastInsertId())
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
            if (AnimeUser::find($id)) {

                AnimeUser::findOrFail($id)->update($request->validate([
                    'user_id' => 'nullable|integer',
                    'anime_id' => 'nullable|integer'
                ]));

                $response = [
                    'success' => true,
                    'message' => "Anime User Updated",
                    'data' => AnimeUser::find($id)
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
            if (AnimeUser::find($id)) {

                $AnimeUser = AnimeUser::findOrFail($id);

                AnimeUser::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Anime User deleted",
                    'data' => $AnimeUser
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
