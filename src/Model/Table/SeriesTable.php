<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class SeriesTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');
		$this->setEntityClass('App\Model\Entity\Series');
		$this->hasMany('Streams')
			->setSort(['Streams.created' => 'desc']);
		$this->belongsTo('Games');
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
