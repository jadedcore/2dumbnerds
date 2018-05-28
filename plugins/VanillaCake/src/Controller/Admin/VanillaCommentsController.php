<?php
namespace VanillaCake\Controller\Admin;

use VanillaCake\Controller\AppController;
use Cake\Event\Event;

class VanillaCommentsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
	}
}
