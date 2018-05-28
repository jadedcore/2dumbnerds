<script type="text/javascript">
	$(document).ready(function() {
		$('.collapseBtn').click(function(event) {
			var target = $(this).attr('href');
			if ($(this).hasClass('collapsed')) {
				showCollapse(this, target);
			} else {
				hideCollapse(this, target);
			}
			return;
		});
	});

	function hideCollapse(btn, target) {
		$(btn).html('[<span class="glyphicon glyphicon-plus"></span>]');
		$(target).collapse('hide');
		return;
	}

	function showCollapse(btn, target) {
		$(btn).html('[<span class="glyphicon glyphicon-minus"></span>]');
		$(target).collapse('show');
		return;
	}
</script>
<?= $this->element('VanillaCake.forum_banner');?>
<?php if (!empty($authUser['role']['name']) && $authUser['role']['name'] === 'admin'):?>
	<div class="row" style="margin-bottom:5px;">
		<div class="col-md-12">
			<a href="/admin/vanilla-cake/vanilla-categories/manage-categories" class="btn btn-success">
				<span class="glyphicon glyphicon-plus"></span>
				Manage Categories
			</a>
		</div>
	</div>
<?php endif;?>

<?php foreach ($categories as $category):?>
	<div class="row">
		<div class="col-xs-12" style="background-color:#222;">
			<h4>
				<?= h($category['name']);?>
				<small>
					<a href="#category-child-<?= $category['id'];?>" data-toggle="collapse" class="collapseBtn"
						aria-expanded="true" aria-controls="category-child-<?= $category['id'];?>"
					>
						[<span class="glyphicon glyphicon-minus"></span>]
					</a>
				</small>
			</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div id="category-child-<?= $category['id'];?>" class="collapse in">
				<?php foreach ($category['children'] as $child):?>
					<div class="row">
						<div class="col-xs-offset-1 col-xs-11">
							<div class="row">
								<div class="col-xs-12 col-sm-8">
									<h4>
										<a href="/vanilla-cake/vanilla-categories/view/<?= $child['id'];?>">
											<?= h($child['name']);?>
										</a>
									</h4>
									<p>
										<?= h($child['description']);?>
									</p>
								</div>
								<div class="hidden-xs col-sm-2">
									<h4>
										<small>
											<?php if (!empty($child->last_update)):?>
												<?= $this->Forum->timeSincePost($child->last_update);?>
											<?php endif;?>
										</small>
									</h4>
								</div>
								<div class="hidden-xs col-sm-2">
									<h4>
										<small>
											Discussions: <?= $child->vanilla_discussion_count;?>
										</small>
									</h4>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
<?php endforeach;?>
