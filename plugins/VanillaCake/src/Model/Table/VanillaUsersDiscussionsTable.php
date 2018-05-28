<?php
namespace VanillaCake\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VanillaUsersDiscussions extends Table {
	public function initialize(array $config) {
		parent::initialize($config);
		$this->setTable('vanilla_users_discussions');
		$this->belongsTo('Users');
		$this->belongsTo('VanillaDiscussions', [
			'className' => 'VanillaCake.VanillaDiscussions'
		]);
	}
}
