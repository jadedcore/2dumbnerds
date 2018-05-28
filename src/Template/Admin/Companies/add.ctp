<h1>New Company</h1>
<?= $this->Form->create($theCompany);?>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<?= $this->Form->control('name', [
					'class' => 'form-control',
					'placeholder' => 'Company Name'
				]);?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<?= $this->Form->control('website', [
					'class' => 'form-control',
					'placeholder' => 'Company Website'
				]);?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<?= $this->Form->control('is_publisher');?>
			<?= $this->Form->control('is_developer');?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<?= $this->Form->control('country_id', [
					'class' => 'form-control',
					'empty' => '-- Choose a Country --'
				]);?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<?= $this->Form->control('parent_id', [
					'class' => 'form-control',
					'empty' => '-- Choose Parent Company --',
					'options' => $companies
				]);?>
			</div>
		</div>
	</div>
	<a href="/admin/companies/index" class="btn btn-default">
		<span class="glyphicon glyphicon-ban-circle"></span>
		Cancel
	</a>
	<?= $this->Form->button(__('Create Company'), ['class' => 'btn btn-success']);?>
<?= $this->Form->end();?>
