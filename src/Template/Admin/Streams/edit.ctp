<h1>Edit a New Stream</h1>
<?= $this->Form->create($theStream);?>
	<?= $this->Form->control('game_id', [
		'empty' => '-- Choose a Game --'
	]);?>
	<?= $this->Form->control('series_id', [
		'empty' => '-- Choose a Series --'
	]);?>
	<div>
		<a href="/admin/series/add">+ Create New Series</a>
	</div>
	<?= $this->Form->textarea('description', [
		'placeholder' => 'Stream Description',
		'style' => 'width: 500px'
	]);?>
	<?= $this->Form->control('stream_link', [
		'placeholder' => 'Link to YouTube Video',
		'display' => 'YouTube Embed Code'
	]);?>
	<?= $this->Form->control('streamer_id', [
		'empty' => '-- Who Streamed This --'
	]);?>
	<?= $this->Form->button(__('Post Stream'));?>
<?= $this->Form->end();?>
