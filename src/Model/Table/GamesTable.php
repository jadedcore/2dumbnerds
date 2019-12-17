<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class GamesTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');

		$this->belongsTo('Publishers', ['className' => 'Companies'])
			->setForeignKey('publisher_id')
			->setProperty('publisher');

		$this->belongsTo('Developers', ['className' => 'Companies'])
			->setForeignKey('developer_id')
			->setProperty('developer');

		$this->belongsTo('Ratings');

		$this->belongsTo('Platforms');

		$this->hasMany('Inventories');
	}

	public function validationDefault(Validator $validator) {
		return $validator
			->notEmpty('name', 'A name is required.')
			->add('name', 'unique', [
				'rule' => 'validateUnique',
				'provider' => 'table',
				'message' => 'This game already exists.'
			]);
	}
}
