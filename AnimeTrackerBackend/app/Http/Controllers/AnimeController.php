<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class AnimeController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $animes = Anime::all();

            $response = [
                'success' => true,
                'message' => "Animes obtained successfully",
                'data' => $animes
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
            if (Anime::find($id)) {
                $anime = Anime::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Anime obtained successfully",
                    'data' => $anime
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "Anime Not Found",
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
            Anime::create($request->validate([
                'mal_id'=> 'required|integer',
                'name' => 'required|string',
                'image' => 'required|string',
            ]));

            $response = [
                'success' => true,
                'message' => "Anime Created",
                'data' => Anime::find(DB::getPdo()->lastInsertId())
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
            if (Anime::find($id)) {

                Anime::findOrFail($id)->update($request->validate([
                    'mal_id'=> 'required|integer',
                    'name' => 'string',
                    'image' => 'string',
                ]));

                $response = [
                    'success' => true,
                    'message' => "Anime Updated",
                    'data' => Anime::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Anime Not Found",
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
            if (Anime::find($id)) {

                $anime = Anime::findOrFail($id);

                Anime::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Anime deleted",
                    'data' => $anime
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Anime Not Found",
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
