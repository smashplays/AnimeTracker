<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function getAll(Request $request)
    {

        try {
            $users = User::all();

            $response = [
                'success' => true,
                'message' => "Users obtained successfully",
                'data' => $users
            ];

            return response($response, 200);
        } catch (PDOException $ex) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];
            return response($response, 500);
        }
    }


    public function getById(Request $request, $id)
    {


        try {
            if (User::find($id)) {
                $user = User::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "User obtained successfully",
                    'data' => $user
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "User Not Found",
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


    public function getByIdAnime(Request $request, $id)
    {
        try {
            if (User::find($id)) {
                $user = User::findOrFail($id)->animes()->with('anime')->get();

                $response = [
                    'success' => true,
                    'message' => "User obtained successfully",
                    'data' => $user
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "User Not Found",
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

    public function getChapterByUser(Request $request, $id)
    {
        try {
            if (User::find($id)) {
                $user = User::findOrFail($id)->chapters()->with('chapter')->get();

                $response = [
                    'success' => true,
                    'message' => "Chapters User obtained successfully",
                    'data' => $user
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "User Not Found",
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

    public function getChapterByAnimeByUser(Request $request, $id, $anime)
    {
        try {
            if (User::find($id)) {
                $user = User::findOrFail($id)->chapters()->with(['chapter' => fn ($query) => $query->where('anime_id', '=', $anime)])->get();

                $response = [
                    'success' => true,
                    'message' => "Chapters User obtained successfully",
                    'data' => $user
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "User Not Found",
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

    public function delete(Request $request, $id)
    {

        try {
            if (User::find($id)) {

                $user = User::findOrFail($id);

                User::findOrFail($id)->delete();
                $response = [
                    'success' => true,
                    'message' => "User deleted",
                    'data' => $user
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "User Not Found",
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
            User::create($request->validate([
                'name' => 'required|string',
                'age' => 'required|integer',
                'password' => 'required|string',
                'email' => 'required|email:rfc|unique:users',
                'role' => 'required|string'
            ]));
            $response = [
                'success' => true,
                'message' => "User Created",
                'data' => User::find(DB::getPdo()->lastInsertId())
            ];

            return response($response, 201);
        } catch (PDOException $ex) {
            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];

            return response($response, 500);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            if (User::find($id)) {

                User::findOrFail($id)->update($request->validate([
                    'name' => 'nullable|string',
                    'age' => 'nullable|integer',
                    'password' => 'nullable|string',
                    'email' => 'nullable||email:rfc|unique:users',
                    'role' => 'nullable|string'
                ]));

                $response = [
                    'success' => true,
                    'message' => "User Updated",
                    'data' => User::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "User Not Found",
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





    public function calendar(Request $request, $id)
    {
        try {
            if (!User::find($id)) {
                $response = [
                    'success' => false,
                    'message' => "User Not Found",
                    'data' => null
                ];

                return response($response, 404);
            }


            $response = [
                'success' => true,
                'message' => "Calendar of user obtained successfully",
                'data' => User::find($id)->calendar
            ];

            return response($response, 200);
        } catch (PDOException $ex) {

            $response = [
                'success' => false,
                'message' => "Connection Failed",
                'data' => $ex->errorInfo
            ];

            return response($response, 500);
        }
    }
}
