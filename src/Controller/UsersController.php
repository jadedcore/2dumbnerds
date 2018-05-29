<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Cake\Routing\Router;
use Cake\Http\Cookie\Cookie;
use Cake\Log\Log;

class UsersController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['login', 'register', 'verify', 'recoverPassword']);
		$this->Security->setConfig('unlockedActions', ['upload', 'changeAvatar']);
	}

/**
 * Try to log the user in with a cookie containing an auth token. Otherwise fallback on form authentication.
 *
 * @return void
 */
	public function login() {
		if ($this->Auth->user()) {
			return $this->redirect('/');
		}

		if (!$this->tokenLogin()){
			if ($this->request->is('post')) {
				$this->request->data['username'] = strtolower($this->request->data['username']);
				$theUser = $this->Auth->identify();
				if ($theUser) {
					$data = $this->request->getData();
					if (isset($data['stay_logged']) && $data['stay_logged']) {
						$cookie = $this->__setUserCookie($theUser['id']);
						$this->response = $this->response->withCookie($cookie);
						$this->response = $this->response->withHeader('Location', $this->Auth->redirectURL());
						$this->response = $this->response->withStatus(302);
					} else {
						$this->response = $this->redirect($this->Auth->redirectURL());
					}
					$this->Auth->setUser($theUser);
					$this->Users->updateLoginStats($theUser);
					$message = 'Hey ' . $theUser['display_name'] . ', come on in.';
					$this->Flash->success($message, ['clear' => true]);
					$response = $this->redirect($this->Auth->redirectURL());
					if (isset($cookie)) {
						$response->withCookie($cookie);
					}
					return $this->response;
				} else {
					$this->Flash->error(__('Username or password is incorrect.'));
				}
			}
		}
	}

	/**
	 * Try to log in a user with a cookie token if the cookie is present. The cookie should only be set if the user
	 * clicks the stay_logged checkbox on the login form.
	 *
	 * @return bool false if unable to log in the user.
	 */
	public function tokenLogin() {
		$theUser = $this->Auth->identify();
		if ($theUser) {
			$this->Auth->setUser($theUser);
			$this->Users->updateLoginStats($theUser);
			$message = 'Hey ' . $theUser['display_name'] . ', come on in.';
			$this->Flash->success($message, ['clear' => true]);
			$response = $this->redirect($this->Auth->redirectURL());
		}
		return false;
	}

/**
 * Logout a user and return them to the home page.
 *
 * @return void
 */
	public function logout() {
		$cookies = $this->request->getCookieCollection();
		// If the user manually logs out, destory any stay_logged token for that session.
		if ($cookies->has('2DNData')) {
			$cookie = $cookies->get('2DNData');
			$this->Users->CookieTokens->clearToken($this->authUser['id'], $cookie->getValue());
		}
		$message = 'You have logged out.  Catch ya later.';
		$this->Flash->success(__($message));
		return $this->redirect($this->Auth->logout());
	}

/**
 * Allow a user to see/change their own profile.
 *
 * @return void
 */
	public function myAccount() {
		$contain = ['Roles', 'OwnedBases'];
		$theUser = $this->Users->get($this->authUser['id'], compact('contain'));
		if ($this->request->is(['post', 'put'])) {
			$data = $this->request->getData();
			$this->Users->patchEntity($theUser, $data);
			if ($this->Users->save($theUser)) {
				$message = __('Good jorb! You updated your profile.');
				$this->Flash->success($message);
			} else {
				$message = __('Something is wrong. Fix your shit and try again.');
				$this->Flash->error($message);
			}
		}

		$timeZones = $this->Users->TimeZones->find('list')->toArray();
		$this->set(compact('theUser', 'timeZones'));
	}

	public function myLibrary() {
		$contain = ['Games'];
		$theUser = $this->Users->get($this->authUser['id'], compact('contain'));
		$this->set(compact('theUser'));
	}

/**
 * Deactivate a user account. This will not delete the users data and will just make the account inactive.
 * I don't know how I want to handle this yet...
 *
 * Also not sure how I want to handle deleting users...
 */

