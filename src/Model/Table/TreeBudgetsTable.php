<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TreeBudgetsTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');
		$this->addBehavior('Tree');

		$this->belongsTo('Budgets');
		$this->belongsTo('BudgetAccounts');
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}

	/**
	 * By defining scope, we are splitting the Budgets tree into multiple trees,
	 * one tree per User. This function should be called before any Tree behavior operation
	 *
	 * @param int $treeID
	 * @return void
	 */
	public function setupBudgetTree($budgetID = null) {
		$this->behaviors()->Tree->setConfig('scope', ['budget_id' => $budgetID]);
	}
}
