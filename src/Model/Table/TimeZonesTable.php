<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class TimeZonesTable extends Table {
	public function initialize(array $config) {
		parent::initialize($config);
		$this->setDisplayField('name');
	}

}
