<?php

namespace App\Http\Controllers;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    /**
     * GET /jugadores
     * Llistat de jugadores
     */
    public function index()
    {
        $jugadores = Jugadora::with('equip')->get();
        return view('jugadores.index', compact('jugadores'));
    }

    /**
     * GET /jugadores/create
     * Formulari de creació
     */
    public function create()
    {
        $equips = Equip::all();
        return view('jugadores.create', compact('equips'));
    }

    /**
     * POST /jugadores
     * Guardar nova jugadora
     */
    public function store(Request $request)
    {
        $request->validate([
            'equip_id' => 'required|exists:equips,id',
            'data_naixement' => 'required|date',
            'dorsal' => 'required|integer|min:1',
            'foto' => 'nullable|string',
        ]);

        Jugadora::create($request->all());

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugadora creada correctament');
    }

    /**
     * GET /jugadores/{jugadora}
     * Detall d’una jugadora
     */
    public function show(Jugadora $jugadora)
    {
        $jugadora->load('equip');
        return view('jugadores.show', compact('jugadora'));
    }

    /**
     * GET /jugadores/{jugadora}/edit
     */
    public function edit(Jugadora $jugadora)
    {
        $equips = Equip::all();
        return view('jugadores.edit', compact('jugadora', 'equips'));
    }

    /**
     * PUT /jugadores/{jugadora}
     */
    public function update(Request $request, Jugadora $jugadora)
    {
        $request->validate([
            'equip_id' => 'required|exists:equips,id',
            'data_naixement' => 'required|date',
            'dorsal' => 'required|integer|min:1',
            'foto' => 'nullable|string',
        ]);

        $jugadora->update($request->all());

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugadora actualitzada correctament');
    }

    /**
     * DELETE /jugadores/{jugadora}
     */
    public function destroy(Jugadora $jugadora)
    {
        $jugadora->delete();

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugadora eliminada correctament');
    }
}
