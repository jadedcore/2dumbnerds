<?php
namespace VanillaCake\View\Helper;

use Cake\View\Helper;

class ForumHelper extends Helper {
	public function timeSincePost($postTime = null) {
		if (empty($postTime)) {
			return null;
		}

		$seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($postTime);
		$minutes = $seconds/60;
		$hours = $minutes/60;
		$days = $hours/24;

		$result = $seconds . ' sec';

		if ($days > 90) {
			$result = '90+ Days Ago';
		} elseif ($days > 1) {
			$result = round($days) . ' days';
		} elseif ($hours > 1) {
			$result = round($hours) . ' hours';
		} elseif ($minutes > 1) {
			$result = round($minutes) . ' mins';
		}
		return $result;
	}
}