/**
 * Reset a users password when they forget.
 */
	public function recoverPassword($userID = null, $resetToken = null) {

		// User is coming from a password reset link. Find the applicable user and set it to the view.
		if (!empty($userID) && !empty($resetToken)) {
			$conditions = [
				'id' => $userID,
				'reset_token' => $resetToken
			];
			$theUser = $this->Users->find()->where($conditions)->first();
			if (!empty($theUser)) {
				$this->set(compact('theUser'));
			} else {
				$message = __('There is a problem with the password reset link. Please contact us via e-mail.');
				$this->Flash->error($message);
			}
		}

		if ($this->request->is(['post', 'put'])) {
			$data = $this->request->getData();

			// User is trying to actually change the password.
			if (!empty($data['Users']['newPassword'])) {
				$theUser = $this->Users->get($data['Users']['id']);
				$theUser->set('passwordOverride', true);
				$theUser->set('password', $data['Users']['newPassword']);
				$theUser->reset_token = null;
				if ($this->Users->save($theUser)) {
					$message = __('Your password was changed successfully.');
					$this->Flash->success($message);
					return $this->redirect('/users/login');
				} else {
					debug($theUser);
					$message = 'We were not able to change your password. Fix your shit and try again.';
					$this->Flash->error(__($message));
					$this->set(compact('theUser'));
				}
			}

			// User is trying start the recover password process.
			if (!empty($data['email'])) {
				$conditions = ['email' => $data['email']];
				$theUser = $this->Users->find()->where($conditions)->first();
				if (!empty($theUser)) {
					$theUser->reset_token = Security::hash(Text::uuid(), 'sha256', true);
					if ($this->Users->save($theUser)) {
						$messageConfig = [
							'to' => $theUser->email,
							'subject' => '2DN: Recover Password',
							'template' => 'recover_password'
						];
						$messageData = $theUser;
						$this->__sendMail($messageConfig, $messageData);
					}
				}
				$message = __('A password reset link will be sent to your e-mail address if your account exists.');
				$this->Flash->success($message);
			}
		}
	}

/**
 * Allow a logged in user to change their password.
 *
 * @return void
 */
	public function changePassword() {
		$contain = ['Roles'];
		$theUser = $this->Users->get($this->authUser['id'], compact('contain'));
		if ($this->request->is(['post', 'put'])) {
			$data = $this->request->getData();
			$theUser->set('currentPassword', $data['Users']['currentPassword']);
			$theUser->set('password', $data['Users']['newPassword']);
			if ($this->Users->save($theUser)) {
				$message = 'Your password was changed successfully.';
				$this->Flash->success(__($message));
				return $this->redirect($this->request->referer());
			}
			$message = 'We were not able to change your password. Fix your shit and try again.';
			$this->Flash->error(__($message));
		}
		$this->set(compact('theUser'));
	}

/**
 * Register a new user and if successful send an e-mail verification message and log the user
 * into the system.
 *
 * @return void
 */

	public function register() {
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$defaultValues = [
				'is_active' => true,
				'role_id' => 3,
				'verification' => Security::hash(Text::uuid(), 'sha256', true)
			];
			if (isset($data['Register'])) {
				$data['Users'] = array_merge($defaultValues, $data['Register']);
				unset($data['Register']);
			} else {
				$data['Users'] = array_merge($defaultValues, $data['Users']);
			}

			$data['display_name'] = $data['Users']['username'];
			$data['time_zone_id'] = 578; // UTC by default
			$theUser = $this->Users->newEntity($data);
			if ($this->Users->save($theUser)) {
				$messageConfig = [
					'to' => $theUser['email'],
					'bcc' => 'sup@2dumbnerds.com',
					'subject' => '2DumbNerds: Verify Account',
					'template' => 'user_verification'
				];
				if ($this->__sendMail($messageConfig, $theUser)) { // Account created and e-mail sent
					$message = 'Good jorb, you made an account.';
					$this->Flash->success(__($message));
				} else { // Account created but e-mail failed
					// Unset the verification field so we can see it is a problem.
					$theUser->verification = null;
					$this->Users->save($theUser);
					$message = 'Hmm... your acount was made but we were unable to send a verification e-mail.';
					$message .= ' Maybe the mailer is broken right now. Please try again later by going into ';
					$message .= 'your account settings and re-send the verification e-mail.';
					$this->Flash->set($message);
				}

				// Add the unverified role to the newly registered user
				$role = $this->Users->Roles->get(3);
				$theRole = $role->toArray();
				$theUser->role = $theRole;

				// Add the timezone to the user
				$timeZone = $this->Users->TimeZones->get($theUser->time_zone_id);
				$theTimeZone = $timeZone->toArray();
				$theUser->time_zone = $theTimeZone;

				// Log the user in
				$this->Auth->setUser($theUser->toArray());
				return $this->redirect(['controller' => 'pages', 'action' => 'display', 'home']);
			}
			// Account creation failed due to some validation error
			$message = 'There were some problems with your registration. You should fix that shit and try again.';
			$this->Flash->error(__($message));
		}
		if (!isset($theUser)) {
			$theUser = $this->Users->newEntity();
		}
		$this->set(compact('theUser'));
	}

