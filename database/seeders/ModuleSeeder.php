<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Module::factory()->create([
            'name' => 'Configurador',
            'acronym' => 'ADM',
            'active' => true,
        ]);

        \App\Models\Module::factory()->create([
            'name' => 'Automação Comercial',
            'acronym' => 'ATCM',
            'active' => true,
        ]);

        \App\Models\Module::factory()->create([
            'name' => 'Chamados',
            'acronym' => 'CHMD',
            'active' => true,
        ]);
    }
}
