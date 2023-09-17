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
        Schema::create('oee_stops_types', function (Blueprint $table) {
            $table->id();
            $table->string('description', 50); // descricao
            $table->boolean('planned')->default(true); // planejada
            $table->boolean('maintenance')->default(true); // manutencao
            // faltam parâmetros
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stops_types');
    }
};
