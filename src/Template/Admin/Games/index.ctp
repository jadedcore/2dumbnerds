<div class="row">
	<div class="col-xs-12 col-md-8">
		<h1>Manage Games</h1>
		<a href="/admin/games/add" class="btn btn-primary btn-large">
			<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Game
		</a>
	</div>
</div>
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
