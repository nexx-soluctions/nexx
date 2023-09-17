<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('oee_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oee_resource_id')->constrained()->nullable(); // idrecurso
            $table->foreignId('oee_stops_type_id')->constrained()->nullable(); // idtpchamada
            $table->boolean('planned')->default(true); // planejada
            $table->boolean('maintenance')->default(true); // manutencao
            $table->integer('time')->default(1); // tempo
            $table->integer('amount')->default(1); // quantidade
            $table->timestamp('datetime')->default(DB::raw('CURRENT_TIMESTAMP')); // data hora
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stops');
    }
};
