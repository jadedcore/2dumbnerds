<?php foreach ($theSeries['streams'] as $stream):?>
	<div class="row" style="height:315px">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2" style="padding-top:25px;">
					<img src="/img/games/<?= h($theSeries['game']['box_art']);?>" class="game-thumb-stream" />
				</div>
				<div class="col-md-4">
					<h2><?= h($theSeries['game']['name']);?></h2>
					<p>
						<?= h($stream['description']);?>
					</p>
				</div>
				<div class="col-md-6">
					<iframe
						width="560"
						height="315"
						src="https://www.youtube.com/embed/<?= h($stream['stream_link']);?>?rel=0&controls=1&showinfo=0"
						frameborder="0"
						allowfullscreen
					>
					</iframe>
				</div>
			</div>
		</div>
	</div>
<?php endforeach;?>
