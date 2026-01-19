<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use App\Services\EstadiService;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;

class EstadiController extends Controller
{
    public function __construct(private EstadiService $servei) {}

    // GET /estadis
    public function index()
    {
        $estadis = $this->servei->llistar();
        return view('estadis.index', compact('estadis'));
    }

    // GET /estadis/{estadi}
    public function show(Estadi $estadi)
    {
        $estadi->load('equips');
        return view('estadis.show', compact('estadi'));
    }

    // GET /estadis/create
    public function create()
    {
        return view('estadis.create');
    }

    // POST /estadis
    public function store(StoreEstadiRequest $request)
    {
        $this->servei->guardar($request->validated());

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi afegit correctament!');
    }

    // GET /estadis/{estadi}/edit
    public function edit(Estadi $estadi)
    {
        return view('estadis.edit', compact('estadi'));
    }

    // PUT /estadis/{estadi}
    public function update(UpdateEstadiRequest $request, Estadi $estadi)
    {
        $this->servei->actualitzar($estadi->id, $request->validated());

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi actualitzat correctament!');
    }

    // DELETE /estadis/{estadi}
    public function destroy(Estadi $estadi)
    {
        $this->servei->eliminar($estadi->id);

        return redirect()
            ->route('estadis.index')
            ->with('success', 'Estadi esborrat correctament!');
    }
}
