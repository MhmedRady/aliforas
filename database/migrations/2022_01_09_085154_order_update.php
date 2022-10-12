<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->after('user_id')->constrained()
                ->references('id')->on('users')->nullOnDelete();
            $table->timestamp('viewed_at')->nullable()->after('admin_id');
            $table->double('total')->default(0)->after('viewed_at');

            $table->double('weights')->default(0)->after('total');

            $table->foreignId('shipping_zone_id')->nullable()->after('user_address_id')->constrained()->references('id')->on('shipping_zones')->nullOnDelete();
            $table->foreignId('branch_id')->nullable()->after('shipping_zone_id')->constrained()->references('id')->on('branches')->nullOnDelete();

        });
//        Schema::table('price_quote_order_items', function (Blueprint $table) {
//            $table->double('price')->default(0)->after('quantity');
//            $table->double('total')->default(0)->after('price');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('price_quote_order_items', function (Blueprint $table) {
//            $table->dropColumn('price');
//        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('admin_id');
            $table->dropColumn(['viewed_at', 'total']);
        });
    }
}
