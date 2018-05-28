<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<h1>New Category</h1>
		<?= $this->Form->create($theCategory);?>
			<legend><?= __('Enter Category Information');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('parent_id', [
							'empty' => '-- None --',
							'options' => $categories,
							'label' => 'Choose Parent',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('name', [
							'label' => 'Category Name',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->textarea('description', [
							'placeholder' => 'Description of the Category',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('create_auth', [
							'type' => 'select',
							'options' => $roles,
							'label' => 'Who can create new discussions?',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('read_auth', [
							'type' => 'select',
							'options' => $roles,
							'label' => 'Who can see this category?',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('update_auth', [
							'type' => 'select',
							'options' => $roles,
							'label' => 'Who can update this category?',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<?= $this->Form->control('delete_auth', [
							'type' => 'select',
							'options' => $roles,
							'label' => 'Who can delete this category?',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('is_public', [
							'label' => 'Is Public',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('allow_discussion', [
							'label' => 'Allow Discussions',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<a href="/vanilla-cake/vanilla-categories" class="btn btn-default">
							<span class="glyphicon glyphicon-ban-circle"></span>
							Cancel
						</a>
						<?=
							$this->Form->button(__('<span class="glyphicon glyphicon-saved"></span>&nbsp;Add Category'),
								['class' => 'btn btn-success']
							);
						?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
