<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$contain = ['Roles', 'TimeZones'];
		$conditions = ['is_active' => true];
		$users = $this->Users->find()->where($conditions)->contain($contain);
		$this->set(compact('users'));
	}

	public function add() {
		$theUser = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$theUser = $this->Users->patchEntity($theUser, $this->request->getData());
			if($this->Users->save($theUser)) {
				$this->Flash->success(__('The user has been created.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to create the user.'));
		}
		$roles = $this->Users->Roles->find('list');
		$this->set(compact('theUser', 'roles'));
	}

	public function edit($ID = null) {
		$contain = ['Roles'];
		$theUser = $this->Users->get($ID, compact('contain'));
		if ($this->request->is(['post', 'put'])) {
			$this->Users->patchEntity($theUser, $this->request->getData());
			if ($this->Users->save($theUser)) {
				$this->Flash->success(__('The user has been updated.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to update the user.'));
		}
	}

	public function delete() {
		if ($this->request->is(['post', 'put'])) {
			$data = $this->request->getData();
			$theUser = $this->Users->get($data['id']);
			if ($this->Users->delete($theUser)) {
				$message = __('The user was deleted.');
				$this->Flash->success($message);
				$this->redirect($this->request->referer());
			} else {
				$message = __('Unable to delete the user.');
				$this->Flash->error($message);
			}
		}
		$this->redirect($this->request->referer());
	}
}
