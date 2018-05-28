<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;

class StreamsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}

	public function add() {
		$theStream = $this->Streams->newEntity();
		$this->set(compact('theStream'));
		if ($this->request->is('post')) {
			$theStream = $this->Streams->patchEntity($theStream, $this->request->getData());
			if ($this->Streams->save($theStream)) {
				$this->Flash->success(__('Created new stream.'));
				return $this->redirect(['prefix' => false, 'action' => 'index']);
			}
			$message = 'Unable to create new stream, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$games = $this->Streams->Games->find('list');
		$series = $this->Streams->Series->find('list');
		$streamers = $this->Streams->Streamers->find('list');
		$this->set(compact('streamers', 'games', 'series'));
	}

	public function edit($streamID = null) {
		if (empty($streamID)) {
			throw new NotFoundException;
		}
		$theStream = $this->Streams->get($streamID);
		if ($this->request->is(['post', 'put'])) {
			$this->Streams->patchEntity($theStream, $this->request->getData());
			if ($this->Streams->save($theStream)) {
				$this->Flash->success(__('The stream has been updated.'));
				// return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to update the stream.'));
		}
		$games = $this->Streams->Games->find('list');
		$series = $this->Streams->Series->find('list');
		$streamers = $this->Streams->Streamers->find('list');
		$this->set(compact('theStream', 'games', 'series', 'streamers'));
	}
}
