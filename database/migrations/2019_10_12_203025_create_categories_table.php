<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained()->on('categories')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->boolean('in_header')->default(true);
            $table->string('code')->nullable()->unique();
            $table->string('icon')->nullable();
            $table->string('banner')->nullable();
            $table->string('return_policy')->nullable();
            $table->integer('arrange')->nullable();
            $table->integer('shipping_value')->nullable();
            $table->integer('shipping_type')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
