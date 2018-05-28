<script>
	$(document).ready(function(){
		$('#file').change(function (){
			$('#progressBar').show();
			upload(this.files[0]);
		});
	});

	function upload(file){
		var uploadForm = new FormData();
		uploadForm.append('file', file);
		uploadForm.append('_csrfToken', '<?= $this->request->params['_csrfToken'];?>');

		$.ajax({
			url: '/admin/podcasts/upload/',
			type: 'POST',
			data: uploadForm,
			xhr: function() {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function(evt) {
					if (evt.lengthComputable) {
						var percentComplete = Math.round((evt.loaded / evt.total)*100);
						$('.progress-bar').css('width', percentComplete + '%');
						$('.progress-bar').html(percentComplete + '%');
					}
				}, false);

				return xhr;
			},
			contentType: false,
			processData: false,
			beforeSend: function(request) {
				request.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken');?>');
			},
			success: function(data) {
				$('#uploadError').hide();
				$('#formDetails').show();
				$('#fileName').val(data.new_file);
				$('#fileLength').val(data.file.size);
				$('#fileType').val(data.file.type);
				console.debug(data);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				$('#uploadError').show();
			}
		});
	}
</script>

<div id="uploadError" style="display: none;">
	<div class="message error">
		There was a problem uploading your file. Please try again.
	</div>
</div>

<div class="row">
	<div class="col-md-offset-2 col-md-8">
		<h1>New Podcast</h1>
		<?= $this->Form->create();?>
			<legend><?= __('Enter Your Podcast Information');?></legend>
			<div class="row">
				<div class="col-md-4">
					<?php
						$icon = '';
						$class = 'form-group';
						if ($this->Form->isFieldError('Podcasts.file')) {
							$icon = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
							$class .= ' has-feedback has-error';
						}
					?>
					<div class="<?= $class;?>">
						<label class="control-label" for="podcasts-file">Upload File:&nbsp;</label>
						<label class="btn btn-default">
							<span class="glyphicon glyphicon-search"></span>
							Browse
							<?= $this->Form->control('file', [
								'type' => 'file',
								'label' => false,
								'class' => 'hidden'
							]);?>
						</label>
					</div>
				</div>
				<div class="col-md-8">
					<div id="progressBar" style="padding-top:7px; display:none;">
						<div class="progress">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
								aria-valuemax="100" style="min-width: 2em; width: 0%;"
							>
								0%
							</div>
						</div>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
		<?= $this->Form->create($theCast, ['id' => 'podcastForm']);?>
			<?= $this->Form->hidden('file', ['id' => 'fileName']);?>
			<?= $this->Form->hidden('length', ['id' => 'fileLength']);?>
			<?= $this->Form->hidden('type', ['id' => 'fileType']);?>
			<div id="formDetails" style="display:none;">
				<div class="row">
					<div class="col-md-12">
						<?php
							$icon = '';
							$class = 'form-group';
							if ($this->Form->isFieldError('Podcasts.title')) {
								$icon = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
								$class .= ' has-feedback has-error';
							}
						?>
						<div class="<?= $class;?>">
							<label class="control-label" for="podcasts-title">Title</label>
							<?= $this->Form->control('title', [
								'label' => false,
								'placeholder' => 'Title',
								'class' => 'form-control'
							]);?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="podcasts-subtitle">Subtitle</label>
							<?= $this->Form->control('subtitle', [
								'label' => false,
								'placeholder' => 'Subtitle',
								'class' => 'form-control'
							]);?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="podcasts-summary">Summary</label>
							<?= $this->Form->textarea('summary', [
								'placeholder' => 'Enter a summary of the podcast here...',
								'label' => false,
								'class' => 'form-control'
							]);?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php
							$icon = '';
							$class = 'form-group';
							if ($this->Form->isFieldError('Podcasts.duration')) {
								$icon = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
								$class .= ' has-feedback has-error';
							}
						?>
						<div class="<?= $class;?>">
							<label class="control-label" for="podcasts-duration">Duration</label>
							<?= $this->Form->control('duration', [
								'label' => false,
								'placeholder' => 'hh:mm:ss',
								'class' => 'form-control'
							]);?>
							<?= $icon;?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="podcasts-keywords">Keywords (Comma Separated List)</label>
							<?= $this->Form->control('keywords', [
								'label' => false,
								'placeholder' => 'Keywords (Comma Separated)',
								'class' => 'form-control'
							]);?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="podcasts-live-date">
								When do you want this podcast to drop? (UTC)
							</label>
							<?= $this->Form->control('live_date', [
								'label' => false,
								'class' => 'form-control'
							]);?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<a href="/" class="btn btn-default">
								<span class="glyphicon glyphicon-ban-circle"></span>
								Cancel
							</a>
							<?=
								$this->Form->button(__('<span class="glyphicon glyphicon-saved"></span>&nbsp;Post Podcast'),
									['class' => 'btn btn-success']
								);
							?>
						</div>
					</div>
				</div>
			</div>
		<?= $this->Form->end();?>
	</div>
</div>
