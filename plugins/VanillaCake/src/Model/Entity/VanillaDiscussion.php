<?php
namespace VanillaCake\Model\Entity;

use Cake\ORM\Entity;

class VanillaDiscussion extends Entity {
	protected $_accessible = [
		'*' => true,
		'id' => false
	];
}
