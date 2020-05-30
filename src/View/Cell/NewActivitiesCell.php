<?php
namespace App\View\Cell;

use Cake\View\Cell;

class NewActivitiesCell extends Cell {

	public function display($activityType = null) {
		$this->loadModel('Activities');
		$this->loadModel('Users');
		$newActivities = $this->Activities->find()
			->order(['Activities.created' => 'DESC'])
			->limit(4)
			->contain(['ActivityTypes', 'Creators']);

		if (!empty($activityType)) {
			$newActivities->where(['activity_type_id' => $activityType]);
		}

		$this->set(compact('newActivities'));
	}
}
