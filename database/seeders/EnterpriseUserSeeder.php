<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnterpriseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\EnterpriseUser::factory()->create([
            'user_id' => 1,
            'enterprise_id' => 1,
        ]);

        \App\Models\EnterpriseUser::factory()->create([
            'user_id' => 1,
            'enterprise_id' => 2,
        ]);

        \App\Models\EnterpriseUser::factory()->create([
            'user_id' => 2,
            'enterprise_id' => 2,
        ]);

        \App\Models\EnterpriseUser::factory()->create([
            'user_id' => 3,
            'enterprise_id' => 2,
        ]);

        \App\Models\EnterpriseUser::factory()->create([
            'user_id' => 4,
            'enterprise_id' => 2,
        ]);
    }
}
