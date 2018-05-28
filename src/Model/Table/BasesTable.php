<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

class BasesTable extends Table {
	public function initialize(array $config) {
		parent::initialize($config);
		$this->addBehavior('Timestamp');

		$this->hasMany('Podcasts');
		$this->belongsTo('Owner', [
			'foreignKey' => 'owner_id',
			'className' => 'Users'
		]);

		$this->belongsToMany('Users', [
			'foreignKey' => 'base_id',
			'targetForeignKey' => 'user_id',
			'joinTable' => 'bases_users',
		]);
	}
}
