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
            $table->integer('role_id')->unsigned();
            $table->string('title');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mob_no')->unique();
            $table->enum('gender', ['1', '2'])->comment('1=Male, 2=Female');
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->integer('total_exp_year')->nullable();
            $table->integer('total_exp_month')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('image')->nullable();
            $table->integer('department_id')->unsigned();
            $table->integer('designation_id')->unsigned();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('user_roles')->onDelete('cascade');
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
