<?php
namespace Corners\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CornerPicksTable extends Table {
	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);
		$this->setTable('corner_picks');
		$this->addBehavior('Timestamp');

		$this->belongsTo('Users', ['className' => 'Users'])
			->setForeignKey('user_id');

		$this->belongsTo('CornerMatches', ['className' => 'Corners.CornerMatches'])
			->setForeignKey('corner_match_id');

		$this->belongsTo('CornerFighters', ['className' => 'Corners.CornerFighters'])
			->setForeignKey('corner_fighter_id');
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator) {
		return $validator;
	}

	public function makePick($userID = null, $matchID = null, $fighterID = null) {
		$thePick = $this->newEntity();
		$thePick = $this->patchEntity($thePick, $pickData);
		$this->CornerMatches->CornerEvents->arePicksOpen(1);
	}

	/**
	 * Checks to see if the specified user has already made a pick for that match.
	 *
	 * @param int $userID - The ID of the user whose pick needs to be checked
	 * @param int $matchID - The ID of the match that the pick is for
	 * @return mixed
	 */
	public function alreadyPicked($userID = null, $matchID = null) {
		if (empty($userID)) {
			$error = __('isNotPicked requries a userID as the first argument.');
			throw new \InvalidArgumentException($error);
		}
		if (empty($matchID)) {
			$error = __('isNotPicked requries a matchID as the second argument.');
			throw new \InvalidArgumentException($error);
		}
		$conditions = [
			'CornerPicks.user_id' => $userID,
			'CornerPicks.corner_match_id' => $matchID
		];

		$pick = $this->find()->where($conditions);
		return ($pick->count() > 0 ? $pick : false);
	}
}
