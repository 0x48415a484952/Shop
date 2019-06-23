<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationTable extends Migration
{
    // private $avatars = ['/storage/avatar.jpg', '/storage/avatar2.jpg', '/storage/avatar3', '/storage/avatar4'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::enableForeignKeyConstraints();
        Schema::create('information', function (Blueprint $table) {
            
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('job');
            $table->date('birth_date');
            $table->string('image')->default('/storage/avatar.jpg');
            $table->string('level');
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
        Schema::dropIfExists('information');
    }
}
