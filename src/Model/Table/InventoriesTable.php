<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class InventoriesTable extends Table {
	public function initialize(array $config) {
		$this->belongsTo('Games');
		$this->belongsTo('Users');
	}

	public function checkInventory($gameID = null, $userID = null) {
		$conditions = [
			'Inventories.user_id' => $userID,
			'Inventories.game_id' => $gameID
		];
		$query = $this->find()->where($conditions);

		return ($query->count() > 0) ? true : false;
	}

	public function removeGame($gameID = null, $userID = null) {
		// The game is not in this users inventory. Do nothing.
		if (!$this->checkInventory($gameID, $userID)) {
			return false;
		}

		$conditions = [
			'game_id' => $gameID,
			'user_id' => $userID
		];
		$inventoryRecord = $this->find()->where($conditions)->first();
		if ($this->delete($inventoryRecord)) {
			return true;
		}
		return false;
	}
}
