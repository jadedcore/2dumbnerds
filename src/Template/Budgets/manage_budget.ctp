<?= $this->Html->script('hydra-tree-nav');?>
<?= $this->Html->css('hydra-tree-nav');?>
<script>
	$(document).ready(function() {
		<?php if (isset($budgetID)):?>
			let Tree = new HydraTree({
				treeData: <?= $this->EscapeJS->phpToJs($theTree);?>,
				leaves: <?= $this->EscapeJS->phpToJs($budgetAccounts);?>,
				leafIndex: 'budget_account_id'
			});
			Tree.drawTree();

			$(Tree).on('currentData:new', function(event) {
				var leafData = Tree.currentLeafData;
				var nodeData = Tree.currentNodeData;

				$('#editBudgetItem #name').val(leafData.name);
				$('#editBudgetItem #monthly-budget').val(leafData.monthly_budget);
				$('#editBudgetItem #current-amount').val(leafData.current_amount);

				$('#editNode #parent-id').val(nodeData.parent_id);
				$('#editNode #lft').val(nodeData.lft);
				$('#editNode #rght').val(nodeData.rght);

				$('#formControls').show();
			});

			$('#showAll').click(function() {
				Tree.expandAll();
			});

			$('#hideAll').click(function() {
				Tree.collapseAll();
			});

			$('#showAccount').click(function() {
				$('#nodeForm').hide();
				$('#leafForm').show();
				$('#showAccount').addClass('disabled');
				$('#showNode').removeClass('disabled');
			});

			$('#showNode').click(function() {
				$('#leafForm').hide();
				$('#nodeForm').show();
				$('#showNode').addClass('disabled');
				$('#showAccount').removeClass('disabled');
			});

			<?php if ($budgetAccountID):?>
				Tree.jumpToLeaf(<?= $budgetAccountID;?>);
			<?php endif;?>
		<?php endif;?>

		// Tree Selected
		$('#budgetSelect').on('change', function() {
			window.location = '/budgets/manage-budget/'+ $(this).val();
		});

		// Update Search
		$('#budgetItemSearch').on('input propertychange paste', function() {
			Tree.searchLeaves($(this).val());
		});

		$('#budgetItemSubmit').click(function(event) {
			event.preventDefault();
			newBudgetItem();
		})
	});

	function newBudgetItem() {
		$.ajax({
			url: '/budget/new-budget-item',
			type: 'POST',
			data: {
				'name': $('#name').val(),
				'monthly_budget': $('#monthly-budget').val(),
				'current_amount': $('#current-amount').val(),
				'_csrfToken': '<?= $this->request->getParam('_csrfToken')?>'
			},
			success: function(data) {
				if (data == 'Success') {
					console.debug('Success');
				} else {
					this.error();
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.debug(errorThrown);
			}
		});
	}
</script>


<!-- Page Header -->
<!--
<div id="pageHeader" class="page-header header-no-line">
	<div class="well">
		<h2 class="text-center">
			<a href="/pages/admin_page/" class="btn btn-warning pull-left">
				<span class="glyphicon glyphicon-chevron-left"></span> Admin Tools
			</a>
			Manage Budgets
		</h2>
	</div>
</div>
-->

<!-- Select Budget -->
<div class="row">
	<div class="col-xs-12">
		<div class="row">
			<div class="col-xs-2">
				<h4 style="margin-bottom:0px;">Select A Budget: </h4>
			</div>
			<div class="col-xs-4">
				<h4>
					<div class="form-group">
						<?= $this->Form->control('budget_id', [
							'label' => false, 'type' => 'select', 'options' => $budgetList, 'value' => $budgetID,
							'id' => 'budgetSelect', 'empty' => '--- Select a Budget ---', 'class' => 'form-control'
						]);?>
					</div>
				</h4>
			</div>
			<div class="col-xs-4">
				<h4>
					<a href="/trees/new-budget-tree" class="btn btn-success">New Budget</a>
				</h4>
			</div>
		</div>
	</div>
</div>
<hr />

<div class="row">
	<div class="col-xs-6">
		<?php if (!empty($budgetID)):?>
			<div>
				<h5>Search</h5>
				<?= $this->Form->control('search', [
					'id' => 'budgetItemSearch', 'type' => 'text', 'label' => false, 'placeholder' => 'Budget Name'
				]);?>
				<div id="hydraTreeSearch"></div>
			</div>
			<div>
				<a href="#" id="showAll">Show All</a> / <a href="#" id="hideAll">Hide All</a>
			</div>

			<div id="hydraTreeContainer" style="margin-bottom: 50px;"></div>
		<?php else:?>
			<div class="alert text-center">
				Select a Tree to Continue
			</div>
		<?php endif;?>
	</div>
	<div class="col-xs-6">
		<div id="formControls" style="display:none">
			<div class="row">
				<div class="col-xs-12">
					<a href="#" id="showAccount" class="btn btn-info disabled">Account Info</a>
					<a href="#" id="showNode" class="btn btn-info">Tree Node Info</a>
				</div>
			</div>
			<div id="leafForm">
				<?= $this->Form->create('budgetItem', ['id' => 'editBudgetItem', 'url' => false]);?>
					<div class="form-group">
						<?= $this->Form->control('name', ['class' => 'form-control']);?>
					</div>
					<div class="form-group">
						<?= $this->Form->control('monthly_budget', ['class' => 'form-control']);?>
					</div>
					<div class="form-group">
						<?= $this->Form->control('current_amount', ['label' => 'Starting Amount', 'class' => 'form-control']);?>
					</div>
					<?= $this->Form->submit('Edit Budget Item', ['id' => 'budgetItemSubmit', 'class' => 'btn btn-success']);?>
				<?= $this->Form->end();?>
			</div>
			<div id="nodeForm" style="display:none">
				<?= $this->Form->create('nodeItem', ['id' => 'editNode', 'url' => false]);?>
					<div class="form-group">
						<?= $this->Form->control('parent_id', ['type' => 'int', 'class' => 'form-control']);?>
					</div>
					<div class="form-group">
						<?= $this->Form->control('lft', ['type' => 'int', 'class' => 'form-control']);?>
					</div>
					<div class="form-group">
						<?= $this->Form->control('rght', ['type' => 'int', 'class' => 'form-control']);?>
					</div>
					<?= $this->Form->submit('Edit Node', ['id' => 'nodeSubmit', 'class' => 'btn btn-success']);?>
				<?= $this->Form->end();?>
			</div>
		</div>
	</div>
</div>
