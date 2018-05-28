<h1>User List</h1>
<table>
	<tr>
		<th>ID</th>
		<th>Username</th>
		<th>Name</th>
		<th>E-Mail</th>
		<th>Role</th>
	</tr>
	<?php foreach($users as $user):?>
		<tr>
			<td><?= $user->id;?></td>
			<td><?= h($user->username);?></td>
			<td><?= h($user->first_name . ' ' . $user->last_name);?></td>
			<td><?= h($user->email);?></td>
			<td><?= h($user->role->name);?></td>
		</tr>
	<?php endforeach;?>
</table>
