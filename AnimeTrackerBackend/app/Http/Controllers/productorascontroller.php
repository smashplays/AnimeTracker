<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\modelo3;

class productorascontroller extends Controller
{
    public function productoras(Request $request)
    {
        $productoras = DB::table('productoras')->get();
        $response = [
            'success' => true,
            'message' => "animes obtenidos correctamente",
            'data' => $productoras
        ];
        return response()->json($response);
    }

    public function productora(Request $request, $id)
    {
        //este return lo hace todo el pdo, prepare, bindparam, execute, PDO::FETCH_ASSOC
        return DB::table('productoras')->where('id', $id)->get();
    }

    public function borrarproductoras(Request $request, $id)
    {


        DB::table('productoras')->where('id', $id)->delete();
    }

    public function crearproductoras(Request $request)
    {


        modelo3::create($request->validate([
            'nombre' => 'required|string|max:32',
            'informacion' => 'required|string|max:32',
            'URL_img' => 'nullable|string|max:32',

        ]));
    }

    public function editarproductoras(Request $request, $id)
    {




        $productoras = modelo3::find($id);
        $productoras->nombre = $request->nombre;
        $productoras->informacion = $request->informacion;
        $productoras->URL_img = $request->URL_img;
        $productoras->save();
    }

    public function getsede(Request $request, $id)
    {

        return DB::table('sede')->where('id', $id)->get();
    }
}
