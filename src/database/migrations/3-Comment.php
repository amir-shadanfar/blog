<?php

require "../../public/index.php";

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('comments', function ($table) {
    $table->increments('id');
    $table->string('content');
    $table->integer('blog_id')->unsigned();
    $table->timestamps();

    $table->foreign('blog_id')
        ->references('id')
        ->on('blogs')
        ->onDelete('cascade');
});