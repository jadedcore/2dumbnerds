<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class PlatformsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$contain = ['Companies'];
		$platforms = $this->Platforms->find()->contain($contain);
		$this->set(compact('platforms'));
	}

	public function add() {
		$thePlatform = $this->Platforms->newEntity();
		if ($this->request->is('post')) {
			$thePlatform = $this->Platforms->patchEntity($thePlatform, $this->request->getData());
			$thePlatform->created_by = $this->authUser['id'];
			if ($this->Platforms->save($thePlatform)) {
				$this->Flash->success(__('Created new platform.'));
				return $this->redirect(['action' => 'index']);
			}
			$message = 'Unable to create new platform, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$companies = $this->Platforms->Companies->find('list');
		$this->set(compact('thePlatform', 'companies'));
	}

	public function edit($platformID = null) {
		$contain = ['Companies'];
		$thePlatform = $this->Platforms->get($platformID, compact('contain'));
		if ($this->request->is(['post', 'put'])) {
			$this->Platforms->patchEntity($thePlatform, $this->request->getData());
			$thePlatform->modified_by = $this->authUser['id'];
			if ($this->Platforms->save($thePlatform)) {
				$this->Flash->success(__('Updated the platform.'));
				return $this->redirect(['action' => 'index']);
			}
			$message = 'Unable to update the platform, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$companies = $this->Platforms->Companies->find('list')->order(['Companies.name' => 'ASC']);
		$this->set(compact('thePlatform', 'companies'));
	}
}
