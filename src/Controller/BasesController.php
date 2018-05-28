<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Log\Log;

class BasesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function add() {
		$theBase = $this->Bases->newEntity();
		$this->set(compact('theBase'));
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['created_by'] = $this->authUser['id'];
			$theBase = $this->Bases->patchEntity($theBase, $data);
			if ($this->Bases->save($theBase)) {
				$this->Flash->success(__('Your new base has been created.'));
				return $this->redirect('/users/my-account');
			}
			$message = 'Unable to create your base, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
	}

	public function edit($baseID = null) {
		$theBase = $this->Bases->get($baseID);
		if ($theBase->owner_id != $this->authUser['id']) {
			$this->Flash->error(__('Nope.'));
			return $this->redirect($this->request->referer());
		}
		$this->set(compact('theBase'));
	}
}
