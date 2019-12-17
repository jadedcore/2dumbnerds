<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class ActivitiesTable extends Table {
	public function initialize(array $config) {
		parent::initialize($config);
		$this->addBehavior('Timestamp');

		$this->belongsTo('ActivityTypes', [
			'foreignKey' => 'activity_type_id',
			'className' => 'ActivityTypes'
		]);

		$this->belongsTo('Creators', [
			'foreignKey' => 'created_by',
			'className' => 'Users'
		]);
	}

	public function validationDefault(Validator $validator) {
		return $validator
			->notEmpty('activity_type_id', 'An activity type is required.')
			->notEmpty('title', 'A title is required.')
			->notEmpty('link', 'A link is required.')
			->url('link', 'This must be a link and should start with http:// or https://');
	}
}
