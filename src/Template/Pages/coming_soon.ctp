<div class="row">
	<div class="col-md-4">
		<img src="/img/dummies.png" style="width:100%" />
	</div>
	<div class="col-md-8">
		<div class="jumbotron" style="background-color:#222">
			<h1 style="color:#a9470a">Coming Soon-ish</h1>
			<p style="color:#9d9d9d;">
				Like whenever we get the fuck around to it... Here is a .ga-if from the inter-webs while you
				wait.
			</p>
			<?php
				$gifs = array(
					'<iframe src="https://giphy.com/embed/xTiTnwgQ8Wjs1sUB4k" width="480" height="270" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/southpark-comedy-central-10x08-xTiTnwgQ8Wjs1sUB4k">via GIPHY</a></p>',
					'<iframe src="https://giphy.com/embed/h7JdpZoXa1Peo" width="480" height="271" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/game-video-sliding-h7JdpZoXa1Peo">via GIPHY</a></p>',
					'<iframe src="https://giphy.com/embed/Yxmr2cliXJhXG" width="480" height="390" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/cat-mario-super-Yxmr2cliXJhXG">via GIPHY</a></p>',
					'<iframe src="https://giphy.com/embed/xTiTnCYgVQuATQz7HO" width="480" height="270" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/cheezburger-video-games-final-fantasy-xTiTnCYgVQuATQz7HO">via GIPHY</a></p>',
					'<iframe src="https://giphy.com/embed/ijDimqcKEpZkY" width="480" height="391" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/video-games-gif-ijDimqcKEpZkY">via GIPHY</a></p>'
				);
				$index = rand(0,4);
				$theGif = $gifs[$index];
			?>
			<div>
				<?= $theGif;?>
			</div>
		</div>
	</div>
</div>
