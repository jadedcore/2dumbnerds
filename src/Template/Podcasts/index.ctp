<div class="row">
	<div class="col-xs-12">
		<div class="jumbotron">
			<h1>Behold the Podcasts</h1>
			<p>
				You can listen in right here if you browser supports it, or you can subscribe on
				<a href="https://itunes.apple.com/us/podcast/2-dumb-nerds/id1296231706?mt=2" target="_blank">
					iTunes
				</a>,
				<a href="https://open.spotify.com/show/5OF4bONoUlaQSeGFGTiFOK?si=R-wEfYDHTiqodmyUPQhMkQ" target="_blank">
					Spotify
				</a> or
				<a href="https://www.stitcher.com/podcast/2-dumb-nerds" target="_blank">
					Stitcher
				</a>.
			</p>
			<p>
				We are working "hard" to get comments going. You can always join us on
				<a href="https://discord.gg/62nA43u" target="blank">Discord</a> to let us know what you think
				or just shoot the shit.
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
								<a href="/podcasts/listen/<?= $podcast['id'];?>">
									<?= h($podcast['title']) . ': ' . h($podcast['subtitle']);?>
								</a>
							</h4>
						</td>
						<td>
							<?= h($podcast['summary']);?>
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
