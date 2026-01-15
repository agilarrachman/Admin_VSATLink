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
        Schema::create('activation_notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('current_status_id')->references('id')->on('activation_statuses')->onDelete('cascade');
            $table->timestamp('installation_date')->nullable();
            $table->timestamp('activation_date')->nullable();
            $table->string('activation_document_url', 255)->nullable();
            $table->boolean('is_ttd')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activation_notas');
    }
};
