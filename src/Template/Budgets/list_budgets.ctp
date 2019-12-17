<div class="row">
	<div class="col-xs-12">
		<table class="table">
			<thead>
				<tr>
					<th>Budget Name</th>
					<th>Budget Amount</th>
					<th>Current Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($budgets as $id => $budget):?>
					<tr>
						<td>
							<?= h($budget->name);?>
						</td>
						<td>
							<?= number_format($budget->monthly_budget, 2, '.', ',');?>
						</td>
						<td>
							<?= number_format($budget->current_amount, 2, '.', ',');?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
</div>


<?php debug($budgets->toArray());?>
