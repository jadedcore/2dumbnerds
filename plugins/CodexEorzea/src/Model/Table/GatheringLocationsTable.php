<?php
namespace CodexEorzea\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class GatheringLocationsTable extends Table {
	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);
		$this->setTable('gathering_locations');

		$this->belongsTo('GatheringTypes', [
			'foreignKey' => 'gathering_type_id',
			'className' => 'GatheringTypes'
		]);

		$this->belongsTo('Regions', [
			'foreignKey' => 'region_id',
			'className' => 'Regions'
		]);
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
