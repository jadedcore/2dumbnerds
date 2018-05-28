<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<h1>New Discussion Thread</h1>
		<?= $this->Form->create($theDiscussion);?>
			<legend><?= __('Discussion Info');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('name', [
							'label' => 'Subject',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->textarea('body', [
							'label' => false,
							'placeholder' => 'Post text.',
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
							$this->Form->button(__('<span class="glyphicon glyphicon-saved"></span>&nbsp;Post Thread'),
								['class' => 'btn btn-success']
							);
						?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
