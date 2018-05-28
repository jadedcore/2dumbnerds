<?php
namespace App\Controller;

use Cake\Event\Event;
use Cake\Log\Log;

class OrdersController extends AppController {
	public function beforeFilter(Event $event) {
		$this->Auth->allow(['create', 'interact']);
		$this->Security->setConfig('unlockedActions', [
			'create', 'interact'
		]);
	}

	public function create() {
		$this->autoRender = false;
		$data = $this->request->getData();
		if ($data['token'] !== 'hXDnugYpAKvcM2i6n2QEH0Vm' || $data['team_id'] !== 'T02BACQ2P') {
			return $this->response->withStatus(500);
		}
		Log::debug(print_r($data, true));

		if (empty($data['text'])) {
			$message = 'You did not specify where you want to order from.';
			$this->_slackRespond($data['response_url'], $message);
			return $this->response->withStatus(200, '');
		}

		$conditions = [
			'name' => strtolower($data['text'])
		];

		if (!$restaurant = $this->Orders->Restaurants->find()->where($conditions)->first()) {
			$message = "We didn't find " . $data['text'] . " in your available restaurants.";
			$attachments[0]['text'] = "Would you like to create this restaurant?";
			$attachments[0]['callback_id'] = "make_restaurant";
			$attachments[0]['actions'][0] = [
				'name' => 'restaurant',
				'text' =>'Cancel',
				'type' => 'button',
				'value' => 'cancel'
			];
			$attachments[0]['actions'][1] = [
				'name' => 'restaurant',
				'text' =>'Add It',
				'type' => 'button',
				'style' => 'primary',
				'value' => $data['text']
			];

			$this->_slackRespond($data['response_url'], $message, $attachments);
			return $this->response->withStatus(200, '');
		}

		Log::debug(print_r($restaurant, true));
		return $this->response->withStatus(200);

		// $users = json_decode($this->_slackCurl());
		// Log::debug(print_r($users, true));

		/*
		$availableUsers = [];
		foreach ($users['members'] as $member) {
			if (!$member['deleted']) {
				$availableUsers[$member['id']] = [
					'name' => $member['name']
				];
			}
		}
		*/
	}

	public function interact() {
		$this->autoRender = false;
		$data = $this->request->getData();
		Log::debug(print_r($data, true));
	}

	protected function _slackRespond($target = null, $message = null, $attachments = [], $responseType = 'ephemeral') {
		if (empty($target) || empty($message)) {
			return false;
		}

		$payload['text'] = $message;
		if (!empty($attachments)) {
			$payload['attachments'] = $attachments;
		}
		$json = json_encode($payload);
		Log::debug($json);
		$curlHandle = curl_init($target); // <-- Initialize curl with target URL
		curl_setopt($curlHandle, CURLOPT_POST, TRUE);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $json);

		if($response = curl_exec($curlHandle)){ // <-- Execute the actual curl operation
			curl_close($curlHandle); // <-- Close the curl connection
			return true;
		}
		else{
			curl_close($curlHandle); // <-- Close the curl connection
			CakeLog::write('error', 'Problem sending message to slack.  Request: '.$json.' Response: '.$response);
			return false;
		}
	}

	protected function _slackCurl() {
		$data = [
			'token' => 'xoxp-2384432091-2384432093-289412916114-be3020b7b7ee5263387ba97dd0ad8a89'
		];
		$curlHandle = curl_init("https://slack.com/api/users.list"); // <-- Initialize curl with target URL
		curl_setopt($curlHandle, CURLOPT_POST, TRUE);
		curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE);

		$response = curl_exec($curlHandle); // <-- Execute the actual curl operation
		curl_close($curlHandle); // <-- Close the curl connection
		return $response;
	}
}
