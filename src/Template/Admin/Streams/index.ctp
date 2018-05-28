<?php debug($series);?>

<table class="table">
	<thead>
		<tr>
			<th>Box Art</th>
			<th>Game Name</th>
			<th>Publisher</th>
			<th>Developer</th>
			<th>Release Date</th>
			<th>ESRB Rating</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($games as $game):?>
			<tr>
				<td>
					<?php if (!empty($game['box_art'])):?>
						<img class="game-thumb-small" src="/img/games/<?= h($game['box_art']);?>" />
					<?php endif;?>
				</td>
				<td>
					<?= $game['name'];?>
				</td>
				<td>
					<?= $game['publisher']['name'];?>
				</td>
				<td>
					<?= $game['developer']['name'];?>
				</td>
				<td>
					<?= $game['release_date'];?>
				</td>
				<td>
					<?php if (!empty($game['rating']['image'])):?>
						<img src="/img/<?= $game['rating']['image'];?>" />
					<?php endif;?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
