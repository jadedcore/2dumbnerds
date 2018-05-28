<?php
namespace VanillaCake\Controller;

use VanillaCake\Controller\AppController;
use Cake\Event\Event;

class VanillaDiscussionsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);

		$this->Auth->allow(['index', 'view']);
	}

	public function index($categoryID = null) {
		if (empty($categoryID)) {
			$this->Flash->error(__('Can not display discussions. Category not found.'));
			$this->redirect($this->request->referer());
		}

		$conditions = ['vanilla_category_id' => $categoryID];
		$discussions = $this->VanillaDiscussions->find('all')->where($conditions);
	}

	public function view($discussionID = null) {
		if (empty($discussionID)) {
			$this->Flash->error(__('Can not display discussion. Discussion not found.'));
			$this->redirect($this->request->referer());
		}

		// I still need to cut down the number of fields retrieved in the contain. Currently pulling too many
		$contain = [
			'Owners',
			'VanillaComments' => [
				'sort' => ['VanillaComments.created' => 'ASC'],
				'Owners'
			], 'VanillaCategories'];
		$theDiscussion = $this->VanillaDiscussions->get($discussionID, compact('contain'));
		$Parsedown = new \Parsedown();
		$this->set(compact('theDiscussion', 'Parsedown'));
	}

	public function add($categoryID = null) {
		if (empty($categoryID)) {
			$message = __d("vanilla_cake", "Can not add a discussion without specifying a category.");
			$this->Flash->error($message);
			return $this->redirect('/vanilla-cake/vanilla-categories/index');
		}
		$theCategory = $this->VanillaDiscussions->VanillaCategories->get($categoryID);
		$theDiscussion = $this->VanillaDiscussions->newEntity();
		$conditions = ['allow_discussion' => true, 'is_archived' => false];
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['vanilla_category_id'] = $theCategory->id;
			$data['created_by'] = $this->authUser['id'];
			$theDiscussion = $this->VanillaDiscussions->patchEntity($theDiscussion, $data);
			if ($this->VanillaDiscussions->save($theDiscussion)) {
				$this->VanillaDiscussions->VanillaCategories->updateCategoryMeta($theCategory->id);
				$this->VanillaDiscussions->VanillaCategories->incrementDiscussionCount($theCategory->id);
				$this->Flash->success(__('The discussion has been posted.'));
				return $this->redirect('/vanilla-cake/vanilla-discussions/view/' . $theDiscussion->id);
			}
			$this->Flash->error(__('Unable to post discussion thread.'));
		}
		$this->set(compact('theDiscussion'));
	}

	public function edit($discussionID = null) {
		if (empty($discussionID)) {
			$message = __d("vanilla_cake", "You didn't specify a discussion to edit.");
			$this->Flash->error($message);
			return $this->redirect('/vanilla-cake/vanilla-categories/index');
		}
		$theDiscussion = $this->VanillaDiscussions->get($discussionID);
		if (($theDiscussion->created_by == $this->authUser['id']) || ($this->authUser['role']['name'] == 'admin')) {
			if ($this->request->is(['post', 'put'])) {
				$data = $this->request->getData();
				$data['modified_by'] = $this->authUser['id'];
				$theDiscussion = $this->VanillaDiscussions->patchEntity($theDiscussion, $data);
				if ($this->VanillaDiscussions->save($theDiscussion)) {
					$this->Flash->success(__('The discussion has been edited.'));
					return $this->redirect('/vanilla-cake/vanilla-discussions/view/' . $theDiscussion->id);
				}
				$this->Flash->error(__('Unable to edit discussion thread.'));
			}
		}
		$this->set(compact('theDiscussion'));
	}
}
