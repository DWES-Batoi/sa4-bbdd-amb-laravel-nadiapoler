<?php

namespace App\Repositories;

use App\Models\Partit;

class PartitRepository implements \App\Repositories\BaseRepository
{
    public function getAll() {
        return Partit::with(['local','visitant','estadi'])->get();
    }

    public function find($id) {
        return Partit::with(['local','visitant','estadi'])->findOrFail($id);
    }

    public function create(array $data) {
        return Partit::create($data);
    }

    public function update($id, array $data) {
        $partit = Partit::findOrFail($id);
        $partit->update($data);
        return $partit;
    }

    public function delete($id) {
        return Partit::destroy($id);
    }
}
