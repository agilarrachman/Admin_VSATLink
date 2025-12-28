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
            $table->string('province_code', 255);
            $table->string('city_code', 255);
            $table->string('district_code', 255);
            $table->string('village_code', 255);
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
