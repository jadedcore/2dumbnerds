<?php
namespace VanillaCake\Model\Entity;

use Cake\ORM\Entity;

class VanillaComment extends Entity {
	protected $_accessible = [
		'*' => true,
		'id' => false
	];
}
