<table class="table">
	<thead>
		<tr>
			<th>Publisher Name</th>
			<th>Website</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($publishers as $publisher):?>
			<tr>
				<td>
					<?= $publisher['name'];?>
				</td>
				<td>
					<?= $publisher['website'];?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
