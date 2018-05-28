<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RolesTable extends Table {
	public function initialize(array $config) {
		$this->hasMany('Users');
	}

	public function validationDefault(Validator $validator) {
		return $validator
			->notEmpty('name', 'Roles must have a name.')
			->notEmpty('priority', 'Roles must be assigned a priority.');
	}
}
