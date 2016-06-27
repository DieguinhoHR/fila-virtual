<?php
namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class HomeController extends BaseController implements ControllerProviderInterface 
{
	public function connect(Application $app)
	{		 
		$this->controllers->get('/', function(Application $app) {				    		
			return $app['twig']->render('home.twig');
		});	    	
		return $this->controllers;
	}
}
