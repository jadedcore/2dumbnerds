<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Log\Log;

class InventoriesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function myInventory() {
		Configure::write('debug', true);
		$conditions = ['user_id' => $this->authUser['id']];
		$contain = ['Games'];
		$query = $this->Inventories->find()->where($conditions)->contain($contain);
		$inventory = $query->toArray();

		$this->set(compact('inventory'));
	}

	public function addGame() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$data = $this->request->getData();
			if (!isset($data['game_id']) || empty($data['game_id'])) {
				return $this->response->withStatus(400);
			}
			// The Game is already in this users inventory. So do nothing.
			if ($this->checkInventory($data['game_id'], $this->authUser['id'])) {
				return $this->response->withStatus(200);
			}

			// Get the Game in question (This also ensures the game exists)
			$theGame = $this->Games->get($data['game_id']);

			$data['user_id'] = $this->authUser['id'];
			$inventoryRecord = $this->Inventories->newEntity($data);
			if($this->Inventories->save($inventoryRecord)) {
				return $this->response->withStatus(200);
			}
			return $this->response->withStatus(500);
		}
		$message = 'You can not access this feature directly.';
		$this->Flash->error($message);
		$this->redirect($this->request->referer());
	}

	public function removeGame() {
		$this->autoRender = false;
		if ($this->request->is('ajax')) {
			$data = $this->request->getData();
			if (!isset($data['game_id']) || empty($data['game_id'])) {
				return $this->response->withStatus(400);
			}

			if ($this->Inventories->removeGame($data['game_id'], $this->authUser['id'])) {
				return $this->response->withStatus(200);
			}
			return $this->response->withStatus(500);
		}
		$message = 'You can not access this feature directly.';
		$this->Flash->error($message);
		$this->redirect($this->request->referer());
	}
}
