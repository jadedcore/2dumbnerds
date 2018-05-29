<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;
use Cake\Utility\Security;

class UsersTable extends Table {
	public function initialize(array $config) {
		parent::initialize($config);
		$this->addBehavior('Timestamp');
		$this->setDisplayField('display_name');
		$this->hasMany('CookieTokens');
		$this->belongsTo('Roles');
		$this->belongsTo('TimeZones');
		$this->hasOne('OwnedBases', [
			'className' => 'Bases',
			'foreignKey' => 'owner_id'
		]);

		$this->belongsToMany('Bases', [
			'foreignKey' => 'user_id',
			'targetForeignKey' => 'base_id',
			'joinTable' => 'bases_users'
		]);

		$this->belongsToMany('Games', [
			'through' => 'GamesCatalogs'
		]);
	}

	public function validationDefault(Validator $validator) {
		return $validator
			->notEmpty('username', 'A username is required.')
			->add('username', 'unique', [
				'rule' => 'validateUnique',
				'provider' => 'table',
				'message' => 'This username has already been used.'
			])
			->add('display_name', 'unique', [
				'rule' => 'validateUnique',
				'provider' => 'table',
				'message' => 'This display name is already in use.'
			])
			->notEmpty('password', 'A password is required.')
			->notEmpty('email', 'A valid e-mail is required.')
			->email('email', true)
			->add('email', 'unique', [
				'rule' => 'validateUnique',
				'provider' => 'table',
				'message' => 'This e-mail address is already in use.'
			]);
	}

	public function findAuth(\Cake\ORM\Query $query, array $options) {
		$query->contain(['Roles', 'TimeZones'])->where(['Users.is_active' => true]);
		return $query;
	}

	public function beforeSave($event, $entity, $options) {
		return true;
	}

	public function updateLoginStats($theUser = []) {
		if (!empty($theUser)) {
			$theUser = $this->get($theUser['id']);
			$theUser->last_login = date('Y-m-d H:i:s');
			$theUser->login_count++;
			$this->save($theUser);
		}
	}
}
