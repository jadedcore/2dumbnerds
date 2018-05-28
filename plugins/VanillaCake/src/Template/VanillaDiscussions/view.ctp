<script type="text/javascript">
	$(document).ready(function(){
		$('.removeButton').click(function(){
			var clickID = $(this).attr('data-value');
			console.debug(clickID);
			removeComment(clickID);
			return false;
		});
	});

	function removeComment(clickID) {
		var comment = '#comment' + clickID;
		$.ajax({
			url: '/vanilla-cake/vanilla-comments/delete/',
			type: 'POST',
			data: {
				'commentID' : clickID,
				'_csrfToken': '<?= $this->request->params['_csrfToken']?>'
			},
			success: function(data) {
				$(comment).hide(1500);
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				$(comment).css('background-color', '#a94442');
			}
		});
	}
</script>

<div class="row">
	<div class="col-xs-12">
		<h4>
			<a href="/vanilla-cake/vanilla-categories/index">
				Categories
			</a> >>
			<a href="/vanilla-cake/vanilla-categories/view/<?= $theDiscussion['vanilla_category']['id'];?>">
				<?= h($theDiscussion['vanilla_category']['name']);?>
			</a> >>
			<?= $theDiscussion['name'];?>
		</h4>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="forum-discussion">
			<div class="row">
				<div class="col-xs-4 col-sm-1">
					<?php if (!empty($theDiscussion->owner->profile_pic)):?>
						<img src="<?= $theDiscussion->owner->profile_pic;?>" style="height: 50px; width: 50px;" />
					<?php else:?>
						<img src="/img/anon_user.png" style="height: 50px; width: 50px;" />
					<?php endif;?>
				</div>
				<div class="col-xs-8 col-sm-11">
					<div class="row">
						<div class="col-xs-12">
							<h4 style="margin-top:0px; margin-bottom:0px;">
								<?= h($theDiscussion->owner->display_name);?>
							</h4>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<?= $theDiscussion->created->i18nFormat(null, $timeZone);?>
						</div>
					</div>
					<div class="row">
						<div class="hidden-xs col-sm-12">
							<h4><?= h($theDiscussion['name']);?></h4>
							<?= $Parsedown->text(h($theDiscussion['body']));?>
						</div>
					</div>
				</div>
			</div>
			<div class="visible-xs">
				<div class="row">
					<div class="col-xs-12">
						<h4><?= h($theDiscussion['name']);?></h4>
						<?= $Parsedown->text(h($theDiscussion['body']));?>
					</div>
				</div>
			</div>
			<?php if (isset($authUser) && ($authUser['role']['priority'] <= 50)):?>
				<div class="row">
					<div class="col-xs-12">
						<div class="pull-right">
							<?php if (isset($authUser)):?>
								<?php if (($authUser['id'] == $theDiscussion['created_by']) ||
								($authUser['role']['name'] == 'admin')):?>
									<div class="btn-group dropup">
										<button type="button" class="btn btn-forum dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="glyphicon glyphicon-cog"></span>
										</button>
										<ul class="dropdown-menu forum-menu">
											<li>
												<a href="/vanilla-cake/vanilla-discussions/edit/<?= $theDiscussion->id;?>">
													<span class="glyphicon glyphicon-pencil"></span>
													&nbsp;Edit
												</a>
											</li>
										</ul>
									</div>
								<?php endif;?>
							<?php endif;?>
							<a href="/vanilla-cake/vanilla-comments/add/<?= $theDiscussion->id;?>" class="btn btn-forum">
								Reply&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
							</a>
						</div>
					</div>
				</div>
			<?php endif;?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<h4>Comments</h4>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<?php foreach ($theDiscussion['vanilla_comments'] as $comment):?>
			<?php if ($comment->deleted === null):?>
				<div class="row" id="comment<?= $comment['id'];?>">
					<div class="col-xs-12">
						<div class="forum-post">
							<div class="row">
								<!-- Avatar Gutter -->
								<div class="col-xs-4 col-sm-1">
									<?php if (!empty($comment->owner->profile_pic)):?>
										<img src="<?= $comment->owner->profile_pic;?>" style="width:50px; height:50px" />
									<?php else:?>
										<img src="/img/anon_user.png" style="width:50px; height:50px" />
									<?php endif;?>
								</div>
								<!-- Post Width -->
								<div class="col-xs-8 col-sm-11">
									<!-- Name -->
									<div class="row">
										<div class="col-xs-12">
											<h4 style="margin-top:0px; margin-bottom:0px;">
												<?= h($comment->owner->display_name);?>
											</h4>
										</div>
									</div>
									<!-- Time Stamp -->
									<div class="row">
										<div class="col-xs-12">
											<?= $comment->created->i18nFormat(null, $timeZone);?>
										</div>
									</div>
									<!-- Post Body -->
									<div class="row">
										<div class="hidden-xs col-sm-12">
											<div class="forum-comment-body">
												<?= $Parsedown->text(h($comment['body']));?>
											</div>
										</div>
									</div>
									<!-- Post Controls -->
									<div class="row">
										<div class="hidden-xs col-sm-12">
											<div class="pull-right">
												<?php if (isset($authUser)):?>
													<?php if (($authUser['id'] == $comment['created_by']) ||
													($authUser['role']['name'] == 'admin')):?>
														<div class="btn-group dropup">
															<button type="button" class="btn btn-forum dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<span class="glyphicon glyphicon-cog"></span>
															</button>
															<ul class="dropdown-menu forum-menu">
																<li>
																	<a href="/vanilla-cake/vanilla-comments/edit/<?= $comment->id;?>">
																		<span class="glyphicon glyphicon-pencil"></span>
																		&nbsp;Edit
																	</a>
																</li>
																<li>
																	<a href="#" class="removeButton" data-value="<?= $comment->id;?>">
																		<span class="glyphicon glyphicon-trash"></span>
																		&nbsp;Delete
																	</a>
																</li>
															</ul>
														</div>
													<?php endif;?>
													<?php if ($authUser['role']['priority'] <= 50):?>
														<a href="/vanilla-cake/vanilla-comments/add/<?= $theDiscussion->id;?>/<?= $comment->id;?>" class="btn btn-forum">
															Reply&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
														</a>
													<?php endif;?>
												<?php endif;?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="visible-xs">
								<div class="row">
									<div class="col-xs-12">
										<div class="forum-comment-body">
											<?= $Parsedown->text(h($comment['body']));?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="pull-right">
											<?php if (isset($authUser)):?>
												<?php if (($authUser['id'] == $comment['created_by']) ||
												($authUser['role']['name'] == 'admin')):?>
													<div class="btn-group dropup">
														<button type="button" class="btn btn-forum dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<span class="glyphicon glyphicon-cog"></span>
														</button>
														<ul class="dropdown-menu forum-menu">
															<li>
																<a href="/vanilla-cake/vanilla-comments/edit/<?= $comment->id;?>">
																	<span class="glyphicon glyphicon-pencil"></span>
																	&nbsp;Edit
																</a>
															</li>
															<li>
																<a href="#" class="removeButton" data-value="<?= $comment->id;?>">
																	<span class="glyphicon glyphicon-trash"></span>
																	&nbsp;Delete
																</a>
															</li>
														</ul>
													</div>
												<?php endif;?>
												<?php if ($authUser['role']['priority'] <= 50):?>
													<a href="/vanilla-cake/vanilla-comments/add/<?= $theDiscussion->id;?>/<?= $comment->id;?>" class="btn btn-forum">
														Reply&nbsp;<span class="glyphicon glyphicon-share-alt"></span>
													</a>
												<?php endif;?>
											<?php endif;?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif;?>
		<?php endforeach;?>
	</div>
</div>
