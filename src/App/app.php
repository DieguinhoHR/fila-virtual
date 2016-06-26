<?php

$app->mount('/', new App\Controllers\HomeController());
$app->mount('/auth', new App\Controllers\AuthController());
$app->mount('/user', new App\Controllers\UserController());
