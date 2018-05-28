<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class RatingsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$ratings = $this->Ratings->find('all');
		$this->set(compact('ratings'));
	}

	public function add() {
		$theRating = $this->Ratings->newEntity();
		if ($this->request->is('post')) {
			$theRating = $this->Ratings->patchEntity($theRating, $this->request->getData());
			if ($this->Ratings->save($theRating)) {
				$this->Flash->success(__('Created new rating.'));
				return $this->redirect(['action' => 'index']);
			}
			$message = 'Unable to create new rating, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$this->set(compact('theRating'));
	}
}
