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
            $table->string('name')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('is_verified')->default(0);
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('username')->nullable();
            $table->string('address')->nullable();
            $table->string('dateofbirth')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('otp')->nullable();
            $table->string('profileimage')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('other_referral_code')->nullable();
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
