<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\EquipFactory;

/**
 * Model EQUIP
 */
class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'estadi_id', 'titols'];

    /**
     * Un equip pertany a un estadi
     */
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    /**
     * (Opcional) relació amb un usuari manager
     */
    public function manager()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Enllacem explícitament amb la factory
     */
    protected static function newFactory()
    {
        return EquipFactory::new();
    }

    public function jugadoras()
    {
        return $this->hasMany(Jugadora::class);
    }

    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }
}
