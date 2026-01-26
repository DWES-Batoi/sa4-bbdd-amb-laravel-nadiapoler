<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadora extends Model
{
    use HasFactory;

    protected $table = 'jugadores';

    protected $fillable = [
        'equip_id',
        'data_naixement',
        'dorsal',
        'foto',
    ];

    protected $casts = [
        'data_naixement' => 'date',
    ];

    public function equip()
    {
        return $this->belongsTo(\App\Models\Equip::class);
    }
}
