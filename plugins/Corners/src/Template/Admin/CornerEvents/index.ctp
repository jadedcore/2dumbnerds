<div class="row">
	<div class="col-xs-12">
		<h1>
			Event List
			<a href="/admin/corners/corner-events/add" class="btn btn-primary btn-lg pull-right">
				Create New Event
			</a>
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
					<a href="/admin/corners/corner-events/modify/<?= $event->id;?>">
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
