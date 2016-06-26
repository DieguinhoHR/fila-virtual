<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define("ROOT_PATH", realpath(__DIR__ . "/../../"));
require_once __DIR__ . "/../../vendor/autoload.php";

require_once 'config/connect.php';

use App\Core\Domain\{User, Room};
use App\Core\Repositories\{UserPersistence, RoomPersistence};
use App\Core\Services\{UserService, RoomService};

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

$app['roomService'] = function() {
	$databaseConfig = [
		'dsn'      => 'host=localhost;dbname=fila_virtual', 
		'user'     => 'root',
		'password' => 'secret'
	];

    $mysqlConnector = new MysqlConnector();
	$mysqlConnector->connect($databaseConfig);

	$roomPersistence = new RoomPersistence($mysqlConnector);
	$roomService = new RoomService($roomPersistence);

	return $roomService;
};

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => ROOT_PATH . '/views',
));

$app->boot();