<table class="table">
	<thead>
		<tr>
			<th>Platform Name</th>
			<th>Alias</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($platforms as $platform):?>
			<tr>
				<td>
					<?= $platform['name'];?>
				</td>
				<td>
					<?= $platform['alias'];?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
