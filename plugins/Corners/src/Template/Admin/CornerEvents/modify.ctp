<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<h1>Modify Event: <?= $theEvent->name;?></h1>
		<?= $this->Form->create($theEvent);?>
			<legend><?= __('Event Information');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('name', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Event Name'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('event_time', [
							'class' => 'form-control',
							'label' => [
								'inline' => true,
								'escape' => false,
								'text' => 'Event Date:&nbsp;&nbsp;'
							]
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('Venue', [
							'type' => 'select',
							'class' => 'form-control',
							'label' => false,
							'empty' => '--- Choose Venue ---'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<a href="/admin/corners/corner-events/index" class="btn btn-default">
							<span class="glyphicon glyphicon-ban-circle"></span>
							Cancel
						</a>
						<?= $this->Form->button(__('Modify Event'), ['class' => 'btn btn-success']);?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
