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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('username', 255)->unique();
            $table->string('name', 255);
            $table->string('company_representative_name', 255)->nullable();
            $table->enum('customer_type', ['PT.', 'CV.', 'Koperasi', 'Instansi Pendidikan', 'Instansi Pemerintah', 'Perorangan']);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('phone', 255);
            $table->string('npwp', 255);
            $table->enum('source_information', ['Media Sosial', 'Web', 'Sales']);
            $table->foreignId('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->string('province_id', 255)->references('id')->on('provinces')->onDelete('cascade');
            $table->string('city_id', 255)->references('id')->on('cities')->onDelete('cascade');
            $table->string('district_id', 255)->references('id')->on('districts')->onDelete('cascade');
            $table->string('village_id', 255)->references('id')->on('villages')->onDelete('cascade');
            $table->string('rt', 255);
            $table->string('rw', 255);
            $table->string('postal_code', 255);
            $table->string('latitude', 255);
            $table->string('longitude', 255);
            $table->string('full_address', 255);
            $table->string('contact_name', 255);
            $table->string('contact_email', 255);
            $table->string('contact_phone', 255);
            $table->string('contact_position', 255);
            $table->string('npwp_document_url', 255);
            $table->string('nib_document_url', 255)->nullable();
            $table->string('sk_document_url', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
