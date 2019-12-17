<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
Router::plugin(
	'CodexEorzea',
	['path' => '/codex-eorzea'],
	function (RouteBuilder $routes) {
		$routes->fallbacks(DashedRoute::class);
	}
);
Router::prefix('admin', function ($routes) {
	$routes->plugin(
		'CodexEorzea',
		['path' => '/codex-eorzea'],
		function (RouteBuilder $routes) {
			$routes->fallbacks(DashedRoute::class);
		}
	);
});
