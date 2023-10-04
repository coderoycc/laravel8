<?php

namespace Database\Seeders;

use App\Models\Etapa;
use Illuminate\Database\Seeder;

class EtapaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Etapa::factory()->create([
            'idEtapa' => 1,
            'detalle' => 'INDUCCIÓN',
            'etapaSiguiente' => 2
        ]);
        Etapa::factory()->create([
            'idEtapa' => 2,
            'detalle' => 'CONSOLIDACIÓN',
            'etapaSiguiente' => 3
        ]);
        Etapa::factory()->create([
            'idEtapa' => 3,
            'detalle' => 'CONTINUACIÓN I',
            'etapaSiguiente' => 4
        ]);
        Etapa::factory()->create([
            'idEtapa' => 4,
            'detalle' => 'REINDUCCIÓN I',
            'etapaSiguiente' => 5
        ]);
        Etapa::factory()->create([
            'idEtapa' => 5,
            'detalle' => 'CONTINUACIÓN II',
            'etapaSiguiente' => 6
        ]);
        Etapa::factory()->create([
            'idEtapa' => 6,
            'detalle' => 'REINDUCCIÓN II',
            'etapaSiguiente' => 7
        ]);
        Etapa::factory()->create([
            'idEtapa' => 7,
            'detalle' => 'MANTENIMIENTO',
            'etapaSiguiente' => 0
        ]);
    }
}
