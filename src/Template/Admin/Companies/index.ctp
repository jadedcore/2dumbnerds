<div class="row">
	<div class="col-xs-12 col-md-8">
		<h1>Company List</h1>
		<a href="/admin/companies/add" class="btn btn-primary btn-large">
			<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Company
		</a>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th>Company Name</th>
			<th>Website</th>
			<th>Publisher</th>
			<th>Developer</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($companies as $company):?>
			<tr>
				<td>
					<?= h($company['name']);?>
				</td>
				<td>
					<a href="<?= h($company['website']);?>" target="_blank">
						<?= h($company['website']);?>
					</a>
				</td>
				<td>
					<?php if ($company['is_publisher']):?>
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					<?php endif;?>
				</td>
				<td>
					<?php if ($company['is_developer']):?>
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					<?php endif;?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
