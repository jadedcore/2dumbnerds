<h1>New Publisher</h1>
<?= $this->Form->create($thePublisher);?>
	<?= $this->Form->control('name');?>
	<?= $this->Form->control('website');?>
	<?= $this->Form->button(__('Create Publisher'));?>
<?= $this->Form->end();?>
