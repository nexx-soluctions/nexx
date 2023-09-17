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
        Schema::create('oee_resources_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oee_group_id')->constrained()->nullable(); // idgrupo
            $table->foreignId('oee_resource_id')->constrained()->nullable(); // idrecurso
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources_groups');
    }
};
