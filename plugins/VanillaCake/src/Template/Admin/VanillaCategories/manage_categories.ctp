<script type="text/javascript">
	$(document).ready(function () {
		$('.delete-link').click(function() {
			var clickedID = this.getAttribute('data-target');
			var data = doAjax('/admin/vanilla-cake/vanilla-categories/delete', clickedID);
			console.debug(data);
			console.debug(data.responseJSON);
			if (!data) {
				var theDiv = "<div class='message error'>Oops... Something went wrong.</div>";
			} else if (data.status == 'success') {
				var theDiv = "<div class='message success'>" + data.message + "</div>";
				$('#row-' + id).html('');
			} else {
				var theDiv = "<div class='message error'>" + data.message + "</div>";
			}
			$('#ajaxAlert').html(theDiv);
			$('#ajaxAlert').show();
			return false;
		});
		$('.archive-link').click(function() {
			console.debug(this);
			if (doAjax('/admin/vanilla-cake/vanilla-categories/archive', this.getAttribute('data-target'))) {

			} else {

			}
		});
	});

	function doAjax(action, id) {
		return $.ajax({
			url: action,
			type: 'POST',
			data: {
				'category_id': id,
				'_csrfToken': '<?= $this->request->params['_csrfToken'];?>'
			},
			success: function(data) {
				console.debug(data);
				return data;
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				console.log('We have a problem fellas.');
				console.debug(errorThrown);
				return false;
			}
		});
	}
</script>

<?php
	/* $depth represents the current depth of the tree. Before printing anything to the screen
	 * check the current records left field against the end value of the depth array. This will determine
	 * if you are already down a branch and need to return up one branch. Then use the number of elements
	 * in the depth array to determine how deep you are for the next record. Print the record and then determine
	 * if you need to go deeper down the branch or stay on the same level for the next record.
	 */
?>
<div class="row">
	<div class="col-xs-12" id="ajaxAlert" class="hidden">
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<a href="/admin/vanilla-cake/vanilla-categories/add" class="btn btn-success pull-right">
			<span class="glyphicon glyphicon-plus"></span>&nbsp;New Category
		</a>
	</div>
</div>
<?php $depth = [];?>
<?php foreach($categories as $category):?>
	<?php
		if ($category->lft > end($depth)) {
			array_pop($depth);
		}
		$indent = '';
		foreach($depth as $value) {
			$indent .= '--';
		}

		$color = '#9d9d9d';
		if ($category->is_archived) {
			$color = '#d95b0d';
		}

		$bgColor = '#000';
		if (!$category->allow_discussion) {
			$bgColor = '#222';
		}
	?>
	<div class="row" id="row-<?= $category->id;?>">
		<div class="col-xs-12" style="background-color: <?= $bgColor;?>;">
			<div class="row">
				<div class="col-xs-6">
					<h4 style="color:<?= $color;?>">
						<?= $indent . ' ' . $category->name;?>
						<?php if ($category->is_archived):?>
							(ARCHIVED)
						<?php endif;?>
					</h4>
				</div>
				<div class="col-xs-6">
					<?php if ($category->id !== 1):?>
						<h4>
							<a href="/admin/vanilla-cake/vanilla-categories/edit/<?= $category->id;?>">
								Edit
							</a> /
							<?php if ($category->is_archived):?>
								<a href="">Un-Archive</a> /
							<?php else:?>
								<a href="#">Archive</a> /
							<?php endif;?>
							<a href="#" class="delete-link" data-target="<?= $category->id;?>">Delete</a>
						</h4>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<?php
		if (($category->lft + 1) !== $category->rght) {
			$depth[] = $category->rght;
		}
	?>
<?php endforeach;?>
