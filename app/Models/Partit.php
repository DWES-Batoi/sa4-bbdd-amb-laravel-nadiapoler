<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    protected $fillable = [
        'local_id',
        'visitant_id',
        'estadi_id',
        'data',
        'jornada',
        'gols_local',
        'gols_visitant',
    ];

    // <<< Esto convierte 'data' automáticamente a Carbon
    protected $casts = [
        'data' => 'date',
    ];

    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }
}
