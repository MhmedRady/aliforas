<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('field_id')->constrained();
            $table->string('name');
            $table->boolean('required')->default(false);
            $table->timestamps();
        });

        Schema::create('option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_id')->constrained();
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('option_product', function (Blueprint $table) {
            $table->foreignId('option_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('option_value_id')->constrained();
        });

    }

    public function down()
    {
        Schema::dropIfExists('option_product');
        Schema::dropIfExists('option_values');
        Schema::dropIfExists('options');
        Schema::dropIfExists('fields');
    }
}
