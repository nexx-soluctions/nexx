<?php

namespace Database\Seeders\Modules\ComercialAutomation;

use Illuminate\Database\Seeder;

class DatabaseComercialAutomationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            WaitingListSeeder::class,
            TableSeeder::class,
            CardSeeder::class,
            CardClosingSeeder::class,
            PaymentMethodSeeder::class,
            PaymentSeeder::class,
            ProductSeeder::class,
            AttractionSeeder::class,
            AttractionEntitySeeder::class,
            AttractionQueueSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
        ]);
    }
}
