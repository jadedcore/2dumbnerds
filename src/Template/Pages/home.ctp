<?php $this->layout = 'lg_ad_layout';?>

<?php $this->Html->script('https://embed.twitch.tv/embed/v1.js', ['block' => 'scriptFooter']);?>
<?php $this->Html->script('twitch', ['block' => 'scriptFooter']);?>

<?php $activityCell = $this->cell('NewActivities');?>
<div class="row">
	<div class="col-xs-12">
		<h1>New Poop</h1>
	</div>
</div>
<?= $activityCell;?>

<div class="row">
	<div class="col-xs-12">
		<h1>Streams of Poop</h1>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-9">
		<div id="twitch-embed"></div>
	</div>
	<div class="hidden-xs hidden-sm col-md-3">
		<a class="twitter-timeline" data-width="365" data-height="500" data-theme="dark" data-link-color="#E95F28" href="https://twitter.com/2DumbNerds?ref_src=twsrc%5Etfw">
			Tweets by 2DumbNerds
		</a>
		<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
	</div>
</div>
