<div class="row">
	<div class="col-md-offset-2 col-xs-12 col-md-8">
		<h1>
			<span style="color: #9d9d9d;">Editing Discussion</span>
		</h1>
		<?= $this->Form->create($theDiscussion);?>
			<?= $this->Form->input('id', ['type' => 'hidden']);?>
			<legend><?= __('Edit The Discussion');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('name', [
							'label' => 'Title',
							'placeholder' => 'Discussion Title',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->textarea('body', [
							'label' => 'Discussion',
							'placeholder' => 'Discussion stuff here...',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<a href="/vanilla-cake/vanilla-discussions/view/<?= $theDiscussion->id;?>" class="btn btn-default">
							<span class="glyphicon glyphicon-ban-circle"></span>
							Cancel
						</a>
						<?=
							$this->Form->button(__('<span class="glyphicon glyphicon-saved"></span>&nbsp;Edit Comment'),
								['class' => 'btn btn-success']
							);
						?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
