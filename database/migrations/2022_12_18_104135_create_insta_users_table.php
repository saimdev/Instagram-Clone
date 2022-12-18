<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insta_users', function (Blueprint $table) {
            $table->id();
            $table->string('username',20);
            $table->string('posts',20);
            $table->string('followers',20);
            $table->string('following',20);
            $table->string('profilepicture',20);
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
        Schema::dropIfExists('insta_users');
    }
};
