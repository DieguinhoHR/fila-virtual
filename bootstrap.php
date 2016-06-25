<?php

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('America/Sao_Paulo');

require_once 'vendor/autoload.php';
require_once 'config/connect.php';

$app = new \Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__ . '/views'
));
// use App\Infrastrutucture\Database\Connectors\{Connector, MysqlConnector};
// use App\Core\Domain\User;
// use App\Core\Repositories\UserPersistence;

// $connect  = new UserPersistence(new MysqlConnector()->createConnect($connect));
// $connect->findAll();