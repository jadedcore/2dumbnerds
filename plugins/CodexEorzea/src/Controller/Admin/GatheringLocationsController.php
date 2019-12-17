<?php
namespace CodexEorzea\Controller\Admin;

use CodexEorzea\Controller\AppController;
use Cake\Event\Event;

class GatheringLocationsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$contain = [
			'Regions',
			'GatheringTypes'
		];
		$locations = $this->GatheringLocations->find()->contain($contain)->toArray();
		$this->set(compact('locations'));
	}

	public function add() {
		$theLocation = $this->GatheringLocations->newEntity();
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$theLocation = $this->GatheringLocations->patchEntity($theLocation, $data);
			$this->GatheringLocations->save($theLocation);
			return $this->redirect($this->request->getRequestTarget());
		}
		$regions = $this->GatheringLocations->Regions->find('list');
		$gatheringTypes = $this->GatheringLocations->GatheringTypes->find('list');
		$this->set(compact('theLocation', 'regions', 'gatheringTypes'));
	}
}
