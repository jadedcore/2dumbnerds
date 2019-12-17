<?php foreach ($games as $game):?>
	<div class="row">
		<div class="col-xs-2">
			<img src="/img/games/<?= $game->box_art;?>" style="width: 120px;"/>
		</div>
	</div>
<?php endforeach;?>


<?php debug($games);?>
