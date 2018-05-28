<?= $this->element('VanillaCake.forum_banner');?>
<div class="row">
	<div class="col-xs-12">
		<h4>
			<a href="/vanilla-cake/vanilla-categories/index">
				Categories
			</a> >>
			<?= $theCategory['name'];?>
		</h4>
	</div>
</div>
<?php if (empty($theCategory)):?>
	<div class="row">
		<div class="col-xs-12">
			<div class="message error">
				<h1>Category Not Found</h1>
				<p>
					Not sure how you got here, but you are in the wrong place. Just go back the way you
					came and forget you even saw this.
				</p>
			</div>
		</div>
	</div>
<?php else:?>
	<div class="row">
		<div class="col-xs-6">
			<h3>
				<?= $theCategory['name'];?>
			</h3>
		</div>
		<div class="col-xs-6">
			<?php if (!empty($authUser) && ($authUser['role']['priority'] <= $theCategory['create_auth'])):?>
				<div class="pull-right" style="margin-top: 20px;">
					<a href="/vanilla-cake/vanilla-discussions/add/<?= $theCategory['id'];?>" class="btn btn-forum">
						<span class="glyphicon glyphicon-plus"></span>&nbsp;New
						<span class="hidden-xs">Discussion</span>
					</a>
				</div>
			<?php endif;?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<?php if (empty($theCategory['vanilla_discussions'])):?>
				<div class="message">
					No discussion threads were found for this category.
				</div>
			<?php else:?>
				<table class="table">
					<thead>
						<tr>
							<th>
								Threads
							</th>
							<th>
								Latest Comment
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($theCategory['vanilla_discussions'] as $discussion):?>
							<tr>
								<td>
									<a href="/vanilla-cake/vanilla-discussions/view/<?= $discussion['id'];?>">
										<?= h($discussion['name']);?>
									</a>
								</td>
								<td>
									<?php if (!empty($discussion->last_comment_date)):?>
										<?= $this->Forum->timeSincePost($discussion->last_comment_date);?>
										<?php //$discussion->last_comment_date->i18nFormat(null, $timeZone);?>
									<?php else:?>
										<?= $this->Forum->timeSincePost($discussion->created);?>
										<?php // $discussion->created->i18nFormat(null, $timeZone);?>
									<?php endif;?>
									ago by:
									<?php if (isset($users[$discussion->last_comment_by])):?>
										<?= h($users[$discussion->last_comment_by]);?>
									<?php else:?>
										<?= h($users[$discussion->created_by]);?>
									<?php endif;?>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			<?php endif;?>
		</div>
	</div>
<?php endif;?>
