<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class StreamsTable extends Table {
	public function initialize(array $config) {
		$this->addBehavior('Timestamp');
		$this->belongsTo('Streamers', ['className' => 'Users'])
			->setForeignKey('streamer_id')
			->setProperty('streamer');

		$this->belongsTo('Series', ['className' => 'Series'])
			->setForeignKey('series_id')
			->setProperty('series');

		$this->belongsTo('Games');
	}

	public function validationDefault(Validator $validator) {
		return $validator;
	}

	public function afterSave($event, $entity, $options) {
		if ($entity->isNew()) {
			$this->__bumpSeries($entity['series_id']);
		}
	}

	private function __bumpSeries($seriesID = null) {
		$theSeries = $this->Series->get($seriesID);
		$this->Series->touch($theSeries);
		$this->Series->save($theSeries);
		return;
	}
}
