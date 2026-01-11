<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    /**
     * GET /partits
     * Llistat de partits
     */
    public function index()
    {
        $partits = Partit::with(['local', 'visitant', 'estadi'])->get();
        return view('partits.index', compact('partits'));
    }

    /**
     * GET /partits/create
     * Formulari de creació
     */
    public function create()
    {
        $equips = Equip::all();
        $estadis = Estadi::all();

        return view('partits.create', compact('equips', 'estadis'));
    }

    /**
     * POST /partits
     * Guardar nou partit
     */
    public function store(Request $request)
    {
        $request->validate([
            'local_id' => 'required|exists:equips,id|different:visitant_id',
            'visitant_id' => 'required|exists:equips,id',
            'estadi_id' => 'required|exists:estadis,id',
            'data' => 'required|date',
            'jornada' => 'required|integer|min:1',
            'gols' => 'nullable|integer|min:0',
        ]);

        Partit::create($request->all());

        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit creat correctament');
    }

    /**
     * GET /partits/{partit}
     * Detall del partit
     */
    public function show(Partit $partit)
    {
        $partit->load(['local', 'visitant', 'estadi']);
        return view('partits.show', compact('partit'));
    }

    /**
     * GET /partits/{partit}/edit
     */
    public function edit(Partit $partit)
    {
        $equips = Equip::all();
        $estadis = Estadi::all();

        return view('partits.edit', compact('partit', 'equips', 'estadis'));
    }

    /**
     * PUT /partits/{partit}
     */
    public function update(Request $request, Partit $partit)
    {
        $request->validate([
            'local_id' => 'required|exists:equips,id|different:visitant_id',
            'visitant_id' => 'required|exists:equips,id',
            'estadi_id' => 'required|exists:estadis,id',
            'data' => 'required|date',
            'jornada' => 'required|integer|min:1',
            'gols' => 'nullable|integer|min:0',
        ]);

        $partit->update($request->all());

        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit actualitzat correctament');
    }

    /**
     * DELETE /partits/{partit}
     */
    public function destroy(Partit $partit)
    {
        $partit->delete();

        return redirect()
            ->route('partits.index')
            ->with('success', 'Partit eliminat correctament');
    }
}
