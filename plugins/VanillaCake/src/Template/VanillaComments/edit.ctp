<div class="row">
	<div class="col-md-offset-2 col-xs-12 col-md-8">
		<h1>
			<span style="color: #9d9d9d;">Editing Comment</span>
		</h1>
		<?= $this->Form->create($theComment);?>
			<?= $this->Form->input('id', ['type' => 'hidden']);?>
			<legend><?= __('Edit Your Comment');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->textarea('body', [
							'label' => 'Comment',
							'placeholder' => 'Enter your comment',
							'class' => 'form-control'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<a href="/vanilla-cake/vanilla-discussions/view/<?= $theComment->vanilla_discussion_id;?>" class="btn btn-default">
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
