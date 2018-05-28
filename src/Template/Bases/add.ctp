<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<h1>New Base</h1>
		<?= $this->Form->create($theBase);?>
			<legend><?= __('Enter Your Base Information');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('name', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Base Name'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->button(__('Create Base'), ['class' => 'btn btn-success']);?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
