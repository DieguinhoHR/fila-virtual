<?php
namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

class AuthController extends BaseController implements ControllerProviderInterface 
{
	public function connect(Application $app)
	{		       
		$this->controllers->match('/login', function(Application $app, Request $request) {			
			if ('POST' == $request->getMethod()) {		
				$password = sha1($request->get('password'));		
				$email = $request->get('email')	;
				$result = $app['authService']->findBy($request->get('email'), $password);

				if ($result == true) {				
			        
					return $app['twig']->render('room/list.twig', [
	          			'rooms' =>  $app['roomService']->findAll()
	       			]);
				}
			}
			return $app['twig']->render('auth/login.twig');
		});	  		
		return $this->controllers;
	}
}
