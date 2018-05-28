<?= $this->Html->script('hsimp.jquery.min');?>
<?= $this->Html->css('hsimp.jquery');?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#users-password').hsimp({
			calculationsPerSecond: 10e9,
			good: 31557600e3,
			ok: 31557600
		});
		$('.hsimp-results').css('z-index', '1000');
		if ($('#users-password').val()) {
			checkPassword();
		}

		$('#users-password').keyup(function(){
			checkPassword();
		});
		$('#users-retype').keyup(function(){
			checkPassword();
		});
	});

	function checkPassword(){
		var password1 = $('#users-password').val();
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
	<div class="col-md-offset-2 col-md-8">
		<h1>Register</h1>
		<?= $this->Form->create($theUser);?>
			<legend><?= __('New Account Registration');?></legend>
			<div class="row">
				<div class="col-md-12">
					<?php
						$icon = '';
						$class = 'form-group';
						if ($this->Form->isFieldError('Users.username')) {
							$icon = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
							$class .= ' has-feedback has-error';
						}
					?>
					<div class="<?= $class;?>">
						<label class="control-label" for="users-username">Username</label>
						<?=
							$this->Form->control('Users.username', [
								'label' => false,
								'class' => 'form-control',
								'placeholder' => 'Create a Username',
								'required' => true
							]);
						?>
						<?= $icon;?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php
						$icon = '';
						$class = 'form-group';
						if ($this->Form->isFieldError('Users.email')) {
							$icon = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
							$class .= ' has-feedback has-error';
						}
					?>
					<div class="<?= $class;?>">
						<label class="control-label" for="users-email">E-mail</label>
						<?=
							$this->Form->control('Users.email', [
								'label' => false,
								'class' => 'form-control',
								'placeholder' => 'E-mail',
								'required' => true
							]);
						?>
						<?= $icon;?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group passwordCheck">
						<label class="control-label" for="users-password">Password</label>
						<?=
							$this->Form->control('Users.password', [
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
				$this->Form->button('<span class="glyphicon glyphicon-ok"></span>&nbsp;Register', [
					'type' => 'submit',
					'class' => 'btn btn-default btn-block disabled',
					'id' => 'registerButton',
					'disabled' => true
				]);
			?>
		<?= $this->Form->end();?>
	</div>
</div>
