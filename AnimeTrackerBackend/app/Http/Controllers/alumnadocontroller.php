<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\modelo;



class alumnadocontroller extends Controller
{
    public function alumnos(Request $request)
    {
        $alumnos = DB::table('alumnos')->get();
        $response = [
            'success' => true,
            'message' => "Alumnos obtenidos correctamente",
            'data' => $alumnos
        ];
        return response()->json($response);
    }

    public function alumno(Request $request, $id)
    {
        //este return lo hace todo el pdo, prepare, bindparam, execute, PDO::FETCH_ASSOC
        return DB::table('alumnos')->where('id', $id)->get();
    }

    public function borrar(Request $request, $id)
    {
        //DELETE
        //FROM pets

        DB::table('alumnos')->where('id', $id)->delete();
        //WHERE id = $id
        // return response()->json(' borro la mascota con id ' . $id);
    }

    public function crear(Request $request)
    {


        modelo::create($request->validate([
            'nombre' => 'required|string|max:32',
            'telefono' => 'nullable|string|max:16',
            'edad' => 'nullable|integer',
            'contraseña' => 'required|string|max:64',
            'email' => 'nullable|email:rfc|max:64',
            'sexo' => 'nullable|string'
        ]));
    }

    public function editar(Request $request, $id)
    {




        $alumnos = modelo::find($id);
        $alumnos->nombre = $request->nombre;
        $alumnos->telefono = $request->telefono;
        $alumnos->edad = $request->edad;
        $alumnos->contraseña = $request->contraseña;
        $alumnos->email = $request->email;
        $alumnos->sexo = $request->sexo;
        $alumnos->save();
    }
}
