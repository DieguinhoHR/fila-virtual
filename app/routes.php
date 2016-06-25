<?php 

$app->get('/', function() use ($app) {			
	return $app['twig']->render('index.twig');
});

$app->get('/auth/register', function() use ($app) {				
 	return $app['twig']->render('auth/register.twig');
});

$app->get('/auth/login', function() use ($app) {				
 	return $app['twig']->render('auth/login.twig');
});

// $app->get('/auth', function() use ($app) {				
// 	return $app['twig']->render('users.twig');
// });

// $app->get('/auth/register', function() use ($app) {				
// 	return $app['twig']->render('register.twig');
// });
return $app;