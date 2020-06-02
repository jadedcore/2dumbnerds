<?php $this->layout = 'lg_ad_layout';?>

<?php $this->Html->script('https://embed.twitch.tv/embed/v1.js', ['block' => 'scriptFooter']);?>
<?php $this->Html->script('twitch', ['block' => 'scriptFooter']);?>

<div class="row">
	<div class="col-xs-12">
		<h1>Black Lives Matter and Protest Support Links</h1>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<table class="table">
			<thead>
				<tr>
					<th>
						Resource
					</th>
					<th>
						URL
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						Allyship 101
					</td>
					<td>
						<a href="https://medium.com/@jewelifeguni/allyship-101-standing-together-and-protecting-your-black-neighbors-5beae39fb793" target="_blank">
							https://medium.com/@jewelifeguni
						</a>
					</td>
				</tr>
				<tr>
					<td>
						Black Lives Matter
					</td>
					<td>
						<a href="https://blacklivesmatter.com/" target="_blank">
							https://blacklivesmatter.com
						</a>
					</td>
				</tr>
				<tr>
					<td>
						Boston Bail Fund
					</td>
					<td>
						<a href="https://www.massbailfund.org/" target="_blank">
							https://www.massbailfund.org/
						</a>
					</td>
				</tr>
				<tr>
					<td>
						Brooklyn Bail Fund
					</td>
					<td>
						<a href="https://brooklynbailfund.org/" target="_blank">
							https://brooklynbailfund.org/
						</a>
					</td>
				</tr>
				<tr>
					<td>
						Campaign Zero
					</td>
					<td>
						<a href="https://joincampaignzero.org/" target="_blank">
							https://joincampaignzero.org/
						</a>
					</td>
				</tr>
				<tr>
					<td>
						Justice For Big Floyd
					</td>
					<td>
						<a href="https://www.justiceforbigfloyd.com/" target="_blank">
							https://www.justiceforbigfloyd.com/
						</a>
					</td>
				</tr>
				<tr>
					<td>
						Know Your Rights Camp
					</td>
					<td>
						<a href="https://www.knowyourrightscamp.com" target="_blank">
							https://www.knowyourrightscamp.com
						</a>
					</td>
				</tr>
				<tr>
					<td>
						Minnesota Freedom Fund
					</td>
					<td>
						<a href="https://minnesotafreedomfund.org/" target="_blank">
							https://minnesotafreedomfund.org/
						</a>
					</td>
				</tr>
				<tr>
					<td>
						NAACP
					</td>
					<td>
						<a href="https://www.naacp.org/" target="_blank">
							https://www.naacp.org/
						</a>
					</td>
				</tr>
				<tr>
					<td>
						National Police Accountability Project
					</td>
					<td>
						<a href="https://www.nlg-npap.org/" target="_blank">
							https://www.nlg-npap.org/
						</a>
					</td>
				</tr>
				<tr>
					<td>
						New York Bail Fund
					</td>
					<td>
						<a href="https://www.libertyfund.nyc/" target="_blank">
							https://www.libertyfund.nyc/
						</a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

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
