<?php

namespace App\Services;

use App\Models\Equip;
use App\Models\Partit;

class ClassificacioService
{
    /**
     * Retorna un array [equip_id => punts]
     */
    public function puntsPerEquip(): array
    {
        $punts = [];
        $equips = Equip::all();

        // Inicializa puntos a 0
        foreach ($equips as $e) {
            $punts[$e->id] = 0;
        }

        $partits = Partit::all();

        foreach ($partits as $p) {
            $l = $p->local_id;
            $v = $p->visitant_id;

            $gl = (int) $p->gols; // solo un campo goles
            $gv = 0;               // visitante no tiene goles

            // Calcula puntos 3-1-0
            if ($gl > $gv) {
                $punts[$l] += 3;
            } elseif ($gl < $gv) {
                $punts[$v] += 3;
            } else {
                $punts[$l] += 1;
                $punts[$v] += 1;
            }
        }

        return $punts;
    }

    /**
     * Retorna posició per equip: [equip_id => posicio]
     * posició 1 = millor
     */
    public function posicionsPerEquip(): array
    {
        $equips = Equip::all();

        // Inicialitza taula de stats
        $stats = [];
        foreach ($equips as $e) {
            $stats[$e->id] = [
                'equip_id' => $e->id,
                'punts' => 0,
                'gf' => 0,
                'gc' => 0,
                'dg' => 0,
            ];
        }

        $partits = Partit::all();

        foreach ($partits as $p) {
            $l = $p->local_id;
            $v = $p->visitant_id;

            $gl = (int) $p->gols; // solo un campo goles
            $gv = 0;               // visitante no tiene goles

            // goles
            $stats[$l]['gf'] += $gl;
            $stats[$l]['gc'] += $gv;
            $stats[$v]['gf'] += $gv;
            $stats[$v]['gc'] += $gl;

            // puntos (3-1-0)
            if ($gl > $gv) {
                $stats[$l]['punts'] += 3;
            } elseif ($gl < $gv) {
                $stats[$v]['punts'] += 3;
            } else {
                $stats[$l]['punts'] += 1;
                $stats[$v]['punts'] += 1;
            }
        }

        // dg
        foreach ($stats as &$row) {
            $row['dg'] = $row['gf'] - $row['gc'];
        }
        unset($row);

        // Ordena mejor -> peor
        $rows = array_values($stats);
        usort($rows, function ($a, $b) {
            return
                $b['punts'] <=> $a['punts'] ?:
                $b['dg']    <=> $a['dg'] ?:
                $b['gf']    <=> $a['gf'] ?:
                $a['equip_id'] <=> $b['equip_id'];
        });

        // Converteix a [equip_id => pos]
        $posicions = [];
        foreach ($rows as $i => $row) {
            $posicions[$row['equip_id']] = $i + 1;
        }

        return $posicions;
    }
}
