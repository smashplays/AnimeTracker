<?php

namespace App\Http\Controllers;

use App\Models\Chapter_Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ChapterAnimeController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $chapter_anime = Chapter_Anime::all();

            $response = [
                'success' => true,
                'message' => "Chapters anime obtained successfully",
                'data' => $chapter_anime
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
            if (Chapter_Anime::find($id)) {
                $chapter_anime = Chapter_Anime::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Chapter Anime obtained successfully",
                    'data' => $chapter_anime
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "Chapter Anime Not Found",
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
            Chapter_Anime::create($request->validate([
                'name' => 'required|string',
                'aired' => 'required|string',
                'anime_id' => 'required|integer',
            ]));

            $response = [
                'success' => true,
                'message' => "Chapter Anime Created",
                'data' => Chapter_Anime::find(DB::getPdo()->lastInsertId())
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
            if (Chapter_Anime::find($id)) {

                Chapter_Anime::findOrFail($id)->update($request->validate([
                    'name' => 'nullable|string',
                    'aired' => 'nullable|string',
                    'anime_id' => 'nullable|integer',
                ]));

                $response = [
                    'success' => true,
                    'message' => "Chapter Anime Updated",
                    'data' => Chapter_Anime::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Chapter Anime Not Found",
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
            if (Chapter_Anime::find($id)) {

                $chapter_anime = Chapter_Anime::findOrFail($id);

                Chapter_Anime::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Chapter Anime deleted",
                    'data' => $chapter_anime
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Chapter Anime Not Found",
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
