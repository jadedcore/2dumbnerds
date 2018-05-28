<?php
namespace VanillaCake\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VanillaCommentsTable extends Table {
	/*
	public static function defaultConnectionName() {
		return 'vanilla';
	}
	*/

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);
		$this->setTable('vanilla_comments');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Owners', [
			'foreignKey' => 'created_by',
			'className' => 'Users'
		]);
		$this->belongsTo('VanillaDiscussions', [
			'foreignKey' => 'vanilla_discussion_id',
			'className' => 'VanillaCake.VanillaDiscussions'
		]);
	}
	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator) {
		$validator
			->integer('id')
			->allowEmpty('id', 'create');

		return $validator;
	}
}
