<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class GamesTable extends Table {
	public function initialize(array $config) {
		$this->belongsTo('Publishers', ['className' => 'Companies'])
			->setForeignKey('publisher_id')
			->setProperty('publisher');

		$this->belongsTo('Developers', ['className' => 'Companies'])
			->setForeignKey('developer_id')
			->setProperty('developer');

		$this->belongsTo('Ratings');
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
