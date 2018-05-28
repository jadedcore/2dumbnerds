<?php
namespace App\Auth;

use Cake\Auth\BaseAuthenticate;
use Cake\Http\ServerRequest;
use Cake\Http\Response;
use Cake\Http\Cookie\Cookie;
use Cake\ORM\TableRegistry;

class TokenAuthenticate extends BaseAuthenticate {
	public function authenticate(ServerRequest $request, Response $response) {
		if ($cookie = $this->_checkCookieExists($request)) {
			if ($userToken = $this->_getUserToken($cookie->getValue())) {
				$agent = $request->getHeaderLine('User-Agent');
				$ip = $request->clientIP();
				if (($userToken->user_agent != $agent) || ($userToken->ip != $ip)) {
					return false;
				}

				return $this->_getUser($userToken->user_id);
			}
		}
		return false;
	}

	protected function _checkCookieExists(ServerRequest $request) {
		$cookies = $request->getCookieCollection();
		if ($cookies->has('2DNData')) {
			return $cookies->get('2DNData');
		}
		return false;
	}

	protected function _getUserToken($token = null) {
		$table = TableRegistry::get('CookieTokens');
		$conditions = ['token' => $token];
		return $table->find()->where($conditions)->first();
	}

	protected function _getUser($userID = null) {
		$table = TableRegistry::get('Users');
		$query = $table->find('auth');
		$query = $query->where(['Users.id' => $userID]);
		return $query->first();
	}
}
