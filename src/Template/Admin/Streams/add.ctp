<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<h1>New Stream</h1>
		<?= $this->Form->create();?>
			<legend><?= __('Enter Your Stream Information');?></legend>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<?= $this->Form->control('game_id', [
							'empty' => '-- Choose a Game --',
							'label' => false,
							'class' => 'form-control'
						]);?>
					</div>
				</div>
				<div class="col-md-4">
					<a href="/admin/games/add" class="btn btn-success">
						<span class="glyphicon glyphicon-plus"></span>
						New Game
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<?= $this->Form->control('series_id', [
							'empty' => '-- Choose a Series --',
							'label' => false,
							'class' => 'form-control'
						]);?>
					</div>
				</div>
				<div class="col-md-4">
					<a href="/admin/series/add" class="btn btn-success">
						<span class="glyphicon glyphicon-plus"></span>
						New Series
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->textarea('description', [
							'placeholder' => 'Enter your stream description here...',
							'label' => false,
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('stream_link', [
							'placeholder' => 'Link code.  Only the end part after the https://youtu.be/',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('streamer_id', [
							'empty' => '-- Who Streamed This --',
							'label' => false,
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<a href="/streams/index" class="btn btn-default">
							<span class="glyphicon glyphicon-ban-circle"></span>
							Cancel
						</a>
						<?=
							$this->Form->button(__('<span class="glyphicon glyphicon-saved"></span>&nbsp;Post Stream'),
								['class' => 'btn btn-success']
							);
						?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
