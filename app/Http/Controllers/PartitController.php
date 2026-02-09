<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\Estadi;
use App\Models\Partit;
use Illuminate\Http\Request;
use App\Services\PartitService;
use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;
use App\Events\PartitActualitzat;
use App\Services\ClassificacioService;

class PartitController extends Controller
{

    public function __construct(private PartitService $servei, private ClassificacioService $classificacioService) {}

    public function index()
    {
        $partits = $this->servei->llistar();
        return view('partits.index', compact('partits'));
    }

    public function create()
    {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.create', compact('equips', 'estadis'));
    }

    public function store(StorePartitRequest $request)
    {
        $this->servei->guardar($request->validated());
        return redirect()->route('partits.index');
    }

    public function show(Partit $partit)
    {
        return view('partits.show', compact('partit'));
    }

    public function edit(Partit $partit)
    {
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('partits.edit', compact('partit', 'equips', 'estadis'));
    }

    public function update(Request $request, Partit $partit)
    {
        $data = $request->validate([
            'local_id' => ['required', 'exists:equips,id', 'different:visitant_id'],
            'visitant_id' => ['required', 'exists:equips,id'],
            'estadi_id' => ['required', 'exists:estadis,id'],
            'data' => ['required', 'date'],
            'jornada' => ['required', 'integer', 'min:1'],
            'gols_local' => ['required', 'integer', 'min:0', 'max:99'],
            'gols_visitant' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        // 1) posicions abans
        $abans = $this->classificacioService->posicionsPerEquip();

        // 2) actualitza el partit
        $partit->update($data);

        // 3) posicions després
        $despres = $this->classificacioService->posicionsPerEquip();

        // 4) calcula delta (+ = puja, - = baixa)
        $delta = [];
        foreach ($despres as $equipId => $posDespres) {
            $posAbans = $abans[$equipId] ?? $posDespres;
            $deltaPos = $posAbans - $posDespres; // si passa de 5 a 3 => +2 (puja)
            if ($deltaPos !== 0) {
                $delta[] = ['equip_id' => $equipId, 'delta' => $deltaPos];
            }
        }

        // 5) emet event (només si hi ha canvis)
        if (!empty($delta)) {
            event(new PartitActualitzat($delta));
        }

        return redirect()->route('partits.index')->with('success', 'Partit actualitzat.');
    }

    public function destroy(Partit $partit)
    {
        $this->servei->eliminar($partit->id);
        return redirect()->route('partits.index');
    }
}
