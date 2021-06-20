<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<h1>Modify Fighter: <?= $theFighter->first_name . ' ' . $theFighter->last_name;?></h1>
		<?= $this->Form->create($theFighter);?>
			<legend><?= __('Fighter Information');?></legend>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('first_name', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'First Name'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('last_name', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Last Name'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('nickname', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Nickname'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('corner_country_id', [
							'class' => 'form-control',
							'label' => false,
							'empty' => '-- Choose a Country --'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('height_inches', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Height in Inches'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('weight_lbs', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Weight in Pounds'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('reach_inches', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Reach in Inches'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('leg_reach_inches', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Leg Reach in Inches'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('age', [
							'class' => 'form-control',
							'label' => false,
							'placeholder' => 'Age in Years'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<?= $this->Form->control('corner_gender_id', [
							'class' => 'form-control',
							'label' => false,
							'empty' => '-- Gender --'
						]);?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<a href="/admin/corners/corner-fighters/index" class="btn btn-default">
							<span class="glyphicon glyphicon-ban-circle"></span>
							Cancel
						</a>
						<?= $this->Form->button(__('Update Fighter'), ['class' => 'btn btn-success']);?>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
