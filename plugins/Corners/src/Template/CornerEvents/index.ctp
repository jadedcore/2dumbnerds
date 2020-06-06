<div class="row">
	<div class="col-xs-12">
		<h1>
			Event List
		</h1>
	</div>
</div>

<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th class="account">Date</th>
			<th class="account">Venue</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($events as $event):?>
			<tr>
				<td>
					<a href="/corners/corner-events/view-card/<?= $event->id;?>">
						<?= $event->id;?>
					</a>
				</td>
				<td><?= h($event->name);?></td>
				<td class="account"><?= $event->event_time->i18nFormat(null, $timeZone);?></td>
				<td class="account"><?= $event->corner_venue_id;?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
