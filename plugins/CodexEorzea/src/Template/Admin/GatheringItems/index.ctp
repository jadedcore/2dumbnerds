<table class="table">
	<thead>
		<tr>
			<th>Item</th>
			<th>Gathered</th>
			<th>Sold</th>
			<th>Dropped</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($items as $item):?>
			<tr>
				<td>
					<?= $item->name;?>
				</td>
				<td>
					<?php if ($item->is_gathered):?>
						<span class="glyphicon glyphicon-ok"></span>
					<?php endif;?>
				</td>
				<td>
					<?php if ($item->is_sold):?>
					<?php endif;?>
				</td>
				<td>
					<?php if ($item->is_dropped):?>
					<?php endif;?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
