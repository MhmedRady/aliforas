<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('profile_image')->nullable();

            $table->tinyInteger('age')->default(0);
            $table->string('national_id')->nullable();
            $table->string('employer')->nullable();

            $table->boolean('is_admin')->default(false);
            $table->boolean('is_seller')->default(false);
            $table->boolean('is_active')->default(false);

            $table->string('verification_code')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->json('order_status_permissions')->nullable();
            $table->string('api_token', 60)->nullable()->unique();
//            $table->foreignId('role_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
