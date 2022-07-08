<?php

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Eloquent
$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "127.0.0.1",
    "database" => "blog",
    "username" => "root",
    "password" => "password"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();