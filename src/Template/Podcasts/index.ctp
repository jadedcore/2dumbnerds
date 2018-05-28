<div class="row">
	<div class="col-xs-12">
		<div class="jumbotron">
			<h1>Behold the Podcasts</h1>
			<p>
				You can listen in right here if you browser supports it, or you can subscribe on
				<a href="https://itunes.apple.com/us/podcast/2-dumb-nerds/id1296231706?mt=2">
					iTunes
				</a> or
				<a href="https://www.stitcher.com/podcast/2-dumb-nerds">
					Stitcher
				</a>.
			</p>
			<p>
				We are working "hard" to get comments and forums going. We will keep you posted...
				get it... forums... posted...
			</p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
			</thead>
			<tbody>
				<?php foreach($podcasts as $podcast):?>
					<tr>
						<td style="width:20%">
							<h4>
								<?= h($podcast['title']) . ': ' . h($podcast['subtitle']);?>
							</h4>
						</td>
						<td>
							<?= h($podcast['summary']);?>
						</td>
						<td>
							<audio controls>
								<source
									src="<?= h($podcast['local_url']);?>"
									type="audio/mp3"
								>
								Your browser does not support streaming audio.
							</audio>
						</td>
						<td>
							<h4>
								<a
									href="<?= h($podcast['local_url']);?>"
									download="<?= h($podcast['file']);?>"
									style="color:#d95b0d"
								>
									<span class="glyphicon glyphicon-download-alt"></span>
								</a>

							</h4>
						</td>
						<td>
							<h4>
								<a href="https://twitter.com/share?
									url=<?= urlencode("https://" . h($podcast['url']));?>&
									via=2dumbnerds&
									text=<?= urlencode("Check out the 2 Dumb Nerds podcast, " . h($podcast['subtitle']) . ".");?>"
								>
									<img src="/img/twitter.png" style="width:20px;"/>
								</a>
							</h4>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>
