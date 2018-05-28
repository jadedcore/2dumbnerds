<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class SeriesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function index() {
		$order = ['Series.name' => 'asc'];
		$contain = ['Games'];
		$series = $this->Series->find('all', compact('order', 'contain'));

		$this->set(compact('series'));
	}

	public function add() {
		$theSeries = $this->Series->newEntity();
		$this->set(compact('theSeries'));
		if ($this->request->is('post')) {
			$theSeries = $this->Series->patchEntity($theSeries, $this->request->getData());
			if ($this->Series->save($theSeries)) {
				$this->Flash->success(__('Created new series.'));
				return $this->redirect($this->request->referer());
			}
			$message = 'Unable to create new series, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$games = $this->Series->Games->find('list');
		$this->set(compact('games'));
	}
}
