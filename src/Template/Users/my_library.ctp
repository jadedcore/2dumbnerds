<div class="row">
	<?php foreach($theUser->games as $game):?>
		<div class="col-xs-12 col-sm-3">
			<?php if (!empty($game['box_art'])):?>
				<img class="game-thumb-small" src="/img/games/<?= h($game['box_art']);?>" />
			<?php endif;?>
			<?php if ($game->_joinData->is_owned):?>
				<span class="glyphicon glyphicon-check"></span>
			<?php endif;?>
		</div>
	<?php endforeach;?>
</div>

<?php debug($theUser->games);?>
