<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class PublishersController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$publishers = $this->Publishers->find('all');
		$this->set(compact('publishers'));
	}

	public function add() {
		$thePublisher = $this->Publishers->newEntity();
		if ($this->request->is('post')) {
			$thePublisher = $this->Publishers->patchEntity($thePublisher, $this->request->getData());
			if ($this->Publishers->save($thePublisher)) {
				$this->Flash->success(__('Created new publisher.'));
				return $this->redirect(['action' => 'index']);
			}
			$message = 'Unable to create new publisher, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$this->set(compact('thePublisher'));
	}
}
