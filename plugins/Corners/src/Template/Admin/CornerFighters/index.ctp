<div class="row">
	<div class="col-xs-12">
		<h1>Fighter List</h1>
	</div>
</div>

<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>First Name</th>
			<th class="account">Last Name</th>
			<th class="account">Nickname</th>
			<th class="account">Country</th>
			<th class="account">Height</th>
			<th class="account">Weight</th>
			<th class="account">Reach</th>
			<th class="account">Leg Reach</th>
			<th class="stats">Age</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($fighters as $fighter):?>
			<tr>
				<td>
					<a href="/admin/corners/corner-fighters/modify/<?= $fighter->id;?>">
						<?= $fighter->id;?>
					</a>
				</td>
				<td><?= h($fighter->first_name);?></td>
				<td class="account"><?= h($fighter->last_name);?></td>
				<td class="account"><?= h($fighter->nickname);?></td>
				<td class="account"><?= $fighter->country_id;?></td>
				<td class="account"><?= $fighter->height_inches;?></td>
				<td class="account"><?= $fighter->weight_lbs;?></td>
				<td class="account"><?= $fighter->reach_inches;?></td>
				<td class="account"><?= $fighter->leg_reach_inches;?></td>
				<td class="account"><?= $fighter->age;?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>


<?php debug($fighters);?>
