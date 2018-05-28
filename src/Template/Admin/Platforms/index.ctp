<div class="row">
	<div class="col-xs-12 col-md-8">
		<h1>Manage Platforms</h1>
		<a href="/admin/platforms/add" class="btn btn-primary btn-large">
			<span class="glyphicon glyphicon-plus"></span>&nbsp;Add Platform
		</a>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th>Platform Name</th>
			<th>Manufacturer</th>
			<th>Alias</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($platforms as $platform):?>
			<tr>
				<td>
					<a href="/admin/platforms/edit/<?= $platform->id;?>">
						<?= $platform->name;?>
					</a>
				</td>
				<td>
					<?php if (isset($platform->company)):?>
						<?= $platform->company->name;?>
					<?php endif;?>
				</td>
				<td>
					<?= $platform->alias;?>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
