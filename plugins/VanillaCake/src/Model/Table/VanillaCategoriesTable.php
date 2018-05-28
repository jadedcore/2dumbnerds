<?php
namespace VanillaCake\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VanillaCategoriesTable extends Table {
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
		$this->setTable('vanilla_categories');
		$this->addBehavior('Timestamp');
		$this->addBehavior('Tree');
		$this->belongsTo('Owners', [
			'foreignKey' => 'created_by',
			'className' => 'Users'
		]);
		$this->hasMany('VanillaDiscussions', [
			'foreignKey' => 'vanilla_category_id',
			'className' => 'VanillaCake.VanillaDiscussions',
			'setDependent' => true
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

	public function updateCategoryMeta($categoryID = null) {
		if (!empty($categoryID)) {
			$theCategory = $this->get($categoryID);
			$theCategory->last_update = date('Y-m-d H:i:s');
			$this->save($theCategory);
		}
		return;
	}

	public function incrementDiscussionCount($categoryID = null) {
		if (!empty($categoryID)) {
			$theCategory = $this->get($categoryID);
			$theCategory->vanilla_discussion_count++;
			$this->save($theCategory);
		}
		return;
	}

	public function decrementDiscussionCount($categoryID = null) {
		$theCategory = $this->get($categoryID);
		$theCategory->vanilla_discussion_count--;
		$this->save($theCategory);
	}
}
