<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class User extends Entity {
	// Make all fields mass assignable except for primary key field "id"
	protected $_accessible = [
		'*' => true,
		'id' => false
	];

	protected function _setPassword($password) {
		if (!$this->isNew() && $this->dirty('password')) {
			if (!isset($this->currentPassword) && !isset($this->passwordOverride)) {
				$message = 'To change a password, you must set currentPassword in the entity being saved.';
				throw new InvalidArgumentException($message);
			} else {
				if (!$this->passwordOverride) {
					if (!(new DefaultPasswordHasher)->check($this->currentPassword, $this->getOriginal('password'))) {
						$message = 'Current password did not match.';
						$this->setError('currentPassword', [$message]);
						return false;
					}
				}
			}
		}
		if (strlen($password) > 0) {
			return (new DefaultPasswordHasher)->hash($password);
		}
	}

	protected function _setUsername($username) {
		if (!empty($username)) {
			return strtolower($username);
		}
	}
}
