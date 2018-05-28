<h1>New Rating</h1>
<?= $this->Form->create($theRating);?>
	<?= $this->Form->control('name');?>
	<?= $this->Form->control('abbreviation');?>
	<?= $this->Form->control('image');?>
	<?= $this->Form->button(__('Create Rating'));?>
<?= $this->Form->end();?>