/**
 * Resend a verification e-mail if a user did not get the first one.
 *
 * @return void
 */
	public function resendVerification() {
		$this->autoRender = false;
		$theUser = $this->Users->get($this->authUser['id']);
		$verification = ['verification' => Security::hash(Text::uuid(), 'sha256', true)];
		$this->Users->patchEntity($theUser, $verification);
		$this->Users->save($theUser);
		$messageConfig = [
			'to' => $theUser['email'],
			'subject' => '2DumbNerds: Verify Account',
			'template' => 'user_verification'
		];
		if ($this->__sendMail($messageConfig, $theUser)) {
			$message = 'Boom. Check for a new verification message in your mailbox.';
			$this->Flash->success(__($message));
		} else {
			$message = 'We were unable to send a verification e-mail.';
			$message .= ' Maybe the mailer is broken right now. Please try again later by going into ';
			$message .= 'your account settings and re-send the verification e-mail.';
			$this->Flash->set($message);
		}
		return $this->redirect($this->request->referer());
	}

/**
 * Verify a users e-mail address.
 *
 * @param int $userID - The user ID of the account being verified.
 * @param string $verification - The verification code to verify the e-mail with.
 * @return void
 */
	public function verify($userID = null, $verification = null) {
		if (empty($verification) || empty($userID)) {
			$message = 'The verification code or ID was not sent with your request.';
			$this->Flash->error(__($message));
			return $this->redirect('/');
		}
		if (!$theUser = $this->Users->get($userID)) {
			$message = 'Something was wrong with the link.';
			$this->Flash->error(__($message));
			return $this->redirect('/');
		}
		if (empty($theUser['verification'])) {
			$message = 'Your e-mail address was already verified.';
			$this->Flash->success(__($message));
			return $this->redirect('/');
		}

		if ($theUser['verification'] === $verification) {
			$theUser->set([
				'verification' => null,
				'role_id' => 2
			]);

			if ($this->Users->save($theUser)) {
				$message = 'Congratulations! You are no longer a <strong>N00B</strong>. You have successfully';
				$message .= ' verified your e-mail address.';
				$this->Flash->success(__($message), ['escape' => false]);
				return $this->redirect('/users/login');
			}
		} else {
			$message = 'Unable to verify your account. The code provided was invalid.';
			$this->Flash->error(__($message));
			return $this->redirect('/');
		}
		throw new NotFoundException();
	}

