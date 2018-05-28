<?php
namespace VanillaCake\View;
use App\View\AppView as BaseView;
class AppView extends BaseView {
	public function initialize() {
		parent::initialize();
		$this->loadHelper('Forum');
	}
}
