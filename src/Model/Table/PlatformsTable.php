<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PlatformsTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');

		$this->belongsTo('Companies');

		$this->hasMany('Games');
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
