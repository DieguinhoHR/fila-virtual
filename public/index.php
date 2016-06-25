<?php

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Sao_Paulo');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/connect.php';

$x = new \App\Infrastrutucture\Database\Connectors\MysqlConnector;

echo $x->connect($connect);