<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('national_id')->nullable();
            $table->string('employer')->nullable();
            $table->string('age')->nullable();

            $table->integer('country_id')->nullable();
            $table->string('address')->nullable();
//            $table->integer('flat')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('state_id')->nullable();
            $table->integer('postal_code')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
