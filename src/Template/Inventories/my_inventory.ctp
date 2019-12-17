<div class="row">
	<?php foreach($inventory as $item):?>
		<div class="col-xs-12 col-sm-3">
			<img src="/img/games/<?= $item->game->box_art;?>" style="width:100%" />
		</div>
	<?php endforeach;?>
</div>

<?php debug($inventory);?>
