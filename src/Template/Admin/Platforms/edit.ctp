<h1>Update Platform <small><?= $thePlatform->name;?></small></h1>
<?= $this->Form->create($thePlatform);?>
	<?= $this->Form->hidden('id');?>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<?= $this->Form->control('name', [
					'class' => 'form-control',
					'placeholder' => 'Platform Name'
				]);?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<?= $this->Form->control('alias', [
					'class' => 'form-control',
					'placeholder' => 'Platform Alias'
				]);?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<?= $this->Form->control('company_id', [
					'label' => 'Manufacturer',
					'class' => 'form-control',
					'empty' => '-- Choose a Manufacturer --'
				]);?>
			</div>
		</div>
	</div>
	<a href="/admin/platforms/index" class="btn btn-default"><span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Cancel</a>
	<?= $this->Form->button(__('Update Platform'), ['class' => 'btn btn-success']);?>
<?= $this->Form->end();?>
