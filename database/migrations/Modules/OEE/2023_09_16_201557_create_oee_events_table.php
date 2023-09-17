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
        Schema::create('oee_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oee_resource_id')->constrained()->nullable(); // idrecurso
            $table->foreignId('oee_events_type_id')->constrained()->nullable(); // tipo
            $table->foreignId('oee_events_message_id')->constrained()->nullable(); // idmensagem
            $table->date('date')->nullable(); // data
            $table->string('hour', 8)->nullable(); // hora
            $table->date('ref_date')->nullable(); // dataref
            $table->string('ref_hour', 8)->nullable(); // horaref
            $table->string('operator', 10)->nullable(); // operador
            $table->integer('shift')->nullable(); // turno
            $table->integer('cycle_piece')->nullable(); // pecaciclo
            $table->integer('cycle_pattern')->nullable(); // ciclopadrao
            $table->index(['ref_date', 'oee_resource_id'], 'ref_date+oee_resource_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
