<?php if (isset($theUser)):?>
	<?= $this->Html->script('hsimp.jquery.min');?>
	<?= $this->Html->css('hsimp.jquery');?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#users-newpassword').hsimp({
				calculationsPerSecond: 10e9,
				good: 31557600e3,
				ok: 31557600
			});
			$('.hsimp-results').css('z-index', '1000');
			if ($('#users-newpassword').val()) {
				checkPassword();
			}

			$('#users-newpassword').keyup(function(){
				checkPassword();
			});
			$('#users-retype').keyup(function(){
				checkPassword();
			});
		});

		function checkPassword(){
			var password1 = $('#users-newpassword').val();
			var password2 = $('#users-retype').val();
			if ((password1 === password2) && (password1 !== '') && (password2 !== '')) {
				if ($('.passwordCheck').hasClass('has-error')) {
					$('.passwordCheck').removeClass('has-error');
					$('.passIcon').removeClass('glyphicon-remove');
				}
				$('.passwordCheck').addClass('has-success has-feedback');
				$('.passIcon').addClass('glyphicon-ok');
				$('#registerButton').removeClass('disabled');
				$('#registerButton').prop('disabled', false);
			} else {
				if ($('.passwordCheck').hasClass('has-error')) {
					// Do Nothing, it is appropriate.
				} else {
					// Add the error classes.
					if ($('.passwordCheck').hasClass('has-success')) {
						$('.passwordCheck').removeClass('has-success');
						$('.passIcon').removeClass('glyphicon-ok');
					}
					$('.passwordCheck').addClass('has-error has-feedback');
					$('.passIcon').addClass('glyphicon-remove');
				}
				$('#registerButton').addClass('disabled');
				$('#registerButton').prop('disabled', true);
			}
		}
	</script>
	<div class="row">
		<div class="col-xs-12 col-md-offset-2 col-md-8">
			<h1>Create a New Password</h1>
			<?= $this->Form->create($theUser, ['url' => '/users/recover-password']);?>
				<?= $this->Form->input('Users.id', ['type' => 'hidden']);?>
				<legend><?= __('Create Password Form');?></legend>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group passwordCheck">
							<label class="control-label" for="users-newpassword">Password</label>
							<?=
								$this->Form->control('Users.newPassword', [
									'label' => false,
									'class' => 'form-control',
									'type' => 'password',
									'placeholder' => 'Password',
									'required' => true,
									'value' => $theUser['retype'],
									'style' => 'color: black'
								]);
							?>
							<span class="passIcon glyphicon form-control-feedback" aria-hidden="true">
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group passwordCheck">
							<label class="control-label" for="users-retype">Re-type Password</label>
							<?=
								$this->Form->control('Users.retype', [
									'label' => false,
									'class' => 'form-control',
									'type' => 'password',
									'placeholder' => 'Re-type Password',
									'required' => true
								]);
							?>
							<span class="passIcon glyphicon form-control-feedback" aria-hidden="true">
							</span>
						</div>
					</div>
				</div>
				<?=
					$this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp;Update', [
						'type' => 'submit',
						'class' => 'btn btn-default btn-block disabled',
						'id' => 'registerButton',
						'disabled' => true
					]);
				?>
			<?= $this->Form->end();?>
		</div>
	</div>
<?php else:?>
	<div class="row">
		<div class="col-xs-12 col-md-offset-4 col-md-4">
			<h1>Recover Password</h1>
			<?= $this->Form->create();?>
				<legend><?= __('Enter your registered e-mail in order to recover your password.');?></legend>
				<div class="form-group">
					<label class="control-label" for="username">E-Mail</label>
					<?=
						$this->Form->control('email', [
							'label' => false,
							'class' => 'form-control',
							'placeholder' => 'Enter your e-mail.'
						]);
					?>
				</div>
				<?=
					$this->Form->button('<span class="glyphicon glyphicon-user"></span>&nbsp;Recover Password', [
						'type' => 'submit',
						'class' => 'btn btn-primary btn-block'
					]);
				?>
			<?= $this->Form->end();?>
		</div>
	</div>
<?php endif;?>
