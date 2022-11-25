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
	'/user'      => 'user#index',
	'/user/add'  => 'user#add',
	'/user/edit' => 'user#edit',   // 'UserController.php?id=3' ... rebrà per GET la ID ... function editAction($_GET[id])
	'/user/del'  => 'user#del',

	// rutes per taula TASKS
	'/task'      => 'task#index',
	'/task/add'  => 'task#add',
	'/task/edit' => 'task#edit',
	'/task/del'  => 'task#del'
	
);
