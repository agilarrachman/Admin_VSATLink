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
            $table->date('installation_date')->nullable();
            $table->enum('pe', ['RTR-CONSUMER-7206-E1-B-BGR', 'RTR-ENTERPRISE-ASR1001-XE1-A-JKT'])->nullable();
            $table->string('interface', 255)->nullable();
            $table->string('ip_interface', 255)->nullable()->unique();
            $table->string('ip_dns', 255)->nullable()->unique();
            $table->enum('ip_backhaul', ['IP Private', 'IP Public'])->nullable();
            $table->enum('hub_type', ['iDirect', 'Newtec', 'Hughes HX50', 'Hughes HX90', 'Hughes HX200', 'HTS MP2'])->nullable();
            $table->string('nms_id', 255)->nullable()->unique();
            $table->date('create_nms_date')->nullable();
            $table->string('ip_lan', 255)->nullable()->unique();
            $table->string('subnet_mask_lan', 255)->nullable();
            $table->decimal('sqf', 5, 2)->nullable();
            $table->decimal('esno', 5, 2)->nullable();
            $table->enum('los', ['Bersih', 'Terhalang'])->nullable();
            $table->enum('antena_diameter', ['0.7', '1.2', '1.8'])->nullable();
            $table->string('lft_id', 255)->nullable();
            $table->decimal('cn', 5, 2)->nullable();
            $table->string('esn_modem', 255)->nullable();
            $table->enum('antena_type', ['KU-BAND V61', 'KU-BAND V80'])->nullable();
            $table->text('technician_note')->nullable();
            $table->string('monitoring_url', 255)->nullable();
            $table->timestamp('online_date')->nullable();
            $table->string('monitoring_capture_url', 255)->nullable();
            $table->string('activation_document_url', 255)->nullable();
            $table->boolean('is_document_signed')->default(false);
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
