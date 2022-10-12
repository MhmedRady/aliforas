<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('order_status', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['new', 'processing', 'payment', 'review', 'completed', 'cancelled', 'declined'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('status_id')->nullable()->default(1)->constrained('order_status')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('user_address_id')->nullable()->constrained()->references('id')->on('user_addresses')->nullOnDelete();

            $table->string('shipping_amount')->nullable();
            $table->string('ship_to')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamps();
//            $table->string('first_name');
//            $table->string('last_name');
//            $table->string('phone');
//            $table->string('email');
//            $table->integer('country_id');
//            $table->string('address');
//            $table->string('lat')->nullable()->default(null);
//            $table->string('lng')->nullable()->default(null);
//            $table->integer('city_id');
//            $table->string('state')->nullable();
//            $table->json('location')->nullable();
//            $table->integer('postal_code')->nullable();
//            $table->foreignId('state_id')->nullable()->default(1)->constrained()->references('id')->on('order_status');
//            $table->bigInteger('code');
//            $table->integer('company_id')->nullable();
//            $table->integer('zone_id')->nullable();
//            $table->foreignId('user_address_id')->nullable()->constrained()->nullOnDelete();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('seller_id')->nullable()->constrained()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->references('id')->on('products')->nullOnDelete();
            $table->string('attribute_id')->default(0);

            $table->integer('quantity');
            $table->double('price');
            $table->double('total');

            $table->double('price_after')->nullable()->default(null);
            $table->string('coupon')->nullable()->default(null);
            $table->double('discount')->nullable()->default(0);
            $table->string('discount_type')->nullable()->default(null);
            $table->integer('reward_points')->default(0);
            $table->integer('is_return')->nullable();
            $table->integer('return_reason_id')->nullable();
            $table->timestamp('return_date')->nullable();
            $table->integer('return_bank')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('order_status');
    }

}
