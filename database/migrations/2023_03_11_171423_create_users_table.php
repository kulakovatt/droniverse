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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('login');
            $table->text('password');
            $table->text('email');
            $table->unsignedBigInteger('id_discount')->default('1');
            $table->foreign('id_discount')->references('id')->on('discounts');
            $table->integer('verify_code');
            $table->boolean('is_active')->default(false);
            $table->integer('role')->default(0);
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
};
