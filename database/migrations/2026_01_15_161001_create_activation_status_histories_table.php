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
        Schema::create('activation_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activation_status_id')->references('id')->on('activation_statuses')->onDelete('cascade');
            $table->foreignId('activation_nota_id')->references('id')->on('activation_notas')->onDelete('cascade')->nullable();
            $table->string('note', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activation_status_histories');
    }
};
