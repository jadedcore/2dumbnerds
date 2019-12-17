<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Hash;
use Cake\Log\Log;

class StreamsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['index', 'showSeries', 'atomFeed']);
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

	public function atomFeed($hubChallenge=null) {
		$this->autoRender = false;
		$queryParams = $this->request->query();
		if (isset($queryParams['hub_verify_token']) &&
			$queryParams['hub_verify_token'] == '7e3e4d2e-6f7b-44c0-884c-3d9d84beab4a'
		) {
			$ytData = $this->__parseYoutubeData(file_get_contents('php://input'));
			Log::info(print_r($ytData, true));
			return $this->response->withStatus(200)->withStringBody($this->request->query('hub_challenge'));
		}

		return $this->response->withStatus(403);
	}

	private function __parseYoutubeData($data) {
		$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);
		return $xml;
	}
}
