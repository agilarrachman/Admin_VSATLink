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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('current_status_id')->references('id')->on('order_statuses')->onDelete('cascade');
            $table->foreignId('order_contact_id')->nullable()->references('id')->on('order_contacts')->onDelete('cascade');
            $table->foreignId('order_address_id')->nullable()->references('id')->on('order_addresses')->onDelete('cascade');
            $table->foreignId('activation_nota_id')->nullable()->references('id')->on('activation_notas')->onDelete('cascade');
            $table->foreignId('activation_address_id')->references('id')->on('activation_addresses')->onDelete('cascade')->nullable();
            $table->string('unique_order')->unique();
            $table->enum('shipping', ['Ambil Ditempat', 'JNE'])->nullable();
            $table->integer('product_cost')->default(0)->nullable();
            $table->integer('installation_service_cost')->default(0)->nullable();
            $table->integer('installation_transport_cost')->default(0)->nullable();
            $table->integer('shipping_cost')->default(0)->nullable();
            $table->integer('tax_cost')->default(0)->nullable();
            $table->integer('total_cost')->default(0)->nullable();
            $table->string('payment_method', 255)->nullable();
            $table->boolean('payment_success')->default(false);
            $table->timestamp('payment_date')->nullable();
            $table->string('midtrans_order_id', 255)->nullable();
            $table->string('payment_token', 255)->nullable();
            $table->string('invoice_document_url', 255)->nullable();
            $table->string('modem_sn', 255)->nullable();
            $table->string('router_sn', 255)->nullable();
            $table->string('buc_sn', 255)->nullable();
            $table->string('lnb_sn', 255)->nullable();
            $table->string('antena_sn', 255)->nullable();
            $table->string('adaptor_sn', 255)->nullable();
            $table->string('jne_tracking_number', 255)->nullable();
            $table->string('packing_list_id', 255)->nullable();
            $table->string('packing_list_document_url', 255)->nullable();
            $table->string('delivery_note_document_url', 255)->nullable();
            $table->string('proof_of_delivery_image_url', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
