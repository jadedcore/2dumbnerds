<?php
namespace VanillaCake\Controller\Admin;

use VanillaCake\Controller\AppController;
use Cake\Event\Event;

class VanillaCategoriesController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);

		$this->Security->setConfig('unlockedActions', ['delete']);
	}

	public function manageCategories() {
		$categories = $this->VanillaCategories->find('all', ['order' => ['VanillaCategories.lft' => 'ASC']]);
		$this->set(compact('categories'));
	}

	public function add() {
		$theCategory = $this->VanillaCategories->newEntity();

		// Only get categories that DO NOT allow_discussion and are not archived. These are the only
		// acceptable parent categories.  If it allows discussion it can not be a parent.
		$conditions = ['allow_discussion' => false, 'is_archived' => false];
		$categories = $this->VanillaCategories->find('list')->where($conditions);
		$this->loadModel('Roles');
		$roles = $this->Roles->find('list', [
			'keyField' => 'priority',
			'valueField' => 'name'
		])->toArray();

		if ($this->request->is('post')) {
			$theCategory = $this->VanillaCategories->patchEntity($theCategory, $this->request->getData());
			if ($this->VanillaCategories->save($theCategory)) {
				$this->Flash->success(__('The category has been saved.'));
				return $this->redirect(['action' => 'manageCategories']);
			}
			$this->Flash->error(__('Unable to add the category.'));
		}
		$this->set(compact('theCategory', 'categories', 'roles'));
	}

	public function edit($id = null) {
		$theCategory = $this->VanillaCategories->get($id);

		$conditions = ['allow_discussion' => false, 'is_archived' => false];
		$categories = $this->VanillaCategories->find('list')->where($conditions);

		if ($this->request->is(['post', 'put'])) {
			$this->VanillaCategories->patchEntity($theCategory, $this->request->getData());
			if ($this->VanillaCategories->save($theCategory)) {
				$this->Flash->success(__('The category has been updated.'));
				return $this->redirect(['action' => 'manageCategories']);
			}
			$this->Flash->error(__('Unable to update the category.'));
		}

		$this->loadModel('Roles');
		$roles = $this->Roles->find('list', [
			'keyField' => 'priority',
			'valueField' => 'name'
		])->toArray();

		$this->set(compact('theCategory', 'categories', 'roles'));
	}

	public function delete() {
		$this->autoRender = false;
		// $this->request->allowMethod(['post', 'delete']);
		$returnData = [
			'message' => 'Default failure status.',
			'status' => 'fail'
		];
		if (!empty($this->request->getData())) {
			$data = $this->request->getData();
			// This will error if there is no category with the provided ID.
			$theCategory = $this->VanillaCategories->get($data['category_id']);
			$underlings = $this->VanillaCategories->find('children', ['for' => $data['category_id']])->select('id');

			if ($this->VanillaCategories->delete($theCategory)) {
				$returnData = [
					'message' => 'Category has been deleted.',
					'status' => 'success',
					'underlings' => $underlings
				];
			} else {
				$returnData = [
					'message' => 'Unable to delete the category.',
					'status' => 'fail'
				];
			}
		}
		$this->response->type('json');
		$this->response->body(json_encode($returnData));
		return $this->response;
	}
}
