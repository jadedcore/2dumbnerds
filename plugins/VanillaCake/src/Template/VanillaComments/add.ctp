<div class="row">
	<div class="col-md-offset-2 col-xs-12 col-md-8">
		<h1>
			<span style="color: #9d9d9d;">Commenting on </span>
			<?= $theDiscussion->name;?>
		</h1>
		<?= $this->Form->create($theComment);?>
			<legend><?= __('Enter Your Comment');?></legend>
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
						<a href="/vanilla-cake/vanilla-discussions/view/<?= $theDiscussion->id;?>" class="btn btn-default">
							<span class="glyphicon glyphicon-ban-circle"></span>
							Cancel
						</a>
						<?=
							$this->Form->button(__('<span class="glyphicon glyphicon-saved"></span>&nbsp;Post Comment'),
								['class' => 'btn btn-success']
							);
						?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
<div class="row">
	<div class="col-md-offset-2 col-xs-12 col-md-8">
		<div class="forum-post">
			<div class="row">
				<div class="col-xs-12">
					<h4>Original Discussion</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-1">
					<?php if (!empty($theDiscussion->owner->profile_pic)):?>
						<img src="<?= $theDiscussion->owner->profile_pic;?>" style="width:50px; height:50px" />
					<?php else:?>
						<img src="/img/anon_user.png" style="width:50px; height:50px" />
					<?php endif;?>
				</div>
				<div class="col-xs-11">
					<div class="row">
						<div class="col-xs-8">
							<h5>
								<?= h($theDiscussion->owner->display_name);?>
							</h5>
						</div>
						<div class="col-xs-4">
							<?= $theDiscussion->created;?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<?= $Parsedown->text(h($theDiscussion['body']));?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if (isset($quoteComment)):?>
			<div class="forum-post">
				<div class="row">
					<div class="col-xs-12">
						<h4>Replying to Comment</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-1">
						<?php if (!empty($quoteComment->owner->profile_pic)):?>
							<img src="<?= $quoteComment->owner->profile_pic;?>" style="width:50px; height:50px" />
						<?php else:?>
							<img src="/img/anon_user.png" style="width:50px; height:50px" />
						<?php endif;?>
					</div>
					<div class="col-xs-11">
						<div class="row">
							<div class="col-xs-8">
								<h5>
									<?= h($quoteComment->owner->display_name);?>
								</h5>
							</div>
							<div class="col-xs-4">
								<?= $quoteComment->created;?>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<?= $Parsedown->text(h($quoteComment['body']));?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif;?>
	</div>
</div>
