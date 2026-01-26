<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\Jugadora;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use App\Services\JugadoraService;

class JugadoraController extends Controller
{
    public function __construct(private JugadoraService $servei) {}

    public function index() {
        $jugadores = $this->servei->llistar();
        return view('jugadores.index', compact('jugadores'));
    }

    public function create() {
        $equips = Equip::all();
        return view('jugadores.create', compact('equips'));
    }

    public function store(StoreJugadoraRequest $request) {
        $this->servei->guardar($request->validated());
        return redirect()->route('jugadores.index');
    }

    public function show(Jugadora $jugadora) {
        return view('jugadores.show', compact('jugadora'));
    }

    public function edit(Jugadora $jugadora) {
        $equips = Equip::all();
        return view('jugadores.edit', compact('jugadora', 'equips'));
    }

    public function update(UpdateJugadoraRequest $request, Jugadora $jugadora) {
        $this->servei->actualitzar($jugadora->id, $request->validated());
        return redirect()->route('jugadores.index');
    }

    public function destroy(Jugadora $jugadora) {
        $this->servei->eliminar($jugadora->id);
        return redirect()->route('jugadores.index');
    }
    
}