/**
 * Avatar Upload
 */
	public function changeAvatar() {
		$theUser = $this->Users->get($this->authUser['id']);
		if ($this->request->is('post')) {
			$data = $this->request->getData();

			$data['url'] = '2dumbnerds.com/audio/' . $data['file'];
			$data['local_url'] = '/audio/' . $data['file'];

			$theUser = $this->Users->patchEntity($theUser, $data);
			if ($this->Users->save($theUser)) {
				$this->Flash->success(__('Your avatar has been updated.'));
				return $this->redirect('/users/my-account');
			}
			$message = 'Unable to update your avatar, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$this->set(compact('theUser'));
	}

/**
 * Upload file for profile picture.
 */
	public function upload() {
		$this->autoRender = false;
		$returnData = $this->request->getData();

		$returnData['status'] = 'Fail';
		$returnData['message'] = 'Unable to update your profile picture.';
		if ($this->__checkFile($returnData['file'])) {
			if ($fileName = $this->__moveFile($returnData['file'])) {
				$theUser = $this->Users->get($this->authUser['id']);
				$theUser->profile_pic = '/img/profile/' . $fileName;
				if ($this->Users->save($theUser)) {
					$returnData['new_file'] = $fileName;
					$returnData['status'] = 'Success';
					$returnData['message'] = 'Your ugly mug has been updated successfully.';
				}
			}
		}
		$this->response->type('json');
		$this->response->body(json_encode($returnData));
		return $this->response;
	}

/**
 * Check uploaded files to make sure they are valid.
 */
	private function __checkFile($uploadData = []) {
		if (!isset($uploadData['error']) || $uploadData['error'] == true) {
			Log::info('File upload error.');
			return false;
		}

		if (!isset($uploadData['tmp_name']) || empty($uploadData['tmp_name'])) {
			Log::info('Missing file name.');
			return false;
		}

		if (!isset($uploadData['type'])) {
			Log::info('Missing Mime type.');
			return false;
		}

		// May need to do some additional file checking in the future.
		// Look at https://secure.php.net/manual/en/function.id3-get-tag.php
		// Using mime_content_type() may return application/octet-stream on some mp3 files
		$allowed = [
			'png' => 'image/png',
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif'
		];
		if (!array_search($uploadData['type'], $allowed)) {
			Log::info('Mime type not allowed. Type uploaded: ' . $uploadData['type']);
			return true;
		}
		return true;
	}

/**
 * Handle naming and moving uploaded files to a permanent location.
 */
	private function __moveFile($fileData = null) {
		// Get the file extension
		// $exploded = explode('.', $fileData['name']);
		// $ext = end($exploded);

		// Rename the file to a safe name with user ID and Unix timestamp.
		$fileName = 'profile_' . $this->authUser['id'] . '.png';

		if (move_uploaded_file($fileData['tmp_name'], '/var/www/html/dumbnerds_app/webroot/img/profile/' . $fileName)) {
			Log::info('Mime: ' . mime_content_type('/var/www/html/dumbnerds_app/webroot/img/profile/' . $fileName));
			return $fileName;
		}
		Log::info('Could not move file.');
		return false;
	}

/**
 * Send e-mail using MailGun plugin.
 *
 * @param array $messageConfig - array containing the email configurations needed to send.
 *	- Example: [
 *		'to' => [someone@somewhere.com => 'Someone'],
 *		'subject' => 'Some Subject',
 *		'template' => 'The Email Template to use'
 *	]
 * @param array $messageData - an array of variables to use in the e-mail template
 * @return bool - true if message successfully sent to mailgun, otherwise false
 */
	private function __sendMail($messageConfig, $messageData) {
		if (empty($messageConfig) || empty($messageData)) {
			return false;
		}
		$email = new Email('mailgun');
		$result = $email->to($messageConfig['to'])
			->subject($messageConfig['subject'])
			->template($messageConfig['template'])
			->viewVars(compact('messageData'))
			->emailFormat('html');

		if (isset($messageConfig['bcc'])) {
			$email->bcc($messageConfig['bcc']);
		}

		$result = $email->send();

		if ($result->http_response_code != 200) {
			// Need some logging here.
			return false;
		}
		return true;
	}

	/**
	 * Creates a database token and cookie pair so a user can stay logged in.
	 *
	 * @param array $theUser - The auth user array
	 * @return $cookie - The cookie object
	 */
	private function __setUserCookie($theUser = []) {
		$agent = $this->request->getHeaderLine('User-Agent');
		$ip = $this->request->clientIP();
		if ($theToken = $this->Users->CookieTokens->setUserToken($theUser, $agent, $ip)){
			$cookie = (new Cookie('2DNData'))
				->withValue($theToken->token)
				->withDomain('2dumbnerds.com')
				->withPath('/')
				->withSecure(true)
				->withHttpOnly(true);

			return $cookie;
		} else {
			$message = __('Unable to create the necessary cookies to keep you logged in.');
			$this->Flash->error($message);
		}
		return false;
	}
}
