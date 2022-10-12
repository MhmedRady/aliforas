<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PriceQuoteUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('price_quote_orders', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->after('email')->constrained()
                ->references('id')->on('users')->nullOnDelete();
            $table->timestamp('viewed_at')->nullable()->after('admin_id');
            $table->double('total')->default(0)->after('viewed_at');
        });
        Schema::table('price_quote_order_items', function (Blueprint $table) {
            $table->double('price')->default(0)->after('quantity');
            $table->double('total')->default(0)->after('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('price_quote_order_items', function (Blueprint $table) {
            $table->dropColumn('price');
        });
        Schema::table('price_quote_orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('admin_id');
            $table->dropColumn(['viewed_at', 'total']);
        });
    }
}
