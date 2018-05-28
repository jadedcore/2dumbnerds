<?php
namespace VanillaCake\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class VanillaDiscussionsTable extends Table {
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
		$this->setTable('vanilla_discussions');
		$this->addBehavior('Timestamp');
		$this->belongsTo('Owners', [
			'foreignKey' => 'created_by',
			'className' => 'Users'
		]);
		$this->belongsTo('VanillaCategories', [
			'foreignKey' => 'vanilla_category_id',
			'className' => 'VanillaCake.VanillaCategories'
		]);
		$this->hasMany('VanillaComments', [
			'className' => 'VanillaCake.VanillaComments',
			'setDependant' => true
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

	public function updateDiscussion($comment = []) {
		if (!empty($comment)) {
			$theDiscussion = $this->get($comment->vanilla_discussion_id);
			$data = [
				'last_comment_by' => $comment->created_by,
				'last_comment_date' => $comment->created
			];
			$theDiscussion = $this->patchEntity($theDiscussion, $data);
			$theDiscussion->vanilla_comment_count++;
			$this->save($theDiscussion);
			$this->VanillaCategories->updateCategoryMeta($theDiscussion->vanilla_category_id);
		}
	}
}
