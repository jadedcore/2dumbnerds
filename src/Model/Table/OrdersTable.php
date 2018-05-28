<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class OrdersTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');

		$this->belongsTo('Restaurants', [
			'foreignKey' => 'restaurant_id'
		]);
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
?>
