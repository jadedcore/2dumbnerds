<?php if (!empty($authUser['role']['name']) && $authUser['role']['name'] === 'admin'):?>
	<div class="row">
		<div class="col-md-12">
			<a href="/admin/streams/add" class="btn btn-success">
				<span class="glyphicon glyphicon-plus"></span>
				New Stream
			</a>
		</div>
	</div>
<?php endif;?>

<?php foreach ($series as $streams):?>
	<?php if (!empty($streams['streams'])):?>
		<div class="row" style="height:315px">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2" style="padding-top:25px;">
						<img src="/img/games/<?= h($streams['game']['box_art']);?>" class="game-thumb-stream" />
					</div>
					<div class="col-md-4">
						<h2><?= h($streams['game']['name']);?></h2>
						<p>
							<?= h($streams['streams'][0]['description']);?>
						</p>
						<?php $streamCount = count($streams['streams']);?>
						<?php if ($streamCount > 1):?>
							<?php $streamCount-= 1;?>
							<a href="/streams/show_series/<?= $streams['id'];?>">
								<?= $streamCount;?> Previous
								<?php if ($streamCount > 1):?>
									Streams
								<?php else:?>
									Stream
								<?php endif;?>
								in this Series
							</a>
						<?php endif;?>
					</div>
					<div class="col-md-6">
						<iframe
							width="560"
							height="315"
							src="https://www.youtube.com/embed/<?= h($streams['streams'][0]['stream_link']);?>?rel=0&controls=1&showinfo=0"
							frameborder="0"
							allowfullscreen
						>
						</iframe>
					</div>
				</div>
			</div>
		</div>
	<?php endif;?>
<?php endforeach;?>
