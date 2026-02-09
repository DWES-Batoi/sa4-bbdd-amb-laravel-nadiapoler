<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JugadoraRequest;
use App\Http\Resources\JugadoraResource;
use App\Models\Jugadora;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function index()
    {
        return JugadoraResource::collection(
            Jugadora::query()->paginate(10)
        );
    }

    public function show($id)
    {
        $jugadora = Jugadora::findOrFail($id);
        return $jugadora;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'equip_id' => ['required', 'exists:equips,id'],
            'data_naixement' => ['required', 'date'],
            'dorsal' => ['nullable', 'integer', 'min:0', 'max:99'],
            'foto' => ['nullable', 'string'],
        ]);
        $jugadora = \App\Models\Jugadora::create($data);

        return response()->json($jugadora->load('equip'), 201);
    }

    public function update(JugadoraRequest $request, Jugadora $jugadora)
    {
        $jugadora->update($request->validated());

        return new JugadoraResource($jugadora);
    }

    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();

        return response()->noContent(); // 204
    }
}
