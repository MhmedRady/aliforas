<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('combo_id')->unsigned();
            $table->foreign('combo_id')->references('id')->on('combos');
            $table->bigInteger('num');
            $table->bigInteger('percentage');
            $table->boolean('one_piece_free')->default(false);
            $table->boolean('shipping_free')->default(false);
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
        Schema::dropIfExists('combo_values');
    }
}
