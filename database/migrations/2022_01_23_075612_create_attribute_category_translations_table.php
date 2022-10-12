<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_category_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale');
            $table->foreignId('attribute_category_id')->constrained()->references('id')->on('attribute_categories');
            $table->string('name');
//            $table->string('meta_title')->nullable();
//            $table->string('meta_keywords')->nullable();
//            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('branch_translations');
    }
}

