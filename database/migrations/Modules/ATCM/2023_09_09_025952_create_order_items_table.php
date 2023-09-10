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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['Teste1', 'Teste2']);
            $table->string('value');
            $table->integer('amount');
            $table->string('observations');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->nullable()->constrained('products');
            $table->foreignId('attraction_id')->nullable()->constrained('attractions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
