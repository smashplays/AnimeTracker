<?php

namespace App\Http\Controllers;

use App\Models\modelo2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class animecontroller extends Controller
{
    public function animes(Request $request)
    {
        $animes = DB::table('animes')->get();
        $response = [
            'success' => true,
            'message' => "animes obtenidos correctamente",
            'data' => $animes
        ];
        return response()->json($response);
    }

    public function anime(Request $request, $id)
    {
        //este return lo hace todo el pdo, prepare, bindparam, execute, PDO::FETCH_ASSOC
        return DB::table('animes')->where('id', $id)->get();
    }

    public function borraranimes(Request $request, $id)
    {


        DB::table('animes')->where('id', $id)->delete();
    }

    public function crearanimes(Request $request)
    {


        modelo2::create($request->validate([
            'nombre' => 'required|string|max:32',
            'descripcion' => 'required|string|max:16',
            'generos' => 'required|string|max:16',
            'capitulo' => 'required|string|max:64',
            'estado' => 'required|string|max:32',
            'fecha_inicio' => 'required|string|max:32',
            'fecha_fin' => 'required|string|max:32',
            'URL_imagen'  => 'nullable|string|max:32'

        ]));
    }

    public function editaranimes(Request $request, $id)
    {




        $animes = modelo2::find($id);
        $animes->nombre = $request->nombre;
        $animes->descripcion = $request->descripcion;
        $animes->generos = $request->generos;
        $animes->capitulo = $request->capitulo;
        $animes->estado = $request->estado;
        $animes->fecha_inicio = $request->fecha_inicio;
        $animes->fecha_fin = $request->fecha_fin;
        $animes->URL_imagen = $request->URL_imagen;

        $animes->save();
    }
}
