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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('image_url', 255);
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->text('description');
            $table->integer('device_weight')->default(0);
            $table->integer('otc_cost')->default(0);
            $table->integer('mrc_cost')->default(0);
            $table->integer('monthly_quota')->default(0);
            $table->integer('subscription_duration')->default(0);
            $table->string('speed', 255);
            $table->string('segmentation', 255);
            $table->string('free_airtime', 255);
            $table->boolean('is_promo')->default(false);
            $table->string('antena', 255);
            $table->string('lnb', 255);
            $table->string('buc', 255);
            $table->string('modem', 255);
            $table->string('access_point', 255)->nullable();
            $table->string('performance_benefit_title', 255);
            $table->text('performance_benefit_description');            
            $table->string('connectivity_benefit_title', 255);
            $table->text('connectivity_benefit_description');            
            $table->string('segmentation_benefit_title', 255);
            $table->text('segmentation_benefit_description');            
            $table->string('added_value_benefit_title', 255);
            $table->text('added_value_benefit_description');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
