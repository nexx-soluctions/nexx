<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EnterpriseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\Enterprise::factory()
        //     ->hasAttached(
        //         User::factory()->create([
        //             'username' => 'gustavoql',
        //             'name' => 'Gustavo Lobo',
        //             'email' => 'gustavoqe.75@gmail.com',
        //             'enterprise_id' => 1,
        //             'password' => Hash::make('1234'),        
        //         ])
        //     )
        //     ->create([
        //         'name' => 'Nexx Soluctions',
        //     ]
        // );

        \App\Models\Enterprise::factory()->create([
            'name' => 'Nexx Soluctions',
            'active' => true, 
            'dns' => 'https://nexx.lobofoltran.com',
            'db_url' => 'veecco61_db_troy',
            'db_host' => '162.241.203.141',
            'db_port' => '3306',
            'db_user' => 'veecco61_gustavoql',
            'db_password' => env('DB_ENTERPRISE_PASSWORD'),
        ]);

        \App\Models\Enterprise::factory()->create([
            'name' => 'VEEC Soluctions',
            'active' => true, 
            'dns' => 'https://veec.lobofoltran.com',
            'db_url' => 'veecco61_db_troy',
            'db_host' => '162.241.203.141',
            'db_port' => '3306',
            'db_user' => 'veecco61_gustavoql',
            'db_password' => env('DB_ENTERPRISE_PASSWORD'),
        ]);
    }
}
