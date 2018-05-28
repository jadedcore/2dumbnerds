<h1>System Roles</h1>
<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Description</th>
		<th>Priority</th>
	</tr>
	<?php foreach($roles as $role):?>
		<tr>
			<td><?= $role->id;?></td>
			<td><?= h($role->name);?></td>
			<td><?= h($role->description);?></td>
			<td><?= $role->priority;?></td>
		</tr>
	<?php endforeach;?>
</table>
