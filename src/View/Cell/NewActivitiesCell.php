<?php
namespace App\View\Cell;

use Cake\View\Cell;

class NewActivitiesCell extends Cell {

	public function display() {
		$this->loadModel('Activities');
		$this->loadModel('Users');
		$newActivities = $this->Activities->find()
			->order(['Activities.id' => 'DESC'])
			->limit(4)
			->contain(['ActivityTypes', 'Creators']);

		$this->set(compact('newActivities'));
	}
}
