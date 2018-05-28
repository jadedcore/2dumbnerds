<h1>Add New System Role</h1>
<?php
	echo $this->Form->create($theRole);
		echo $this->Form->control('name');
		echo $this->Form->control('description', ['rows' => '3']);
		echo $this->Form->control('priority');
		echo $this->Form->button(__('Save Role'));
	echo $this->Form->end();
?>
