<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code');
            $table->enum('type', ['p', 'f']);
            $table->integer('amount');
            $table->date('start');
            $table->date('end');
            $table->integer('usage_times');
            $table->integer('user_usage_times');
            $table->integer('min_order');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

        Schema::create('coupon_product', function (Blueprint $table) {
            $table->foreignId('coupon_id')->constrained();
            $table->foreignId('product_id')->constrained();
        });

        Schema::create('coupon_category', function (Blueprint $table) {
            $table->foreignId('coupon_id')->constrained();
            $table->foreignId('category_id')->constrained();
        });

        Schema::create('coupon_bundle', function (Blueprint $table) {
            $table->foreignId('coupon_id')->constrained();
            //todo check this
            //$table->foreignId('bundle_id')->constrained();
            $table->bigInteger('bundle_id');
        });

        Schema::create('coupons_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coupon_id')->constrained();
            $table->foreignId('user_id')->constrained();
            //todo check this
            //$table->foreignId('order_id')->constrained();
            $table->bigInteger('order_id');
            $table->string('coupon');
            $table->integer('amount_before');
            $table->integer('amount_after')->nullable();
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
        Schema::dropIfExists('coupons');
        Schema::dropIfExists('coupon_product');
        Schema::dropIfExists('coupon_category');
        Schema::dropIfExists('coupon_bundle');
        Schema::dropIfExists('coupons_logs');
    }
}
