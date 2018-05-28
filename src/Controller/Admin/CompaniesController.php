<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class CompaniesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$companies = $this->Companies->find('all');
		$this->set(compact('companies'));
	}

	public function add() {
		$theCompany = $this->Companies->newEntity();
		if ($this->request->is('post')) {
			$theCompany = $this->Companies->patchEntity($theCompany, $this->request->getData());
			$theCompany->created_by = $this->authUser['id'];
			if ($this->Companies->save($theCompany)) {
				$this->Flash->success(__('Created new company.'));
				return $this->redirect(['action' => 'index']);
			}
			$message = 'Unable to create new company, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$countries = $this->Companies->Countries->find('list')->toArray();
		$companies = $this->Companies->find('list')->toArray();
		$this->set(compact('theCompany', 'companies', 'countries'));
	}
}
