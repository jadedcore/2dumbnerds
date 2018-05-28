<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class RolesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$roles = $this->Roles->find('all');
		$this->set(compact('roles'));
	}

	public function add() {
		$theRole = $this->Roles->newEntity();
		if ($this->request->is('post')) {
			$theRole = $this->Roles->patchEntity($theRole, $this->request->getData());
			if ($this->Roles->save($theRole)) {
				$this->Flash->success(__('The role has been saved.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to add the role.'));
		}
		$this->set(compact('theRole'));
	}
}
