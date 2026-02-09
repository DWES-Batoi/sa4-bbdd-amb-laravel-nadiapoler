<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Services\ClassificacioService;

class ClassificacioController extends Controller
{
    public function index(ClassificacioService $classificacioService)
    {
        $posicions = $classificacioService->posicionsPerEquip();

        $punts = $classificacioService->puntsPerEquip();

        $equips = Equip::all()
            ->sortBy(fn($e) => $posicions[$e->id] ?? 999)
            ->values();

        return view('classificacio.index', compact('equips', 'posicions', 'punts'));
    }
}
