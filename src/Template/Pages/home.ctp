<?php $this->layout = 'lg_ad_layout';?>

<?php $newestCell = $this->cell('NewActivities');?>
<?php $podcastCell = $this->cell('NewActivities', [1]);?>
<?php $streamsCell = $this->cell('NewActivities', [2]);?>

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
						BLM Resources Card
					</td>
					<td>
						<a href="https://moreblminfo.carrd.co/" target="_blank">
							https://moreblminfo.carrd.co/
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
						Confessions of a Former Bastard Cop
					</td>
					<td>
						<a href="https://medium.com/@OfcrACab/confessions-of-a-former-bastard-cop-bb14d17bc759" target="_blank">
							https://medium.com/@OfcrACab
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
						Khan Academy - Black History Videos
					</td>
					<td>
						<a href="https://www.khanacademy.org/about/blog/post/620017972448198656/learn-about-black-history-politics-and-culture" target="_blank">
						https://www.khanacademy.org/
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
