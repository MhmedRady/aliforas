<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->bigInteger('document_id')->nullable();
//            $table->string('first_name');
//            $table->string('last_name');
//            $table->date('expiry_date');
//            $table->string('state');
//            $table->string('city');
//            $table->text('street');
//            $table->integer('phone');
//            $table->string('building_number');
            $table->string('store')->nullable();
            $table->string('legal_type')->nullable();
//            $table->double('lng');
//            $table->double('lat');
//            $table->string('address');
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
        Schema::dropIfExists('sellers_data');
    }
}
