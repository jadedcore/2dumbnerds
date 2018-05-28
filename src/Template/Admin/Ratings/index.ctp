<table class="table">
	<thead>
		<tr>
			<th>Rating Name</th>
			<th>Abbreviation</th>
			<th>Image File</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($ratings as $rating):?>
			<tr>
				<td>
					<?= h($rating['name']);?>
				</td>
				<td>
					<?= h($rating['abbreviation']);?>
				</td>
				<td>
					<?= h($rating['image']);?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
