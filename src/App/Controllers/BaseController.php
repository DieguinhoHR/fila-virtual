<?php
namespace App\Controllers;

use Silex\Application;

abstract class BaseController 
{
	protected $controllers;

	public function __construct()
	{
		$app = new Application();
		$this->controllers = $app['controllers_factory'];	   
		return $this->controllers;
	}
}
