<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMobileTokensTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_mobile_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->caonstrained('users')->nullOnDelete();
            $table->string('device_key')->nullable();
            $table->string('device_type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_mobile_tokens');
    }
}
