<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class ActivityTypesTable extends Table {
	public function initialize(array $config) {
		parent::initialize($config);

		$this->hasMany('Activities');
	}
}
