<?php

namespace App\Http\Controllers;

use App\Models\AnimeChapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ChapterAnimeController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $AnimeChapter = AnimeChapter::all();

            $response = [
                'success' => true,
                'message' => "Chapters anime obtained successfully",
                'data' => $AnimeChapter
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
            if (AnimeChapter::find($id)) {
                $AnimeChapter = AnimeChapter::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Chapter Anime obtained successfully",
                    'data' => $AnimeChapter
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

    public function getByIdAnime(Request $request, $id)
    {
        try {
            if (AnimeChapter::where('anime_id', $id)->get()) {
                $AnimeChapters = AnimeChapter::where('anime_id', $id)->get();
                $response = [
                    'success' => true,
                    'message' => "Anime Chapters obtained successfully",
                    'data' => $AnimeChapters
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
        } catch (PDOException $ex) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];
            return response($response, 500);
        }
    }

    public function post(Request $request)
    {
        try {
            $cap = $request->all();
            
            $validate = $request->validate([
                '*.name' => 'required|string',
                '*.aired' => 'required|string',
                '*.anime_id' => 'required|integer',
            ]);

            foreach($cap as $c){
                 AnimeChapter::create($c);
             }

            $response = [
                'success' => true,
                'message' => "Chapter Anime Created",
                'data' => AnimeChapter::find(DB::getPdo()->lastInsertId())
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
            if (AnimeChapter::find($id)) {

                AnimeChapter::findOrFail($id)->update($request->validate([
                    'name' => 'nullable|string',
                    'aired' => 'nullable|string',
                    'anime_id' => 'nullable|integer',
                ]));

                $response = [
                    'success' => true,
                    'message' => "Chapter Anime Updated",
                    'data' => AnimeChapter::find($id)
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
            if (AnimeChapter::find($id)) {

                $AnimeChapter = AnimeChapter::findOrFail($id);

                AnimeChapter::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Chapter Anime deleted",
                    'data' => $AnimeChapter
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
