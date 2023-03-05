<?php

namespace App\Http\Controllers;

use App\Models\Chapter_User;
use App\Models\Chapter_Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ChapterUserController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $chapter_user = Chapter_User::all();

            $response = [
                'success' => true,
                'message' => "Chapters user obtained successfully",
                'data' => $chapter_user
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
            if (Chapter_User::find($id)) {
                $chapter_user = Chapter_User::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Chapter User obtained successfully",
                    'data' => $chapter_user
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
            Chapter_User::create($request->validate([
                'watched' => 'required|boolean',
                'user_id' => 'required|integer',
                'anime_chapter_id' => 'required|integer',
            ]));

            $response = [
                'success' => true,
                'message' => "Chapter User Created",
                'data' => Chapter_User::find(DB::getPdo()->lastInsertId())
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
            if (Chapter_User::find($id)) {

                Chapter_User::findOrFail($id)->update($request->validate([
                    'watched' => 'nullable|boolean',
                    'user_id' => 'nullable|integer',
                    'anime_chapter_id' => 'nullable|integer',
                ]));

                $response = [
                    'success' => true,
                    'message' => "Chapter User Updated",
                    'data' => Chapter_User::find($id)
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
            if (Chapter_User::find($id)) {

                $chapter_user = Chapter_User::findOrFail($id);

                Chapter_User::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Chapter User deleted",
                    'data' => $chapter_user
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
