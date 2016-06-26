<?php

define("ROOT_PATH", realpath(__DIR__ . "/../../"));
require_once __DIR__ . "/../../vendor/autoload.php";

$app = new \Silex\Application();
$app['debug'] = true;
$app['baseUrl'] = Config\Config::getInstance()->getBaseUrl();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => ROOT_PATH . '/views',
));

$app->boot();