<?php
namespace Corners\Controller;

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

		$contain = ['CornerMatches' => ['Fighter1', 'Fighter2']];

		$theEvent = $this->CornerEvents->find()
			->contain($contain)
			->where(['CornerEvents.id' => $eventID])
			->toArray();

		$conditions = [
			'CornerPicks.user_id' => $this->authUser['id'],
			'CornerPicks.corner_event_id' => $eventID
		];
		$userPicks = $this->CornerEvents->CornerMatches->CornerPicks->find()
			->where($conditions)
			->indexBy('corner_match_id')
			->toArray();

		$picksOpen = $this->CornerEvents->arePicksOpen($eventID);

		$this->set(compact('theEvent', 'picksOpen', 'userPicks'));
	}
}
