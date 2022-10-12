<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowForInProductsTable extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('show_for')->default('both')->nullable()->comment('Display Product For Certain User');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
        });
    }
}
