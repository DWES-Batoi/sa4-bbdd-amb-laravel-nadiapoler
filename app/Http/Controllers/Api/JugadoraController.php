<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jugadora;
use Illuminate\Http\Request;

class JugadoraController extends Controller
{
    public function index()
    {
        return Jugadora::query()->get();
    }

    public function show($id)
    {
        $jugadora = Jugadora::findOrFail($id);
        return $jugadora;
    }
}
