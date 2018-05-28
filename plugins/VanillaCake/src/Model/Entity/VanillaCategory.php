<?php
namespace VanillaCake\Model\Entity;

use Cake\ORM\Entity;

class VanillaCategory extends Entity {
	protected $_accessible = [
		'*' => true,
		'id' => false
	];
}
