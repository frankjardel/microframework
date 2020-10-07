<?php

namespace App\Controllers;

use Core\BaseController;

class HomeController extends BaseController
{
	public function index()
	{
		$this->setPageTitle('Home');

		$this->view->name = "YCLE";

		$this->renderView('home/index', 'layout');
	}
}
