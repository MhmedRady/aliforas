<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('is_active')->default(0);
            $table->integer('is_home')->default(0);
            $table->string('product_ids');
            $table->string('start_date')->default(0);
            $table->string('end_date')->default(0);
            $table->integer('discount')->default(0);
            $table->timestamps();
        });

        Schema::create('deal_sections_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('deal_section_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->unique(['locale', 'name', 'slug']);
            $table->timestamps();
            $table->foreign('locale')->references('locale')->on('languages');
            $table->unique(['locale', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deal_sections_translations');
        Schema::dropIfExists('deal_sections');
    }
}
