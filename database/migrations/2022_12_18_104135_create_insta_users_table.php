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
            $table->string('name',20);
            $table->string('email',50);
            $table->string('posts',20);
            $table->string('followers',20);
            $table->string('following',20);
            $table->text('profilepicture');
            $table->text('website');
            $table->text('bio');
            $table->string('phone',20);
            $table->string('gender',20);
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
