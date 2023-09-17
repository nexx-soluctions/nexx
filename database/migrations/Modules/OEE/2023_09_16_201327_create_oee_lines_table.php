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
        Schema::create('oee_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oee_plant_id')->constrained()->nullable(); // idplanta
            $table->string('description', 50)->nullable(); // descricao
            $table->string('cost_center', 11)->nullable(); // ccusto
            $table->boolean('oee_base')->default(true); // base oee
            $table->boolean('active')->default(true); // ativo
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lines');
    }
};
