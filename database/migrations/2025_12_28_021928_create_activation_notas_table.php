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
            $table->enum('installation_session', ['Pagi', 'Siang'])->nullable();
            $table->string('ao', 255)->nullable();
            $table->string('sid', 255)->nullable();
            $table->string('pe', 255)->nullable();
            $table->string('interface', 255)->nullable();
            $table->string('ip_wan', 255)->nullable();
            $table->string('ip_backhaul', 255)->nullable();
            $table->enum('hub_type', ['Mangoesky', 'iDirect'])->nullable();
            $table->string('nms_id', 255)->nullable();
            $table->timestamp('create_nms_date')->nullable();
            $table->string('ip_lan', 255)->nullable();
            $table->string('subnet_mask_lan', 255)->nullable();
            $table->decimal('sqf', 5, 2)->nullable();
            $table->decimal('esno', 5, 2)->nullable();
            $table->enum('los', ['Bersih', 'Terhalang'])->nullable();
            $table->enum('antena_diameter', ['1.2', '1.8'])->nullable();
            $table->string('lft_id', 255)->nullable();
            $table->decimal('cn', 5, 2)->nullable();
            $table->string('esn_modem', 255)->nullable();
            $table->enum('antena_type', ['KU-BAND V61', 'KU-BAND V80'])->nullable();
            $table->text('technician_note')->nullable();
            $table->string('cacti_url', 255)->nullable();
            $table->enum('sensor_status', ['Online', 'Tidak Stabil', 'Offline'])->nullable();
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
