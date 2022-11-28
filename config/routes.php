<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(

	// rutes de Proves
	'/test'  => 'test#index',
	'/test2' => 'test2#index',
	'/check' => 'test#check',

	// rutes per taula USERS
	'/listuser' => 'user#index',
	'/adduser'  => 'user#add',
	'/edituser' => 'user#edit',   // 'UserController.php?id=3' ... rebrà per GET la ID ... function editAction($_GET[id])
	'/deluser'  => 'user#del',

	// rutes per taula TASKS
	'/listtask' => 'task#index',
	'/addtask'  => 'task#add',
	'/edittask' => 'task#edit',
	'/deltask'  => 'task#del'
	
);
