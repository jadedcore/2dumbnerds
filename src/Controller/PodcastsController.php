<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;

class PodcastsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['rss', 'index']);
	}

	public function index() {
		$conditions = [
			'live_date <=' => date('Y-m-d H:i:s')
		];
		$podcasts = $this->Podcasts->find('all')->where($conditions)->order(['live_date' => 'DESC']);
		$this->set('podcasts', $podcasts);
	}

	public function rss() {
		$this->viewBuilder()
			->setLayout(false);

		$this->response = $this->response->withType('rss');

		$conditions = [
			'live_date <=' => date('Y-m-d H:i:s')
		];
		$podcasts = $this->Podcasts->find('all')->where($conditions);
		$this->set('podcasts', $podcasts);
	}
}
