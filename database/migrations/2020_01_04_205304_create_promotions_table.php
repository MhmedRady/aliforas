<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{

    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('type', ['p', 'f']);
            $table->integer('amount');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('promotion_product', function (Blueprint $table) {
            $table->integer('promotion_id');
            $table->integer('product_id');
        });

        Schema::create('promotion_category', function (Blueprint $table) {
            $table->integer('promotion_id');
            $table->integer('category_id');
        });

        Schema::create('promotion_bundle', function (Blueprint $table) {
            $table->integer('promotion_id');
            $table->integer('bundle_id');
        });

        Schema::create('promotion_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('promotion_id')->nullable();
            $table->string('promotion_name');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
        Schema::dropIfExists('promotion_product');
        Schema::dropIfExists('promotion_category');
        Schema::dropIfExists('promotion_bundle');
        Schema::dropIfExists('promotion_logs');
    }
}
