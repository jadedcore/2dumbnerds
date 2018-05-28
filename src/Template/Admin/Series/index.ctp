<table class="table">
	<thead>
		<tr>
			<th>Series Name</th>
			<th>Game</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($series as $seri):?>
			<tr>
				<td>
					<?= $seri['name'];?>
				</td>
				<td>
					<?= $seri['game']['name'];?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
