<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;
use Cake\Utility\Text;
use Cake\Utility\Security;

class CookieTokensTable extends Table {
	public function initialize(array $config) {
		parent::initialize($config);
		$this->addBehavior('Timestamp');
		$this->setDisplayField('token');
		$this->belongsTo('Users');
	}

	public function validationDefault(Validator $validator) {
		$validator
			->requirePresence('token', 'create')
			->notEmpty('token');

		$validator
			->requirePresence('user_id', 'create')
			->notEmpty('user_id')
			->integer('user_id');

		$validator
			->requirePresence('ip', 'create')
			->notEmpty('ip');

		$validator
			->requirePresence('user_agent', 'create')
			->notEmpty('user_agent');

		return $validator;
	}

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules) {
		$rules->add($rules->isUnique(['token'], 'This token is already in use.'));
		return $rules;
	}

	public function setUserToken($userID = null, $agent = null, $ip = null) {
		if (!empty($userID)) {
			$data = [
				'user_id' => $userID,
				'token' => $this->__generateToken(),
				'user_agent' => $agent,
				'ip' => $ip
			];

			// There is a small chance that a non-unique token would be created. This will make sure that if it occurs
			// then a new token is generated before completing the save.
			do {
				$theToken = $this->newEntity($data);
				$this->save($theToken);
				// Errors should be empty if the save succeeded
				if ($errors = $theToken->getErrors()) {
					// This is the specific token failure we are looking for.
					if (isset($errors['token']['_isUnique'])) {
						$data['token'] = $this->__generateToken();
						$tokenError = true;
					} else { // Failed for another reason so return failure.
						return false;
					}
				} else { // Save was successful so break the while loop
					$tokenError = false;
				}
			} while ($tokenError);
			return $theToken;
		}
		return false;
	}

	/**
	 * Clear a cookie auth token from the database.
	 *
	 * @param int $userID - The id of the user whose token needs removing
	 * @param string $token - The token value for the token you wish to remove
	 * @return void
	 */
	public function clearToken($userID = null, $token = null) {
		$conditions = ['user_id' => $userID, 'token' => $token];
		$theToken = $this->find()->where($conditions)->first();
		if ($theToken) {
			$this->delete($theToken);
		}
		return;
	}

	private function __generateToken() {
		return Security::hash(Text::uuid(), 'sha256', true);
	}
}
