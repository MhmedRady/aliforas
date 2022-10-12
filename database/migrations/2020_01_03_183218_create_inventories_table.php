<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('areas')->nullable();
            $table->timestamps();
        });
        Schema::create('inventory_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->bigInteger('inventory_id');
            $table->string('name');
            $table->timestamps();
            $table->foreign('locale')->references('locale')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_translations');
        Schema::dropIfExists('inventories');
    }
}
