<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnterpriseModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\EnterpriseModule::factory()->create([
            'enterprise_id' => 1,
            'module_id' => 1,
        ]);

        \App\Models\EnterpriseModule::factory()->create([
            'enterprise_id' => 1,
            'module_id' => 2,
        ]);

        \App\Models\EnterpriseModule::factory()->create([
            'enterprise_id' => 1,
            'module_id' => 3,
        ]);

        \App\Models\EnterpriseModule::factory()->create([
            'enterprise_id' => 2,
            'module_id' => 1,
        ]);

        \App\Models\EnterpriseModule::factory()->create([
            'enterprise_id' => 2,
            'module_id' => 3,
        ]);
    }
}
