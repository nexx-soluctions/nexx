<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'username' => 'gustavoql',
            'name' => 'Gustavo Lobo',
            'email' => 'gustavoqe.75@gmail.com',
            'enterprise_id' => 1,
            'password' => Hash::make('1234'),
        ]);

        \App\Models\User::factory()->create([
            'username' => 'carlosa',
            'name'  => 'Carlos de Almeida',
            'email' => 'carlosa@veec.com.br',
            'enterprise_id' => 2,
            'password' => Hash::make('1234'),
        ]);

        \App\Models\User::factory()->create([
            'username' => 'danysg',
            'name'  => 'Dany Sullivan',
            'email' => 'deanysg@veec.com.br',
            'enterprise_id' => 2,
            'password' => Hash::make('1234'),
        ]);

        \App\Models\User::factory()->create([
            'username' => 'gabrielpg',
            'name'  => 'Gabriel Paulo Gomes',
            'email' => 'gabrielpg@veec.com.br',
            'enterprise_id' => 2,
            'password' => Hash::make('1234'),
        ]);
    }
}
