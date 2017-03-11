<?php

function call($controller, $action)
{
	require_once 'controllers/' . $controller . '_controller.php';

	switch($controller) {
		case 'pages':
			$controller = new PagesController();
			break;
		case 'posts':
			require_once 'models/post.php';
			$controller = new PostsController();
			break;
	}

	$controller->{ $action }();
}

$controllers = ['pages' => ['home', 'error'],
	'posts' => ['index', 'show']];

if (array_key_exists($controller, $controllers)) {
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action);
	} else {
		call('pages', 'error');
	}
} else {
	call('pages', 'error');
}

?>