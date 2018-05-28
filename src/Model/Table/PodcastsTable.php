<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PodcastsTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');
	}

	public function validationDefault(Validator $validator) {
		$validator
			->requirePresence('title', 'create')
			->notEmpty('title');

		$validator
			->requirePresence('subtitle', 'create')
			->notEmpty('subtitle');

		$validator
			->requirePresence('url', 'create')
			->notEmpty('url');

		$validator
			->requirePresence('length', 'create')
			->notEmpty('length')
			->integer('length');

		$validator
			->requirePresence('type', 'create')
			->notEmpty('type');

		$validator
			->requirePresence('duration', 'create')
			->notEmpty('duration')
			->add('duration', 'custom',[
				'rule' => ['custom', '/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/'],
				'message' => 'The specified duration is not a valid time.'
			]);

		return $validator;
	}
}
