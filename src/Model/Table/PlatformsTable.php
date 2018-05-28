<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PlatformsTable extends Table {
	public function initialize(array $config) {
		
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
