<script type="text/javascript">
	$(document).ready(function() {
		$('.stats').hide();

		$('#accountToggle').click(function() {
			$('.stats').hide();
			$('.account').show();
		});

		$('#statsToggle').click(function() {
			$('.account').hide();
			$('.stats').show();
		});
	});
</script>

<div class="row">
	<div class="col-xs-12">
		<h1>User List</h1>
	</div>
</div>
<div class="row">
	<div class="col-xs-2">
		<h4>
			<a href="#" id="accountToggle">
				Account Info
			</a>
		</h4>
	</div>
	<div class="col-xs-2">
		<h4>
			<a href="#" id="statsToggle">
				Statistics
			</a>
		</h4>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>Username</th>
			<th class="account">Display Name</th>
			<th class="account">Name</th>
			<th class="account">E-Mail</th>
			<th class="account">Time Zone</th>
			<th class="account">Role</th>
			<th class="account">Created</th>
			<th class="account">Tools</th>
			<th class="stats">Last Login</th>
			<th class="stats">Login Count</th>
			<th class="stats">Thread Count</th>
			<th class="stats">Comment Count</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($users as $user):?>
			<tr>
				<td><?= $user->id;?></td>
				<td><?= h($user->username);?></td>
				<td class="account"><?= h($user->display_name);?></td>
				<td class="account"><?= h($user->first_name . ' ' . $user->last_name);?></td>
				<td class="account"><?= h($user->email);?></td>
				<td class="account"><?= $user->time_zone->name;?></td>
				<td class="account"><?= h($user->role->name);?></td>
				<td class="account">
					<?php if (!empty($user->created)):?>
						<?= $user->created->i18nFormat(null, $timeZone);?>
					<?php endif;?>
				</td>
				<td class="account">
					<?= $this->Form->create('User', ['url' => '/admin/users/delete']);?>
						<?= $this->Form->input('id', ['type' => 'hidden', 'value' => $user->id]);?>
						<?= $this->Form->button('<span class="glyphicon glyphicon-trash"></span>', [
							'type' => 'submit',
							'escape' => false,
							'class' => 'btn btn-danger',
							'onclick' => "return confirm('Are you sure you want to delete " . $user->username . "?')"
						]);?>
					<?= $this->Form->end();?>
				</td>
				<td class="stats">
					<?php if (!empty($user->last_login)):?>
						<?= $user->last_login->i18nFormat(null, $timeZone);?>
					<?php endif;?>
				</td>
				<td class="stats">
					<?= $user->login_count;?>
				</td>
				<td class="stats">
					0
				</td>
				<td class="stats">
					0
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
