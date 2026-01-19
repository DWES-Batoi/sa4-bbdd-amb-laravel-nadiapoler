<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Models\Equip;
use App\Models\Partit;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class EquipService
{
    public function __construct(private BaseRepository $repo) {}

    public function guardar(array $data, ?UploadedFile $escut = null): Equip
    {
        if ($escut) {
            $data['escut'] = $escut->store('escuts', 'public');
        }
        return $this->repo->create($data);
    }

    public function actualitzar(int $id, array $data, ?UploadedFile $escut = null): Equip
    {
        $equip = $this->repo->find($id);

        if ($escut) {
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            $data['escut'] = $escut->store('escuts', 'public');
        }

        return $this->repo->update($id, $data);
    }

    public function eliminar(int $id): void
    {
        $equip = $this->repo->find($id);

        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }

        $this->repo->delete($id);
    }

    public function llistar()
    {
        return $this->repo->getAll();
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
