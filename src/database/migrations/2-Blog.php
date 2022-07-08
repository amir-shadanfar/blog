<?php

require "../../public/index.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('blogs', function ($table) {
    $table->increments('id');
    $table->string('title');
    $table->string('description');
    $table->string('image');
    $table->integer('user_id')->unsigned();
    $table->timestamps();

    $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade');
});