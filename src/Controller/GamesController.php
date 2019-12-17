<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Log\Log;

class GamesController extends AppController {
	public $paginate = [
		'limit' => 25
	];

	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['alexa']);
		$this->Security->setConfig('unlockedActions', ['alexa']);
	}

	public function index() {
		$query = $this->Games->find()->order(['Games.name' => 'asc']);
		$games = $this->paginate($query);
		$this->set(compact('games'));
	}

	public function alexa() {
		$this->autoRender = false;
		$data = $this->request->getData();
		$request = $data['request'];

		if (!$this->_authenticateAlexa($request)) {
			return $this->response->withStatus(403);
		}

		if ($request['type'] == 'LaunchRequest') {
			return $this->_handleLaunchRequest($request);
		}

		if ($request['type'] == 'IntentRequest') {
			return $this->_handleIntentRequest($data);
		}
	}

	private function _handleLaunchRequest($request = null) {
		$theResponse = [
			'version' => '1.0',
			'response' => [
				'outputSpeech' => [
					'type' => 'PlainText',
					'text' => 'Welcome to Codex Eorzea. You can ask me how to find a resource.'
				]
			]
		];
		return $this->response->withType('application/json')->withStatus(200)
			->withStringBody(json_encode($theResponse));
	}

	private function _handleIntentRequest($request = null) {
		$theRequest = $request;
		$request = $theRequest['request'];
		$intent = $request['intent'];
		if ($intent['name'] == 'item_location') {
			// No Requested Item
			if (empty($intent['slots']['Item']['value'])) {
				$theResponse = [
					'version' => '1.0',
					'sessionAttributes' => $theRequest['session'],
					'response' => [
						'shouldEndSession' => false,
						'directives' => [[
							'type' => 'Dialog.Delegate',
							'updatedIntent' => [
								'name' => 'item_location',
								'confirmationStatus' => 'NONE',
								'slots' => [
									'Item' => [
										'name' => 'Item',
										'value' => '',
										'confirmationStatus' => 'NONE'
									]
								]
							]
						]]
					]
				];
				return $this->response->withType('application/json')->withStatus(200)
					->withStringBody(json_encode($theResponse));
			} else {
				$answer = $this->_itemLocation($intent);
				if (!$answer) {
					$answer = "I'm not sure where that is located.";
				}

				$theResponse = [
					'version' => '1.0',
					'response' => [
						'outputSpeech' => [
							'type' => 'PlainText',
							'text' => $answer
						]
					]
				];
				return $this->response->withType('application/json')->withStatus(200)
					->withStringBody(json_encode($theResponse));
			}
		}
	}

	private function _itemLocation($intent = null) {
		$item = $intent['slots']['Item']['resolutions']['resolutionsPerAuthority'][0]['values'][0]['value']['name'];
		if ($item == 'Bone Chip') {
			$answer = 'Bone chips can be found at a level five mining point at Spineless Basin, in Central Thanalan.';
			return $answer;
		}
		return false;
	}

	private function _authenticateAlexa($request = null) {
		if (!empty($request)) {
			return true;
		}
		return false;
	}
}
