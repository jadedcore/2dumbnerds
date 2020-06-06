<?php
namespace Corners\Model\Table;
use Cake\I18n\Time;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class CornerEventsTable extends Table {
	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);
		$this->setTable('corner_events');
		$this->addBehavior('Timestamp');

		$this->hasMany('CornerMatches', ['className' => 'Corners.CornerMatches']);
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

	/**
	 * Checks to see if picks for the specified event can still be submitted.
	 *
	 * @param int $eventID - ID of the event to check
	 */
	public function arePicksOpen($eventID = null) {
		$theEvent = $this->get($eventID);
		$time = new Time();

		return ($theEvent->event_time > $time ? true : false);
	}
}
