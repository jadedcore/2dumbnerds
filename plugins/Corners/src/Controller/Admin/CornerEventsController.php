<?php
namespace Corners\Controller\Admin;

use Corners\Controller\AppController;
use Cake\Event\Event;

class CornerEventsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$contain = [];
		$events = $this->CornerEvents->find()->contain($contain)->toArray();
		$this->set(compact('events'));
	}

	public function viewCard($eventID = null) {
		if (empty($eventID)) {
			$message = __('You must specify an event to view the card.');
			$this->Flash->error($message);
			return $this->redirect($this->request->referer());
		}

		$contain = ['CornerMatches'];

		$theEvent = $this->CornerEvents->find()
			->contain($contain)
			->where(['CornerEvents.id' => $eventID])
			->toArray();

		$fighters = $this->CornerEvents->CornerMatches->Fighter1->find(
			'list', [
				'keyField' => 'id',
				'valueField' => 'last_name'
			]
		)->toArray();

		$this->set(compact('theEvent', 'fighters'));
	}

	public function add() {
		$theEvent = $this->CornerEvents->newEntity();
		if ($this->request->is(['post'])) {
			$data = $this->request->getData();
			$theEvent = $this->CornerEvents->patchEntity($theEvent, $data);
			$theEvent->created_by = $this->authUser['id'];
			$theEvent->modified_by = $this->authUser['id'];
			if ($this->CornerEvents->save($theEvent)) {
				$message = __('New event created.');
				$this->Flash->success($message);
				return $this->redirect($this->request->getRequestTarget());
			} else {
				$message = __('Unable to create event.  Fix dat shit.');
				$this->Flash->error($message);
			}

		}
		$this->set(compact('theEvent'));
	}

	public function modify($eventID = null) {
		if (empty($eventID)) {
			$message = __('No event selected to modify.');
			$this->Flash->error($message);
			return $this->redirect('/');
		}

		$theEvent = $this->CornerEvents->get($eventID);

		if ($this->request->is(['put'])) {
			$data = $this->request->getData();
			$theEvent = $this->CornerEvents->patchEntity($theEvent, $data);
			$theEvent->modified_by = $this->authUser['id'];
			if ($this->CornerEvents->save($theEvent)) {
				$message = __('Event updated.');
				$this->Flash->success($message);
				return $this->redirect($this->request->getRequestTarget());
			} else {
				$message = __('Unable to update event.  Fix dat shit.');
				$this->Flash->error($message);
			}
		}
		$this->set(compact('theEvent'));
	}
}
