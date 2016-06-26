<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL | E_STRICT);
// date_default_timezone_set('America/Sao_Paulo');

define("ROOT_PATH", realpath(__DIR__ . "/../../"));
require_once __DIR__ . "/../../vendor/autoload.php";

require_once 'config/connect.php';

use App\Core\Domain\User;
use App\Core\Repositories\UserPersistence;
use App\Core\Services\UserService;
use App\Infrastrutucture\Database\Connectors\MysqlConnector;

$app = new \Silex\Application();
$app['debug'] = true;

/**
 * Service Container
 *
 * @return ClienteService
 */
$app['userService'] = function() {
	$databaseConfig = [
		'dsn'      => 'host=localhost;dbname=fila_virtual', 
		'user'     => 'root',
		'password' => 'secret'
	];

    $mysqlConnector = new MysqlConnector();
	$mysqlConnector->connect($databaseConfig);

	$userPersistence = new UserPersistence($mysqlConnector);
	$userService = new UserService($userPersistence);

	return $userService;
};

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => ROOT_PATH . '/views',
));

$app->boot();