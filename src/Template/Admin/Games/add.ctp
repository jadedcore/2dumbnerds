<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<h1>New Game</h1>
		<?= $this->Form->create($theGame);?>
			<legend><?= __('Enter Game Information');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('name', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Game Name'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('Platforms', [
							'class' => 'form-control',
							'label' => false,
							'empty' => '-- Choose a Platform --'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('release_date', [
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('rating_id', [
							'class' => 'form-control',
							'label' => false,
							'empty' => '-- Choose a Rating --'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('box_art', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Box Art Image (File Name)'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<?= $this->Form->control('publisher_id', [
							'class' => 'form-control',
							'label' => false,
							'empty' => '-- Choose a Publisher --'
						]);?>
					</div>
				</div>
				<div class="col-md-4">
					<a href="/admin/companies/add" class="btn btn-success">
						<span class="glyphicon glyphicon-plus"></span>
						New Developer or Publisher
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('developer_id', [
							'class' => 'form-control',
							'label' => false,
							'empty' => '-- Choose a Developer --'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<a href="/admin/games/index" class="btn btn-default">
							<span class="glyphicon glyphicon-ban-circle"></span>
							Cancel
						</a>
						<?= $this->Form->button(__('Create Game'), ['class' => 'btn btn-success']);?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
