<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamentos = DB::table('tb_departamento')
        ->join('tb_pais', 'tb_departamento.pais_codi', '=', 'tb_pais.pais_codi')
        ->select('tb_departamento.*', 'tb_pais.pais_nomb')
        ->get();    
        return json_encode(['departamentos' => $departamentos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'depa_nomb' => ['required', 'max:30', 'unique:tb_departamento'],
            'pais_codi' => ['required', 'numeric', 'min:1']
        ]);

        if ($validate->fails()) {
            return response()->json([
                'msg' => 'se produjo un error en la validacion de la informacion.',
                'statusCode' => 400
            ]);
        }

        $departamento = new Departamento();
        $departamento->depa_nomb = $request->depa_nomb;
        $departamento->pais_codi = $request->pais_codi;
        $departamento->save();
        return json_encode(['departamento' => $departamento]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $departamento = Departamento::find($id);
        if (is_null($departamento)){
            return abort(404);
        }
        $paises = DB::table('tb_pais')
        ->OrderBy('pais_nomb')
        ->get();
        return json_encode(['departamento' => $departamento, 'paises' => $paises]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $departamento = Departamento::find($id);
        $departamento->depa_nomb = $request->depa_nomb;
        $departamento->pais_codi = $request->pais_codi;
        $departamento->save();
        return json_encode(['departamento' => $departamento]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departamento = Departamento::find($id);
        $departamento->delete();
        $departamentos = DB::table('tb_departamento')
        ->join('tb_pais', 'tb_departamento.pais_codi', '=', 'tb_pais.pais_codi')
        ->select('tb_departamento.*', 'tb_pais.pais_nomb' )
        ->get();
        return json_encode(['departamentos' => $departamentos, 'success' =>true]);
    }
}
