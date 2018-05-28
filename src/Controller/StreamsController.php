<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Hash;

class StreamsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['index', 'showSeries']);
	}

	public function index() {
		$limit = 10;
		$order = ['Series.modified' => 'desc'];
		$contain = ['Streams', 'Games'];
		$series = $this->Streams->Series->find('all', compact('limit', 'order', 'contain'));

		$this->set(compact('series'));
	}

	public function showSeries($seriesID=null) {
		if (empty($seriesID)) {
			throw new NotFoundException;
		}
		$contain = ['Streams', 'Games'];
		$theSeries = $this->Streams->Series->get($seriesID, compact('contain'));
		$this->set(compact('theSeries'));
	}
}
