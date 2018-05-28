<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class RatingsTable extends Table {
	public function initialize(array $config) {
		$this->belongsTo('Streams');
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
