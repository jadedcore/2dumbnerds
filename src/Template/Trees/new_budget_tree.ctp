<h1>New Budget</h1>
<?= $this->Form->create($budgetTree);?>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<?= $this->Form->control('name', [
					'class' => 'form-control',
					'placeholder' => 'Budget Name'
				]);?>
			</div>
		</div>
	</div>

	<a href="/budgets/manage-budgets" class="btn btn-default">
		<span class="glyphicon glyphicon-ban-circle"></span>
		&nbsp;Cancel
	</a>
	<?= $this->Form->button(__('Create Budget'), ['class' => 'btn btn-success']);?>
<?= $this->Form->end();?>
