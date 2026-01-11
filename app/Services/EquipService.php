<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Models\Equip;
use App\Models\Partit;

class EquipService
{
    public function __construct(private BaseRepository $repo) {}

    public function llistar()
    {
        return $this->repo->getAll();
    }

    public function trobar($id)
    {
        return $this->repo->find($id);
    }

    public function guardar(array $data)
    {
        return $this->repo->create($data);
    }

    public function actualitzar($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function eliminar($id)
    {
        return $this->repo->delete($id);
    }

    public function edatMitjana($equipId)
    {
        $equip = Equip::with('jugadoras')->findOrFail($equipId);

        return $equip->jugadoras->avg(function ($jugadora) {
            return \Carbon\Carbon::parse($jugadora->data_naixement)->age;
        });
    }

    public function ultimsPartits($equipId)
    {
        return Partit::with(['local', 'visitant'])
            ->where('local_id', $equipId)
            ->orWhere('visitant_id', $equipId)
            ->orderByDesc('data')
            ->take(5)
            ->get();
    }
}
