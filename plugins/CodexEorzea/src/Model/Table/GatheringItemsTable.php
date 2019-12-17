<?php
namespace CodexEorzea\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class GatheringItemsTable extends Table {
	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);
		$this->setTable('gathering_items');

		$this->belongsToMany('GatheringLocations', [
			'foreignKey' => 'gathering_item_id',
			'targetForeignKey' => 'gathering_location_id',
			'joinTable' => 'gathering_items_locations',
			'className' => 'GatheringLocations'
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
