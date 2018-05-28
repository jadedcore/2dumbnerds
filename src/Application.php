<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Core\Configure;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\Middleware\EncryptedCookieMiddleware;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{
	/**
	 * Setup the middleware your application will use.
	 *
	 * @param \Cake\Http\MiddlewareQueue $middleware The middleware queue to setup.
	 * @return \Cake\Http\MiddlewareQueue The updated middleware.
	 */
	public function middleware($middleware)
	{
		// Catch any exceptions in the lower layers, and make an error page/response
		$middleware->add(ErrorHandlerMiddleware::class);

		// Handle plugin/theme assets like CakePHP normally does.
		$middleware->add(AssetMiddleware::class);

		// Apply routing
		$middleware->add(RoutingMiddleware::class);

		// CSRF Protection
		$csrf = new CsrfProtectionMiddleware([
			'secure' => true,
			'httpOnly' => true
		]);
		$middleware->add($csrf);

		// Encrypted Cookies
		$cookies = new EncryptedCookieMiddleware(
			['2DNData'],
			Configure::read('Security.cookieKey')
		);

		$middleware->add($cookies);

		return $middleware;
	}
}
