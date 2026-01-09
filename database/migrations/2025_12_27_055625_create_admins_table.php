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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username', 255)->unique();
            $table->string('profile_picture', 255);
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('phone', 255);
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->enum('role', ['Super Admin', 'Sales Admin', 'Logistic Admin', 'Service Activation Admin']);
            $table->string('division', 255);
            $table->string('position', 255);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
