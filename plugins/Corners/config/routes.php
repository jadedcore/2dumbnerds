<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
Router::plugin(
	'Corners',
	['path' => '/corners'],
	function (RouteBuilder $routes) {
		$routes->fallbacks(DashedRoute::class);
	}
);
Router::prefix('admin', function ($routes) {
	$routes->plugin(
		'Corners',
		['path' => '/corners'],
		function (RouteBuilder $routes) {
			$routes->fallbacks(DashedRoute::class);
		}
	);
});
