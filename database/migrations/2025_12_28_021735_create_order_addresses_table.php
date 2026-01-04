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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('province_id', 255)->references('id')->on('provinces')->onDelete('cascade');
            $table->string('city_id', 255)->references('id')->on('cities')->onDelete('cascade');
            $table->string('district_id', 255)->references('id')->on('districts')->onDelete('cascade');
            $table->string('village_id', 255)->references('id')->on('villages')->onDelete('cascade');
            $table->string('rt', 255);
            $table->string('rw', 255);
            $table->string('postal_code', 255);
            $table->string('full_address', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
