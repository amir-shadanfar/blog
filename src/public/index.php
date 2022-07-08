<?php

require __DIR__ . '/../vendor/autoload.php';
require_once '../routes/web.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Pecee\SimpleRouter\SimpleRouter;


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

// Start the routing
SimpleRouter::setDefaultNamespace('\App\Controllers');
SimpleRouter::start();