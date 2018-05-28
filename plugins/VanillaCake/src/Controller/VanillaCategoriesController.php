<?php
namespace VanillaCake\Controller;

use VanillaCake\Controller\AppController;
use Cake\Event\Event;

class VanillaCategoriesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);

		$this->Auth->allow(['index', 'view']);
	}

	public function index() {
		// Don't show archived categories
		$conditions[]['VanillaCategories.is_archived'] = false;

		// If the user is not logged in, only show public otherwise only show what permissions allow.
		if (!$this->Auth->user()) {
			$conditions[]['VanillaCategories.is_public'] = true;
		} else {
			$conditions[]['VanillaCategories.read_auth >='] = $this->authUser['role']['priority'];
		}

		// This gets all categories that are children of root (ID 1)
		$categories = $this->VanillaCategories->find('children', ['for' => 1])
			->where($conditions)->order(['VanillaCategories.lft' => 'ASC'])->find('threaded');

		$this->set(compact('categories'));
	}

	public function view($id=null) {
		if (empty($id)) {
			$message = __d("vanilla_cake", "Can not display the dicussions for the specified category. The category was not found.");
			$this->Flash->error($message);
			return $this->redirect($this->request->referer());
		}
		$contain = ['VanillaDiscussions' => ['sort' => ['last_comment_date' => 'DESC']]];
		// Don't show archived Categories, that should be admin only. Also only show categories that allow discussion
		// since other categories are root level categories.
		$conditions = [
			'VanillaCategories.id' => $id,
			'VanillaCategories.is_archived' => false,
			'VanillaCategories.allow_discussion' => true
		];
		if (!$this->Auth->user()) {
			$conditions[]['VanillaCategories.is_public'] = true;
		} else {
			$conditions[]['VanillaCategories.read_auth >='] = $this->authUser['role']['priority'];
		}
		$theCategory = $this->VanillaCategories->find()
			->where($conditions)
			->contain($contain)
			->first();

		$users = $this->VanillaCategories->Owners->find('list', ['keyField' => 'id', 'valueField' => 'display_name'])->toArray();

		$this->set(compact('theCategory', 'users'));
	}
}
