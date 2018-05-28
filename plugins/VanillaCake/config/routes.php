<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
Router::plugin(
	'VanillaCake',
	['path' => '/vanilla-cake'],
	function (RouteBuilder $routes) {
		$routes->fallbacks(DashedRoute::class);
	}
);
Router::prefix('admin', function ($routes) {
	$routes->plugin(
		'VanillaCake',
		['path' => '/vanilla-cake'],
		function (RouteBuilder $routes) {
			$routes->fallbacks(DashedRoute::class);
		}
	);
});
