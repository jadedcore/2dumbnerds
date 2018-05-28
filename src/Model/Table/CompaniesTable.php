<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CompaniesTable extends Table {
	public function initialize(array $config) {
		parent::initialize($config);
		$this->addBehavior('Timestamp');
		$this->belongsTo('Countries');
		$this->hasMany('Platforms');
	}

	public function validationDefault(Validator $validator) {
		return $validator
			->notEmpty('name', 'Company name is required.')
			->add('name', 'unique', [
				'rule' => 'validateUnique',
				'provider' => 'table',
				'message' => 'This company already exists.'
			]);
	}
}
