<?php

namespace App\Http\Controllers;

use App\Models\UserChapters;
use App\Models\Chapter_Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ChapterUserController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $UserChapters = UserChapters::all();

            $response = [
                'success' => true,
                'message' => "Chapters user obtained successfully",
                'data' => $UserChapters
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
            if (UserChapters::find($id)) {
                $UserChapters = UserChapters::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Chapter User obtained successfully",
                    'data' => $UserChapters
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "Chapter User Not Found",
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
            UserChapters::create($request->validate([
                'watched' => 'required|boolean',
                'user_id' => 'required|integer',
                'anime_chapter_id' => 'required|integer',
            ]));

            $response = [
                'success' => true,
                'message' => "Chapter User Created",
                'data' => UserChapters::find(DB::getPdo()->lastInsertId())
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
            if (UserChapters::find($id)) {

                UserChapters::findOrFail($id)->update($request->validate([
                    'watched' => 'nullable|boolean',
                    'user_id' => 'nullable|integer',
                    'anime_chapter_id' => 'nullable|integer',
                ]));

                $response = [
                    'success' => true,
                    'message' => "Chapter User Updated",
                    'data' => UserChapters::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Chapter User Not Found",
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
            if (UserChapters::find($id)) {

                $UserChapters = UserChapters::findOrFail($id);

                UserChapters::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Chapter User deleted",
                    'data' => $UserChapters
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Chapter User Not Found",
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
