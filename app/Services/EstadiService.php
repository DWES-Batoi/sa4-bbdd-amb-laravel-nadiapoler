<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Models\Estadi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class EstadiService
{
    public function __construct(private BaseRepository $repo) {}

    public function guardar(array $data, ?UploadedFile $escut = null): Estadi
    {
        if ($escut) {
            $data['escut'] = $escut->store('escuts', 'public');
        }

        return $this->repo->create($data);
    }

    public function actualitzar(int $id, array $data, ?UploadedFile $escut = null): Estadi
    {
        $estadi = $this->repo->find($id);

        if ($escut) {
            if ($estadi->escut) {
                Storage::disk('public')->delete($estadi->escut);
            }
            $data['escut'] = $escut->store('escuts', 'public');
        }

        foreach ($data as $key => $value) {
            $estadi->$key = $value;
        }

        return $this->repo->update($id, $data);
    }

    public function eliminar(int $id): void
    {
        $estadi = $this->repo->find($id);

        if ($estadi->escut) {
            Storage::disk('public')->delete($estadi->escut);
        }

        $this->repo->delete($id);
    }

    public function llistar()
    {
        return $this->repo->getAll();
    }
}
