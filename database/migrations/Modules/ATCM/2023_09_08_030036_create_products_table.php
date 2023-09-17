<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atm_categories_product_id')->constrained();
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->string('description');
            $table->string('value');
            $table->string('image_url');
            // Considerar trocar para permissions
            $table->string('show_to_waiter');
            $table->string('show_to_kitchen');
            $table->string('show_to_cashier');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
