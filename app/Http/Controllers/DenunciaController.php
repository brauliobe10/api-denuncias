<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Denuncia;

class DenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $offset = (int) $request->query('offset', 0);
        $limit  = (int) $request->query('limit', 5);

        $denuncias = Denuncia::offset($offset)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($denuncias, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dni'         => 'required|string|size:8',
            'fecha'       => 'required|date',
            'tipo'        => 'required|string|max:30',
            'direccion'   => 'required|string|max:200',
            'descripcion' => 'required|string|max:255',
        ]);

        $validatedData['estado'] = 1;

        $denuncia = Denuncia::create($validatedData);

        return response()->json($denuncia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $denuncia = Denuncia::find($id);

        if (!$denuncia) {
            return response()->json(['message' => 'Denuncia no encontrada'], 404);
        }

        return response()->json($denuncia, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // 4. Obtener denuncias de un ciudadano (GET /api/denuncias/ciudadano/{dni})
    public function getByCiudadano($dni)
    {
        $denuncias = Denuncia::where('dni', $dni)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($denuncias, 200);
    }

    // 5. Atender denuncia (PUT /api/denuncias/{id})
    public function atender($id)
    {
        $denuncia = Denuncia::find($id);

        if (!$denuncia) {
            return response()->json(['message' => 'Denuncia no encontrada'], 404);
        }

        $denuncia->estado = 0;
        $denuncia->save();

        return response()->json($denuncia, 200);
    }
}
