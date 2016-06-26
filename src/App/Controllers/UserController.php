<?php
namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

use App\Core\Domain\User;

class UserController extends BaseController implements ControllerProviderInterface 
{
	public function connect(Application $app)
	{			
		$this->list($app);
		$this->store($app);
		$this->edit($app);
		$this->update($app);
		$this->delete($app);
		return $this->controllers;
	}

	private function list(Application $app)
	{	
		$this->controllers->get('list', function (Request $request, Application $app) {           
          	return $app['twig']->render('user/list.twig', [
          		'users' =>  $app['userService']->findAll()
       		]);
        })->bind("user.list");
	}

	private function store(Application $app)
	{		   
		$this->controllers->match('register', function (Request $request) use ($app) {		
			if ('POST' == $request->getMethod()) {				
				$this->includeUser(new User(), $request, $app);
				return $app['twig']->render('user/list.twig', array(
        			'users' => $app['userService']->findAll()
       			));		
			}
			return $app['twig']->render('user/register.twig');			
		})->bind("user.register");		
	}

	private function includeUser(User $user, Request $request, $app)
	{		
		$user->setUsername($request->get('username'));
		$user->setEmail($request->get('email'));
		$user->setPassword($request->get('password'));								
		return $app['userService']->save($user);
	}

	private function edit(Application $app)
	{		
    	$this->controllers->get("/edit/{id}", function($id) use ($app) {        		
        	$user = $app['userService']->findBy($id);	

        	foreach($user as $u) 

        	return $app['twig']->render('user/edit.twig', array(
        		'id'       => $u->id,
        		'username' => $u->username,
        		'email'    => $u->email,
        		'password' => $u->password
       		));
    	});			 
	}

	private function update(Application $app)
	{
		$app->post("/edit/{id}", function($id, Request $request) use ($app) {     						
			$user = new User;

			$user->setId($request->get('id'));
			$user->setUsername($request->get('username'));
			$user->setEmail($request->get('email'));
			$user->setPassword($request->get('password'));	   	        	

			$app['userService']->update($user);	

        	return $app['twig']->render('user/list.twig', array(
        		'users' => $app['userService']->findAll()
       		));
    	});
	}

	private function delete(Application $app)
	{		
    	$this->controllers->get("delete/{id}", function($id) use ($app) {        		
        	$app['userService']->delete($id);	
        	return $app['twig']->render('user/list.twig', array(
        	 	'users' => $app['userService']->findAll()
       		));
    	});			 
	}
}