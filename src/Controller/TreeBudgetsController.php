<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;
use Cake\Log\Log;
use Cake\Utility\Hash;

class TreeBudgetsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}
}
