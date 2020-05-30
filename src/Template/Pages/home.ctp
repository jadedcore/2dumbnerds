<?php // $this->layout = 'lg_ad_layout';?>

<?php $newestCell = $this->cell('NewActivities');?>
<?php $podcastCell = $this->cell('NewActivities', [1]);?>
<?php $streamsCell = $this->cell('NewActivities', [2]);?>

<div class="row">
	<div class="col-xs-12">
		<h1>Newest Poop</h1>
	</div>
</div>
<?= $newestCell;?>

<div class="row">
	<div class="col-xs-12">
		<h1>Streams of Poop</h1>
	</div>
</div>
<?= $streamsCell;?>

<div class="row">
	<div class="col-xs-12">
		<h1>Poop-casts</h1>
	</div>
</div>
<?= $podcastCell;?>
