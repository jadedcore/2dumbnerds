<?php
namespace Corners\Controller\Admin;

use Corners\Controller\AppController;
use Cake\Event\Event;

class CornerMatchesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$contain = [];
		$matches = $this->CornerMatches->find()->contain($contain)->toArray();
		$this->set(compact('matches'));
	}

	public function add() {
		$this->request->allowMethod(['post']);
		$this->autoRender = false;
		$theMatch = $this->CornerMatches->newEntity();
		if ($this->request->is(['post'])) {
			$data = $this->request->getData();
			$theMatch = $this->CornerMatches->patchEntity($theMatch, $data);
			$theMatch->created_by = $this->authUser['id'];
			$theMatch->modified_by = $this->authUser['id'];
			if ($this->CornerMatches->save($theMatch)) {
				$message = __('New match created.');
				$this->Flash->success($message);
				return $this->redirect('/admin/corners/corner-events/view-card/' . $theMatch->corner_event_id);
			} else {
				$message = __('Unable to create match.  Fix dat shit.');
				$this->Flash->error($message);
				return $this->redirect('/admin/corners/corner-events/view-card/' . $theMatch->corner_event_id);
			}

		}
		$fighters = $this->CornerMatches->Fighter1->find();

		$this->set(compact('theMatch', 'fighters'));
	}

	public function modify($matchID = null) {
		if (empty($matchID)) {
			$message = __('No match selected to modify.');
			$this->Flash->error($message);
			return $this->redirect('/');
		}

		$theMatch = $this->CornerMatches->get($matchID);

		if ($this->request->is(['put'])) {
			$data = $this->request->getData();
			$theMatch = $this->CornerMatches->patchEntity($theMatch, $data);
			$theMatch->modified_by = $this->authUser['id'];
			if ($this->CornerMatches->save($theMatch)) {
				$message = __('Match updated.');
				$this->Flash->success($message);
				return $this->redirect($this->request->getRequestTarget());
			} else {
				$message = __('Unable to update match.  Fix dat shit.');
				$this->Flash->error($message);
			}
		}
		$this->set(compact('theMatch'));
	}
}
