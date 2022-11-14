<?php

class Test2Controller extends ApplicationController
{
	public function indexAction()
	{
		$this->view->message = "hello from test2::index";
	}
	
	public function checkAction()
	{
		echo "hello from test2::check";
	}
}
