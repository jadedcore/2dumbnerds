<?php
namespace VanillaCake\Controller;

use VanillaCake\Controller\AppController;
use Cake\Event\Event;

class VanillaCommentsController extends AppController {
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);

		$this->Auth->allow(['index', 'view']);
		$this->Security->setConfig('unlockedActions', ['delete']);
	}

	public function index() {

	}

	public function view() {

	}

	public function add($discussionID = null, $commentID = null) {
		if (empty($discussionID)) {
			$message = __d("vanilla_cake", "Can not add a comment without specifying a discussion.");
			$this->Flash->error($message);
			return $this->redirect('/vanilla-cake/vanilla-categories/index');
		}

		$theDiscussion = $this->VanillaComments->VanillaDiscussions->get($discussionID, ['contain' => 'Owners']);

		// Verify user can see this discussion
		if (!empty($commentID)) {
			$quoteComment = $this->VanillaComments->get($commentID, ['contain' => 'Owners']);
			$this->set(compact('quoteComment'));
			// Verify this user can see this comment
		}

		$theComment = $this->VanillaComments->newEntity();
		$conditions = ['is_closed' => false];
		if ($this->request->is('post')) {
			$data = $this->request->getData();
			$data['vanilla_discussion_id'] = $theDiscussion->id;
			$data['created_by'] = $this->authUser['id'];
			$theComment = $this->VanillaComments->patchEntity($theComment, $data);
			if ($this->VanillaComments->save($theComment)) {
				$this->VanillaComments->VanillaDiscussions->updateDiscussion($theComment);
				$this->Flash->success(__('Your reply has been posted.'));
				return $this->redirect('/vanilla-cake/vanilla-discussions/view/' . $theDiscussion->id);
			}
			$this->Flash->error(__('Unable to post your reply.'));
		}
		$Parsedown = new \Parsedown();
		$this->set(compact('theDiscussion', 'theComment', 'Parsedown'));
	}

	public function edit($commentID = null) {
		$theComment = $this->VanillaComments->get($commentID);
		if (($theComment->created_by == $this->authUser['id']) || ($this->authUser['role']['name'] == 'admin')) {
			if ($this->request->is(['post', 'put'])) {
				$data = $this->request->getData();
				$data['modified_by'] = $this->authUser['id'];
				$this->VanillaComments->patchEntity($theComment, $data);
				if ($this->VanillaComments->save($theComment)) {
					$message = __('Comment has been edited.');
					$this->Flash->success($message);
					$this->redirect('/vanilla-cake/vanilla-discussions/view/' . $theComment->vanilla_discussion_id);
				}
			}
			$this->set(compact('theComment'));
		} else {
			$message = __('You are not authorized to edit this comment.');
			$this->Flash->error($message);
			$this->redirect($this->request->referer());
		}
	}

	public function delete() {
		if (!$this->request->is('ajax')) {
			return null;
		}

		if ($this->request->is(['post', 'put'])) {
			$data = $this->request->getData();
			$theComment = $this->VanillaComments->get($data['commentID']);
			if (($theComment->created_by == $this->authUser['id']) || ($this->authUser['role']['name'] == 'admin')) {
				$theComment->deleted = date('Y-m-d H:i:s');
				$theComment->deleted_by = $this->authUser['id'];
				if ($this->VanillaComments->save($theComment)) {
					return $this->response->withStatus(200);
				} else {
					return $this->response->withStatus(500);
				}
			}
		}
	}
}
