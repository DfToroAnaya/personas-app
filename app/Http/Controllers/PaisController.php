<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $paises = DB::table('tb_pais')
        ->join('tb_municipio', 'tb_pais.pais_capi', '=', 'tb_municipio.muni_codi')
        ->select('tb_pais.*', 'tb_municipio.muni_nomb')
        ->get();
        return view('pais.index', ['paises' => $paises]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $municipios=DB::table('tb_municipio')
        ->orderby ('muni_nomb')
        ->get();
        return view('pais.new',['municipios'=>$municipios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        // Validar que el campo 'pais_codi' esté presente y no sea nulo
         $request->validate([
         'id' => 'required|string|max:10', // Cambia el tamaño máximo según la longitud esperada
         'name' => 'required|string|max:255',
         'code' => 'required|string|max:255',
         ]);

         $pais = new Pais();
         $pais->pais_codi = $request->id; // Asignar el código ingresado por el usuario
         $pais->pais_nomb = $request->name;
         $pais->pais_capi = $request->code;
         $pais->save();

         $paises = DB::table('tb_pais')
         ->join('tb_municipio', 'tb_pais.pais_capi', '=', 'tb_municipio.muni_codi')
         ->select('tb_pais.*', 'tb_municipio.muni_nomb')
         ->get();
         return view('pais.index', ['paises' => $paises]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pais = Pais::find($id);
        $municipios =DB::table('tb_municipio')
        ->orderBy('muni_nomb')
        ->get();
        return view('pais.edit', ['pais'=>$pais, 'municipios'=>$municipios]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $paises = DB::table('tb_pais')
        ->join('tb_municipio','tb_pais.pais_capi','=','tb_municipio.muni_codi')
        ->select('tb_pais.*',"tb_municipio.muni_nomb")
        ->get();

        // Encuentra el país por su ID
          $pais = Pais::find($id);
         //dd($pais);

    // Verifica si el país existe
         if (!$pais) {
         return redirect()->route('paises.index')->with('error', 'Pais no encontrado.');
         }
    // Validación de datos
        $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:10', // Asegúrate de que el código cumpla con el formato adecuado
        ]);
    // Asigna los valores
        $pais->pais_nomb = $request->name;
        $pais->pais_capi = $request->code;
        $pais->save();
        return view('pais.index',['paises'=>$paises]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pais= Pais::find($id);
        $pais->delete();

        $paises = DB::table('tb_pais')
        ->join('tb_municipio','tb_pais.pais_capi','=','tb_municipio.muni_codi')
        ->select('tb_pais.*',"tb_municipio.muni_nomb")
        ->get();
        return view('pais.index', ['paises'=>$paises]);
    }
}
