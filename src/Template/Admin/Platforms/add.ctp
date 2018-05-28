<h1>New Platform</h1>
<?= $this->Form->create($thePlatform);?>
	<?= $this->Form->control('name');?>
	<?= $this->Form->control('alias');?>
	<?= $this->Form->button(__('Create Platform'));?>
<?= $this->Form->end();?>
