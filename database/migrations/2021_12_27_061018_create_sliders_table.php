<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained();
            $table->string('image');
            $table->enum('is_banner',[1,0])->default(0);
            $table->enum('code', ['slider', 'banner'])->nullable()->default('slider');
            $table->enum('is_active',[1,0])->default(1);
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
        Schema::dropIfExists('sliders');
    }
}
