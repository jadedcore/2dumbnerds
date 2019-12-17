<div class="row">
	<div class="col-xs-12 col-md-8">
		<h1><?= $theUser['display_name'];?></h1>
		<legend><?= __('Edit Your Profile');?></legend>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-8">
		<div class="row">
			<div class="col-xs-12">
				<?php if (!empty($theUser->profile_pic)):?>
					<img src="<?= $theUser->profile_pic;?>" style="width: 50px; height: 50px;" />
				<?php else:?>
					<img src="/img/anon_user.png" style="width: 50px; height: 50px;" />
				<?php endif;?>
			</div>
		</div>
		<?= $this->Form->create($theUser);?>
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('username', [
							'class' => 'form-control',
							'placeholder' => 'User Name'
						]);?>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('display_name', [
							'class' => 'form-control',
							'placeholder' => 'Display Name'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('first_name',[
							'class' => 'form-control',
							'placeholder' => 'Optional'
						]);?>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<?= $this->Form->control('last_name', [
						'class' => 'form-control',
						'placeholder' => 'Optional'
					]);?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('email', [
							'class' => 'form-control',
							'placeholder' => 'E-Mail'
						]);?>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('time_zone_id', [
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="pull-right">
						<a href="/" class="btn btn-default">
							<span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Cancel
						</a>
						<?= $this->Form->button('<span class="glyphicon glyphicon-saved"></span>&nbsp;Save Changes',
							[
								'type' => 'submit',
								'escape' => false,
								'class' => 'btn btn-success'
							]
						);?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
	<div class="col-md-4">
		<?php
			$emailClass = 'message success';
			$emailIcon = 'glyphicon glyphicon-ok';
			$emailLink = '<strong>E-mail:</strong> Verified';
			$roleClass = 'message success';
			if ($theUser->role->name === 'unverified') {
				if (!empty($theUser['verification'])) {
					$emailClass = 'message';
					$emailIcon = 'glyphicon glyphicon-warning-sign';
					$emailLink = '<a href="/users/resendVerification">Send another e-mail</a>';
				} else {
					$emailClass = 'message error';
					$emailIcon = 'glyphicon glyphicon-remove';
					$emailLink = '<a href="/users/resendVerification">Try again?</a>';
				}
				$roleClass = 'message';
			}
		?>
		<div class="row">
			<div class="col-md-12">
				<h4>Account Status</h4>
				<div class="<?=$emailClass;?>">
					<?= $emailLink;?>&nbsp;<span class="<?= $emailIcon;?>"></span>
				</div>
				<div class="<?=$roleClass;?>">
					<strong>Role: </strong><?= $theUser->role->name;?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Additional Actions</h4>
				<?php if ($theUser->role->priority < 100):?>
					<div class="message success"><a href="/users/change-avatar">Update Avatar</a></div>
				<?php endif;?>
				<?php if ($theUser->role->priority < 50):?>
					<?php if (empty($theUser->owned_base)):?>
						<div class="message success"><a href="/bases/add">Create a Base</a></div>
					<?php else:?>
						<div class="message success">
							<a href="/bases/edit/<?= $theUser->owned_base->id;?>">
								Modify Your Base
							</a>
						</div>
					<?php endif;?>
				<?php endif;?>
				<div class="message"><a href="/users/change-password">Change Password</a></div>
			</div>
		</div>
	</div>
</div>
