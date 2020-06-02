<?php
namespace Corners\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CornerMatchesTable extends Table {
	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);
		$this->setTable('corner_matches');
		$this->addBehavior('Timestamp');

		$this->belongsTo('CornerEvents', ['className' => 'Corners.CornerEvents'])
			->setForeignKey('corner_event_id');

		$this->belongsTo('Fighter1', ['className' => 'Corners.CornerFighters'])
			->setForeignKey('fighter1_id');

		$this->belongsTo('Fighter2', ['className' => 'Corners.CornerFighters'])
			->setForeignKey('fighter2_id');
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
