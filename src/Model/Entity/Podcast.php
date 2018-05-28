<?php
namespace App\Model\Entity;
use Cake\ORM\Entity;

class Podcast extends Entity {
	// Make all fields mass assignable except for primary key field "id"
	protected $_accessible = [
		'*' => true,
		'id' => false
	];

	protected function _getKeywordsDecoded() {
		if (!empty($this->_properties['keywords'])) {
			return json_decode($this->_properties['keywords']);
		}
		return [];
	}

	protected function _setKeywords($keywords) {
		if (!empty($keywords)) {
			$keywords = explode(',', $keywords);
			foreach ($keywords as $key => $keyword) {
				$keywords[$key] = trim($keyword);
			}
			return json_encode($keywords);
		}
		return '';
	}
}
