<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Log\Log;
use Cake\Utility\Hash;

class BudgetAccountsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);

		$this->Security->setConfig('unlockedActions', ['newBudgetItem']);
	}

	public function newBudgetItem() {
		$data = $this->request->getData();
		if (!empty($data)) {
			$budgetItem = $this->Budgets->newEntity($data);
			$budgetItem->user_id = $this->authUser['id'];
			$budgetItem->created_by = $this->authUser['id'];
			$this->Budgets->save($budgetItem);
		}
		return $this->response
			->withType('json')
			->withStatus(200)
			->withStringBody(json_encode('Success', JSON_HEX_APOS));
	}
}
