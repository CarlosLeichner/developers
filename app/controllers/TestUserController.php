<?php

class TestUserController extends ApplicationController
{
	public function indexAction()
	{
		$this->view->message = "hello from testUserController::index";
	}
	
	public function checkAction()
	{
		echo "hello from testUserController::check";
	}
}
