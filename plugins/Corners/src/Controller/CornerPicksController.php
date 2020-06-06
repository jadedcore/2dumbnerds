<?php
namespace Corners\Controller;

use Corners\Controller\AppController;
use Cake\Event\Event;

class CornerPicksController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Security->setConfig('unlockedActions', ['addPick']);
	}

	public function addPick() {
		$this->request->allowMethod(['post']);
		$this->autoRender = false;

		$data = $this->request->getData();

		if (!$this->CornerPicks->CornerMatches->CornerEvents->arePicksOpen($data['corner_event_id'])) {
			$returnData = [
				'message' => __('You can\'t submit new picks because the event has already started.'),
				'class' => 'message warning',
				'save' => false
			];
			return $this->response
				->withType('application/json')
				->withStringBody(json_encode($returnData));
		}

		if ($pick = $this->CornerPicks->alreadyPicked($this->authUser['id'], $data['corner_match_id'])) {
			$pick = $pick->first()->toArray();
			$thePick = $this->CornerPicks->newEntity($pick);
			$returnData = [
				'message' => __('You updated your pick for this fight.'),
			];
		} else {
			$thePick = $this->CornerPicks->newEntity();
			$returnData = [
				'message' => __('You made you fight pick.'),
			];
		}

		$thePick = $this->CornerPicks->patchEntity($thePick, $data);
		$thePick->user_id = $this->authUser['id'];

		if ($this->CornerPicks->save($thePick)) {
			$returnData['class'] = 'message success';
			$returnData['save'] = true;
			return $this->response
				->withType('application/json')
				->withStringBody(json_encode($returnData));
		} else {
			$returnData = [
				'message' => __('Something went wrong while saving your pick.  Please try again.'),
				'class' => 'message error',
				'save' => true
			];
			return $this->response
				->withType('application/json')
				->withStringBody(json_encode($returnData));
		}
	}
}
