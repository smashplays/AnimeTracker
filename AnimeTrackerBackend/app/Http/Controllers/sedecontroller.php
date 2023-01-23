<?php

namespace App\Http\Controllers;

use App\Models\modelo4;
use Illuminate\Http\Request;

class sedecontroller extends Controller
{
    public function sedes(Request $request)
    {
        $sedes = DB::table('sede')->get();
        $response = [
            'success' => true,
            'message' => "sedes obtenidas correctamente",
            'data' => $sedes
        ];
        return response()->json($response);
    }

    public function sede(Request $request, $id)
    {

        return DB::table('sede')->where('id', $id)->get();
    }

    public function borrarsedes(Request $request, $id)
    {


        DB::table('sede')->where('id', $id)->delete();
    }

    public function crearsedes(Request $request)
    {


        modelo4::create($request->validate([
            'id' => 'required|integer',
            'sede' => 'required|string|max:16',


        ]));
    }

    public function editarsedes(Request $request, $id)
    {




        $sedes = modelo4::find($id);
        $sedes->sede = $request->sede;
        $sedes->save();
    }

    public function getproductora(Request $request, $id)
    {

        return DB::table('productoras')->where('id', $id)->get();
    }
}
