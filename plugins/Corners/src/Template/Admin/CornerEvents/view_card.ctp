<div class="row">
	<div class="col-xs-12">
		<h1><?= h($theEvent[0]->name);?></h1>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<?php if (empty($theEvent[0]->corner_matches)):?>
			<div class="jumbotron">
				<h1>No Matches Setup</h1>
				<p>No matches have been created for this event yet.</p>
			</div>
		<?php else:?>
			<div class="jumbotron">
				<table class="table">
					<thead></thead>
					<tbody>
						<?php foreach ($theEvent[0]->corner_matches as $match):?>
							<tr>
								<td><?= $fighters[$match->fighter1_id];?></td>
								<td>- VS -</td>
								<td><?= $fighters[$match->fighter2_id];?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		<?php endif;?>
	</div>
</div>

<?= $this->Form->create(null, ['url' => '/admin/corners/corner-matches/add']);?>
	<div class="row">
		<?= $this->Form->hidden('corner_event_id', ['value' => $theEvent[0]->id]);?>
		<div class="col-xs-12 col-sm-offset-1 col-sm-4">
			<?= $this->Form->control('fighter1_id', [
				'type' => 'select',
				'label' => false,
				'class' => 'form-control',
				'empty' => '--- Select Fighter 1 ---',
				'options' => $fighters
			]);?>
		</div>
		<div class="col-xs-12 col-sm-2" style="text-align:center">
			<h4>- VS -</h4>
		</div>
		<div class="col-xs-12 col-sm-4">
			<?= $this->Form->control('fighter2_id', [
				'type' => 'select',
				'label' => false,
				'class' => 'form-control',
				'empty' => '--- Select Fighter 2 ---',
				'options' => $fighters
			]);?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-offset-1 col-sm-10">
		<?= $this->Form->submit('Add to Card', ['class' => 'btn btn-success pull-right']);?>
		</div>
	</div>
<?= $this->Form->end();?>
