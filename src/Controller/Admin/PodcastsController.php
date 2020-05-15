<?php
namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Log\Log;

class PodcastsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Security->setConfig('unlockedActions', ['upload', 'add']);
	}

	public function add() {
		$theCast = $this->Podcasts->newEntity();
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['url'] = '2dumbnerds.com/audio/' . $data['file'];
			$data['local_url'] = '/audio/' . $data['file'];
			$data['guid'] = $data['url'];
			$data['created_by'] = $this->authUser['id'];
			$data['modified_by'] = $this->authUser['id'];
			$theCast = $this->Podcasts->patchEntity($theCast, $data);
			if ($this->Podcasts->save($theCast)) {
				$this->Flash->success(__('Created new podcasts.'));
				return $this->redirect(['prefix' => 'admin', 'action' => 'add']);
			}
			$message = 'Unable to create new podcast, please correct errors and try again.';
			$this->Flash->error(__($message));
		}
		$this->set(compact('theCast'));
	}

	public function upload() {
		ini_set('max_execution_time', '120');

		$this->autoRender = false;
		$returnData = $this->request->getData();

		if($this->__checkFile($returnData['file'])) {
			$fileName = $this->__moveFile($returnData['file']);
			Log::info($fileName);
			$returnData['new_file'] = $fileName;
			return $this->response->withType('application/json')->withStringBody(json_encode($returnData));
		}
		return $this->response->withStatus(500);
	}

	private function __checkFile($uploadData = []) {
		Log::info(print_r($uploadData, true));
		if (!isset($uploadData['error']) || $uploadData['error'] == true) {
			Log::info('File upload error.');
			return false;
		}

		if (!isset($uploadData['tmp_name']) || empty($uploadData['tmp_name'])) {
			Log::info('Missing file name.');
			return false;
		}

		if (!isset($uploadData['type'])) {
			Log::info('Missing Mime type.');
			return false;
		}

		// May need to do some additional file checking in the future.
		// Look at https://secure.php.net/manual/en/function.id3-get-tag.php
		// Using mime_content_type() may return application/octet-stream on some mp3 files
		$allowed = [
			'mp4' => 'audio/x-m4a',
			'mpeg' => 'audio/mpeg',
			'jpg' => 'image/jpeg' // For quick testing... Disable later.
		];
		if (!array_search($uploadData['type'], $allowed)) {
			Log::info('Mime type not allowed. Type uploaded: ' . $uploadData['type']);
			return true;
		}
		return true;
	}

	private function __moveFile($fileData = null) {
		// Get the file extension
		$exploded = explode('.', $fileData['name']);
		$ext = end($exploded);

		// Rename the file to a safe name with user ID and Unix timestamp.
		$fileName = 'podcast_' . $this->authUser['id'] . '_' . time() . '.' . $ext;

		if (move_uploaded_file($fileData['tmp_name'], '/var/www/html/dumbnerds_app/webroot/audio/' . $fileName)) {
			Log::info('Mime: ' . mime_content_type('/var/www/html/dumbnerds_app/webroot/audio/' . $fileName));
			return $fileName;
		}
		Log::info('Could not move file.');
		return false;
	}
}
