<?= $this->Form->create($theLocation);?>
	<?= $this->Form->controls(['region_id', 'gathering_type_id', 'location_name', 'x_coord', 'y_coord', 'level']);?>
	<?= $this->Form->submit('Create');?>
<?= $this->Form->end();?>
