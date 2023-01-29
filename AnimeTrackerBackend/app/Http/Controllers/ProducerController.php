<?php

namespace App\Http\Controllers;

use App\Models\Producer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ProducerController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $producers = Producer::all();

            $response = [
                'success' => true,
                'message' => "Producers obtained successfully",
                'data' => $producers
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
            if (Producer::find($id)) {
                $producer = Producer::findOrFail($id);

                $response = [
                    'success' => true,
                    'message' => "Producer obtained successfully",
                    'data' => $producer
                ];

                return response($response, 200);
            } else {

                $response = [
                    'success' => false,
                    'message' => "Producer Not Found",
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
            Producer::create($request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'image' => 'required|string'
            ]));

            $response = [
                'success' => true,
                'message' => "Producer Created",
                'data' => Producer::find(DB::getPdo()->lastInsertId())
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
            if (Producer::find($id)) {

                Producer::findOrFail($id)->update($request->validate([
                    'name' => 'string',
                    'description' => 'string',
                    'image' => 'string'
                ]));

                $response = [
                    'success' => true,
                    'message' => "Producer Updated",
                    'data' => Producer::find($id)
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Producer Not Found",
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
            if (Producer::find($id)) {

                $producer = Producer::findOrFail($id);

                Producer::findOrFail($id)->delete();

                $response = [
                    'success' => true,
                    'message' => "Producer deleted",
                    'data' => $producer
                ];

                return response($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'message' => "Producer Not Found",
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
