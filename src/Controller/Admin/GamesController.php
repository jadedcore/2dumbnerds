<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class GamesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$contain = array('Publishers', 'Developers', 'Ratings');
		$games = $this->Games->find('all', compact('contain'));
		$this->set(compact('games'));
	}

	public function add() {
		$theGame = $this->Games->newEntity();
		$this->set(compact('theGame'));
		if ($this->request->is('post')) {
			$theGame = $this->Games->patchEntity($theGame, $this->request->getData());
			if ($this->Games->save($theGame)) {
				$this->Flash->success(__('Created new game.'));
				return $this->redirect(['action' => 'index']);
			}
			$message = 'Unable to create new game, please correct errors and try again.';
			$this->Flash->error(__($message));
		}

		$conditions = array('is_publisher' => true);
		$publishers = $this->Games->Publishers->find('list', compact('conditions'));
		$conditions = array('is_developer' => true);
		$developers = $this->Games->Developers->find('list', compact('conditions'));
		$ratings = $this->Games->Ratings->find('list');
		$this->set(compact('publishers', 'developers', 'ratings'));
	}
}
