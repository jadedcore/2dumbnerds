<?php
namespace CodexEorzea\Controller\Admin;

use CodexEorzea\Controller\AppController;
use Cake\Event\Event;

class RegionsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->beforeRedirect = false;
	}

	public function index() {
		$regions = $this->Regions->find('list')->toArray();
		$this->set(compact('regions'));
	}
}
