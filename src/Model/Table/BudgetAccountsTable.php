<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BudgetAccountsTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');
		$this->belongsTo('Budgets');
		$this->hasMany('TreeBudgets');
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
