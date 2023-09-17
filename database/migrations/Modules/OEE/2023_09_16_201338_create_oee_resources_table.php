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
        Schema::create('oee_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oee_product_id')->constrained()->nullable(); // idproduto
            $table->foreignId('oee_line_id')->constrained()->nullable(); // idlinha
            $table->foreignId('oee_operation_id')->constrained()->nullable(); // idop
            $table->foreignId('oee_table_scrap_id')->constrained()->nullable(); // idtabelarefugo
            $table->foreignId('oee_table_stop_id')->constrained()->nullable(); // idtabelaparada
            $table->boolean('active')->default(true); // ativo
            $table->string('description', 50)->nullable();  // descricao
            $table->string('machine', 15)->nullable(); // maquina
            $table->integer('cycle_piece')->nullable(); // pecaciclo
            $table->integer('cycle_time')->nullable(); // tempoclico
            $table->boolean('oee_base')->default(true); // baseoee
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
