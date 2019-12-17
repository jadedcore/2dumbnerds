<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class BudgetsTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');
		$this->hasMany('TreeBudgets');
		$this->hasMany('BudgetAccounts');
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}
}
