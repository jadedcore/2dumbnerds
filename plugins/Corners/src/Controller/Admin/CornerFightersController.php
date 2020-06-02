<?php
namespace Corners\Controller\Admin;

use Corners\Controller\AppController;
use Cake\Event\Event;

class CornerFightersController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$contain = [];
		$fighters = $this->CornerFighters->find()->contain($contain)->toArray();
		$this->set(compact('fighters'));
	}

	public function add() {
		$theFighter = $this->CornerFighters->newEntity();
		if ($this->request->is(['post'])) {
			$data = $this->request->getData();
			$theFighter = $this->CornerFighters->patchEntity($theFighter, $data);
			$theFighter->created_by = $this->authUser['id'];
			$theFighter->modified_by = $this->authUser['id'];
			if ($this->CornerFighters->save($theFighter)) {
				$message = __('New fighter created.');
				$this->Flash->success($message);
				return $this->redirect($this->request->getRequestTarget());
			} else {
				$message = __('Unable to create fighter.  Fix dat shit.');
				$this->Flash->error($message);
			}

		}
		$this->set(compact('theFighter'));
	}

	public function modify($fighterID = null) {
		if (empty($fighterID)) {
			$message = __('No fighter selected to modify.');
			$this->Flash->error($message);
			return $this->redirect('/');
		}

		$theFighter = $this->CornerFighters->get($fighterID);

		if ($this->request->is(['put'])) {
			$data = $this->request->getData();
			$theFighter = $this->CornerFighters->patchEntity($theFighter, $data);
			$theFighter->modified_by = $this->authUser['id'];
			if ($this->CornerFighters->save($theFighter)) {
				$message = __('Fighter updated.');
				$this->Flash->success($message);
				return $this->redirect($this->request->getRequestTarget());
			} else {
				$message = __('Unable to update fighter.  Fix dat shit.');
				$this->Flash->error($message);
			}
		}
		$this->set(compact('theFighter'));
	}
}
