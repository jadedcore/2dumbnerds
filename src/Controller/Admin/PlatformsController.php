<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class PlatformsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$platforms = $this->Platforms->find('all');
		$this->set(compact('platforms'));
	}

	public function add() {
		$thePlatform = $this->Platforms->newEntity();
		if ($this->request->is('post')) {
			$thePlatform = $this->Platforms->patchEntity($thePlatform, $this->request->getData());
			if ($this->Platforms->save($thePlatform)) {
				$this->Flash->success(__('Created new platform.'));
				return $this->redirect(['action' => 'index']);
			}
			$message = 'Unable to create new platform, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$this->set(compact('thePlatform'));
	}
}
