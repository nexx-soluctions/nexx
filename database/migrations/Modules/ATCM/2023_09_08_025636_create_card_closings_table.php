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
        Schema::create('card_closings', function (Blueprint $table) {
            $table->id();
            $table->boolean('completed')->default(false);
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('card_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_closings');
    }
};
