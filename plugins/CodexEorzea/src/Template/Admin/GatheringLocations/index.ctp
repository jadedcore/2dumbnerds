<table class="table">
	<thead>
		<tr>
			<th>Region</th>
			<th>Gathering Type</th>
			<th>Location</th>
			<th>Level</th>
			<th>Coordinates</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($locations as $location):?>
			<tr>
				<td>
					<?= $location->region->name;?>
				</td>
				<td>
					<?= $location->gathering_type->name;?>
				</td>
				<td>
					<?= $location->location_name;?>
				</td>
				<td>
					<?= $location->level;?>
				</td>
				<td>
					<?php if (!empty($location->x_coord) && !empty($location->y_coord)):?>
						x.<?= $location->x_coord;?> y.<?= $location->y_coord;?>
					<?php endif;?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
