<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->float('weight')->default(0)->nullable();
            $table->float('length')->default(0)->nullable();
            $table->float('width')->default(0)->nullable();
            $table->float('height')->default(0)->nullable();
            $table->foreignId('seller_id')->nullable()->constrained()->references('id')->on('users');
            $table->bigInteger('sold')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_bundle')->default(false);
            $table->boolean('is_combo')->default(false);
            $table->string('combo_discounts')->nullable();
            $table->string('item_id')->nullable();
            $table->string('axapta_code')->nullable();
            $table->string('barcode')->nullable();
            $table->string('primary_vendor_id')->nullable();
            $table->string('thumbnail')->nullable();
            $table->foreignId('manufacturer_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('stock');
            $table->integer('minimum_stock')->default(0);
            $table->double('price');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_point')->default(true);
            $table->boolean('up_selling')->default(false); # Combo price //TODO
            $table->boolean('on_sale')->default(false);
            $table->double('before_price')->default(0);
            $table->boolean('is_hot')->default(false);
            $table->double('hot_price')->nullable();
            $table->timestamp('hot_starts_at')->nullable();
            $table->timestamp('hot_ends_at')->nullable();
            $table->timestamp('sale_ends_at')->nullable();
            $table->boolean('return_allowed')->default(false);
            $table->integer('return_duration')->default(0);
            $table->string('return_policy')->nullable();
            $table->integer('reward_points')->default(0);
            $table->string('bundle_image')->nullable();
            $table->timestamp('bundle_start')->nullable();
            $table->timestamp('bundle_end')->nullable();
            $table->integer('combo_2')->nullable();
            $table->integer('combo_3')->nullable();
            $table->integer('combo_4')->nullable();
            $table->integer('combo_5')->nullable();
            $table->integer('combo_5_free')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
