<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class GamesCatalogsTable extends Table {
	public function initialize(array $config) {
		$this->belongsTo('Games');
		$this->belongsTo('Users');
	}
}
