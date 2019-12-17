<?php
	/**
	 * Image 262.5 x 175
	 */
?>
<?php
	$class = '';
	if ($type == 'podcast') {
		$class = 'orange';
	} elseif ($type == 'youtube') {
		$class = 'red';
	} elseif ($type == 'article') {
		$class = 'green';
	} else {
		$class = 'blue';
	}

	$target = '';
	if ($newTab) {
		$target = '_blank';
	}
?>

<div class="newsCard <?= $class;?>">
	<a href="<?= h($link);?>" target="<?= $target;?>">
		<div class="row">
			<div class="col-xs-12">
				<!-- IMAGE ROW 175px -->
				<div class="row">
					<div class="col-xs-12">
						<div class="newsCard-image">
							<?php if (!empty($image)):?>
								<img src="<?= h($image);?>" />
							<?php else:?>
								<img src="/img/missing_activity.png" />
							<?php endif;?>
						</div>
					</div>
				</div>
				<!-- TITLE ROW 46px -->
				<div class="row">
					<div class="col-xs-12">
						<div class="newsCard-title">
							<?php
								if (strlen($title) > 25) {
									$title = substr($title, 0, 21) . '...';
								}
							?>
							<h4><?= h($title);?></h4>
						</div>
					</div>
				</div>
				<!-- DESCRIPTION ROW -->
				<div class="row">
					<div class="col-xs-12">
						<div class="newsCard-description">
							Date: <?= date('M-d-Y H:i', strtotime($date));?> <br />
							Posted By: <?= h($author);?>
						</div>
					</div>
				</div>
				<!-- ACTION ROW 50PX -->
				<div class="row">
					<div class="col-xs-12">
						<div class="newsCard-action">
							<hr />
							<span class="glyphicon glyphicon-heart"></span>
							<span class="glyphicon glyphicon-retweet"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</a>
</div>
