<h1>Create New User</h1>
<?= $this->Form->create($theUser);?>
	<?= $this->Form->control('username');?>
	<?= $this->Form->control('password');?>
	<?= $this->Form->control('email');?>
	<?= $this->Form->control('first_name');?>
	<?= $this->Form->control('last_name');?>
	<?= $this->Form->control('role_id');?>
	<?= $this->Form->button(__('Create User'));?>
<?= $this->Form->end();?>
