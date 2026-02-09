<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipRequest;
use App\Models\Equip;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    public function index()
    {
        return Equip::all();
    }

    public function show(Equip $equip)
    {
        return $equip;
    }

    public function store(EquipRequest $request)
    {
        $equip = Equip::create($request->validated());
        return response()->json($equip, 201);
    }

    public function update(EquipRequest $request, Equip $equip)
    {
        $equip->update($request->validated());
        return response()->json($equip, 200);
    }

    public function destroy(Equip $equip)
    {
        $equip->delete();
        return response()->noContent();
    }
}
