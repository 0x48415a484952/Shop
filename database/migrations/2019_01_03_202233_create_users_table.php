<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('job')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('image')->default('/storage/avatar.jpg');
            $table->integer('user_code')->nullable();
            $table->string('social_id')->unique();
            $table->string('phone')->unique();
            $table->string('phone_verification_code');
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('user');
            $table->string('level')->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
