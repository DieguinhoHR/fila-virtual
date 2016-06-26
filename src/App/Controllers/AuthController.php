<?php
namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

class AuthController extends BaseController implements ControllerProviderInterface 
{
	public function connect(Application $app)
	{		       
		$this->controllers->get('/login', function(Application $app) {			
			return $app['twig']->render('auth/login.twig');
		});	  
		return $this->controllers;
	}
}
