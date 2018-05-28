<?= $this->Html->script('hsimp.jquery.min');?>
<?= $this->Html->css('hsimp.jquery');?>
<script type="text/javascript">
	$(document).ready(function() {
		$('#register-password').hsimp({
			calculationsPerSecond: 10e9,
			good: 31557600e3,
			ok: 31557600
		});
		$('.hsimp-results').css('z-index', '1000');
		$('#register-password').keyup(function(){
			checkPassword();
		});
		$('#register-retype').keyup(function(){
			checkPassword();
		});
	});

	function checkPassword(){
		var password1 = $('#register-password').val();
		var password2 = $('#register-retype').val();
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
	<div class="col-md-6">
		<h1>Login</h1>
		<?= $this->Form->create();?>
			<legend><?= __('Enter your username and password');?></legend>
			<div class="form-group">
				<label class="control-label" for="username">Username</label>
				<?=
					$this->Form->control('username', [
						'label' => false,
						'class' => 'form-control',
						'placeholder' => 'Enter Username'
					]);
				?>
			</div>
			<div class="form-group">
				<label class="control-label" for="password">Password</label>
				<?=
					$this->Form->control('password', [
						'label' => false,
						'class' => 'form-control',
						'placeholder' => 'Enter Password'
					]);
				?>
			</div>
			<div class="form-group">
				<?=
					$this->Form->control('stay_logged', [
						'type' => 'checkbox',
						'label' => 'Stay Logged In'
					]);
				?>
			</div>
			<?=
				$this->Form->button('<span class="glyphicon glyphicon-user"></span>&nbsp;Login', [
					'type' => 'submit',
					'class' => 'btn btn-primary btn-block'
				]);
			?>
			<div style="text-align:center; padding-top: 5px;">
				<a href="/users/recover-password">Recover Password</a>
			</div>
		<?= $this->Form->end();?>
	</div>
	<div class="col-md-6">
		<h1>Register</h1>
		<?= $this->Form->create('Users', ['name' => 'Register', 'url' => '/users/register']);?>
			<legend><?= __('...or register for a new account.');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label" for="register-username">Username</label>
						<?=
							$this->Form->control('Register.username', [
								'label' => false,
								'class' => 'form-control',
								'placeholder' => 'Create a Username',
								'required' => true
							]);
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label" for="register-email">E-mail</label>
						<?=
							$this->Form->control('Register.email', [
								'label' => false,
								'class' => 'form-control',
								'placeholder' => 'E-mail',
								'required' => true
							]);
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group passwordCheck">
						<label class="control-label" for="register-password">Password</label>
						<?=
							$this->Form->control('Register.password', [
								'label' => false,
								'class' => 'form-control',
								'type' => 'password',
								'placeholder' => 'Password',
								'required' => true
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
						<label class="control-label" for="register-retype">Re-type Password</label>
						<?=
							$this->Form->control('Register.retype', [
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
