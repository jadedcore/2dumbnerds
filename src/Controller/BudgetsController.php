<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Log\Log;
use Cake\Utility\Hash;

class BudgetsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function newBudget() {
		$budget = $this->Budgets->newEntity();
		$data = $this->request->getData();
		if (!empty($data)) {
			$budget = $this->Budgets->patchEntity($budget, $data);
			$budget->created_by = $this->authUser['id'];
			if ($this->Budgets->save($budget)) {

			}
		}
		$this->set(compact('budget'));
		return;
	}

	public function manageBudget($budgetID = null, $budgetAccountID = null) {
		// List of Budgets Owned By User
		$conditions = ['created_by' => $this->authUser['id']];
		$budgetList = $this->Budgets->find('list')->where($conditions)->toArray();

		if (!empty($budgetID)) {

			$theBudget = $this->Budgets->get($budgetID);
			if ($theBudget->created_by !== $this->authUser['id']) {
				$message = 'Could not find the specified budget.';
				$this->Flash->error($message);
				return $this->redirect('/budgets/manageBudget');
			}

			$conditions = ['budget_id' => $budgetID];
			$budgetAccounts = $this->Budgets->BudgetAccounts->find()->where($conditions)->indexBy('id')->toArray();

			$this->Budgets->TreeBudgets->setupBudgetTree($budgetID);
			$theTree = $this->Budgets->TreeBudgets->findByBudgetId($budgetID)->order(['lft' => 'ASC'])->toArray();
			$this->set(compact('theTree', 'budgetAccounts', 'budgetAccountID'));
		}

		$this->set(compact('budgetList', 'budgetID'));
	}

	public function listBudgets() {
		$budgets = $this->Budgets->findByUserId($this->authUser['id']);
		$this->set(compact('budgets'));
	}
}
