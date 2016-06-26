<?php
namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

use Symfony\Component\HttpFoundation\Request;

use App\Core\Domain\Room;

class RoomController extends BaseController implements ControllerProviderInterface 
{
	public function connect(Application $app)
	{			
		$this->list($app);
		$this->store($app);
		$this->edit($app);		
		$this->delete($app);
		return $this->controllers;
	}

	private function list(Application $app)
	{	
		$this->controllers->get('list', function (Request $request, Application $app) {           		
          	return $app['twig']->render('room/list.twig', [
          		'rooms' =>  $app['roomService']->findAll()
       		]);
        })->bind("room.list");
	}

	private function store(Application $app)
	{		   
		$this->controllers->match('register', function (Request $request) use ($app) {					
			if ('POST' == $request->getMethod()) {			
				$room = new Room();		
				$room->setNumber($request->get('number'));
				$room->setReserved($request->get('reserved'));				

				$app['roomService']->save($room);						
				return $app['twig']->render('room/list.twig', array(
        			'rooms' => $app['roomService']->findAll()
       			));		
			}
			return $app['twig']->render('room/register.twig');			
		})->bind("room.register");		
	}

	private function edit(Application $app)
	{		
    	$this->controllers->match("/edit/{id}", function($id, Request $request) use ($app) {     
    		if ('POST' == $request->getMethod())   		{    			
				$room = new Room();					
				$room->setId($request->get('id'));
				$room->setNumber($request->get('number'));
				$room->setReserved($request->get('reserved'));	
				$app['roomService']->update($room);	
    			return $app['twig']->render('room/list.twig', array(
    				'rooms' => $app['roomService']->findAll()
   				));    		
    		}
        	$room = $app['roomService']->findBy($id);	

        	foreach($room as $r) 

        	return $app['twig']->render('room/edit.twig', array(
        		'id'       => $r->id,
        		'number'   => $r->number,
        		'reserved' => $r->reserved        	
       		));
    	});			 
	}
	
	private function delete(Application $app)
	{		
    	$this->controllers->match("/delete/{id}", function($id) use ($app) {        		
        	$app['roomService']->delete($id);	
        	return $app['twig']->render('room/list.twig', array(
        	 	'rooms' => $app['roomService']->findAll()
       		));
    	});			 
	}
}