<h1>Create a New Series</h1>
<?= $this->Form->create();?>
	<?= $this->Form->control('name');?>
	<?= $this->Form->control('game_id', [
		'empty' => '-- Choose a Game --'
	]);?>
	<?= $this->Form->button(__('Create Series'));?>
<?= $this->Form->end();?>
