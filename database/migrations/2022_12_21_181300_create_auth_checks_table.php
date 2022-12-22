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
        Schema::create('auth_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('check')->default(0);
            $table->timestamps();
        });
        $data = array('id'=>NULL, 'check'=>0);
        DB::table('auth_checks')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_checks');
    }
};
