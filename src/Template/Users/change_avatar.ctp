<?php
	/**
	 * Croppie Image Cropping JavaScript Library served via CDN
	 * @link https://github.com/foliotek/croppie
	 */
?>
<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.1/croppie.min.css', ['block' => true]);?>
<?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.1/croppie.min.js', ['block' => true]);?>
<script>
	$(document).ready(function(){
		// Prep the croppie area
		var avatarImage = $('#imagePreview').croppie({
			viewport: {
				width: 100,
				height: 100,
				type: 'square'
			},
			boundary: {
				width: 200,
				height: 200
			}
		});

		// Set the image to the preview for cropping
		$('#file').change(function (){
			previewImage(this, avatarImage);
		});

		// Actually upload the image
		$('#uploadSubmit').click(function(event){
			event.preventDefault();
			avatarImage.croppie('result', 'blob').then(function(blob){
				upload(blob);
			});
		});
	});

	function previewImage(formData, avatarImage) {
		$('#imageCropped').hide();
		$('#progressBar').hide();

		$('.progress-bar').css('width', '0%');
		$('.progress-bar').html('0%');

		$('#imagePreview').show();
		$('#uploadButtons').show();

		// This created a file reader for the file that is going to be uploaded and places it in the croppie element
		if (formData.files && formData.files[0]) {
			var reader = new FileReader();
			reader.onload = function(){
				var dataURL = reader.result;
				avatarImage.croppie('bind', {
					url: dataURL
				});
			};
			reader.readAsDataURL(formData.files[0]);
		}
	}

	function upload(file){
		$('#progressBar').show();
		var uploadForm = new FormData();
		uploadForm.append('file', file);
		uploadForm.append('_csrfToken', '<?= $this->request->params['_csrfToken'];?>');

		$.ajax({
			url: '/users/upload/',
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
				$('#uploadMessage').html(data.message);

				if (data.status == 'Fail') {
					this.error();
				}

				$('#uploadMessage').removeClass('error');
				$('#uploadMessage').addClass('success');
				$('#uploadMessage').show();

				$('#uploadButtons').hide();
				$('#imagePreview').hide();

				$('#fileName').val(data.new_file);
				$('#imageCropped').html('<img src="/img/profile/' + data.new_file + '?' + Math.random() + '" />');
				$('#imageCropped').show();
				console.debug(data);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				$('#uploadMessage').removeClass('success');
				$('#uploadMessage').addClass('error');
				$('#uploadMessage').show();
			}
		});
	}
</script>

<div id="uploadMessage"  class="message" style="display: none;">
	There was a problem uploading your file. Please try again.
</div>

<div class="row">
	<div class="col-xs-12 col-md-offset-2 col-md-8">
		<h1>Change Your Avatar</h1>
		<legend><?= __('Avatar');?></legend>
		<div class="row">
			<div class="col-xs-12 col-md-6">
				<div class="row">
					<div class="col-xs-12">
						<?= $this->Form->create();?>
							<div id="fileBrowser">
								<?php
									$icon = '';
									$class = 'form-group';
									if ($this->Form->isFieldError('Users.file')) {
										$icon = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
										$class .= ' has-feedback has-error';
									}
								?>
								<div class="<?= $class;?>">
									<label class="control-label" for="users-file">Upload File:&nbsp;</label>
									<label class="btn btn-default">
										<span class="glyphicon glyphicon-search"></span>
										Browse
										<?= $this->Form->control('file', [
											'type' => 'file',
											'label' => false,
											'class' => 'hidden',
											'accept' => 'image/*'
										]);?>
									</label>
								</div>
							</div>
						<?= $this->Form->end();?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<?= $this->Form->create($theUser, ['id' => 'userForm']);?>
							<?= $this->Form->hidden('id');?>
							<?= $this->Form->hidden('file', ['id' => 'fileName']);?>
							<div class="row">
								<div class="col-md-12">
									<div id="uploadButtons" style="display:none;">
										<div class="form-group">
											<a href="/" class="btn btn-default">
												<span class="glyphicon glyphicon-ban-circle"></span>
												Cancel
											</a>
											<?=
												$this->Form->button(
													__('<span class="glyphicon glyphicon-saved"></span>&nbsp;Update Avatar'),
													['class' => 'btn btn-success', 'id' => 'uploadSubmit']
												);
											?>
										</div>
									</div>
								</div>
							</div>
						<?= $this->Form->end();?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div id="progressBar" style="padding-top:7px; display:none;">
							<div class="progress">
								<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
								aria-valuemax="100" style="min-width: 2em; width: 0%;">
									0%
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="row">
					<div class="col-xs-12">
						<div id="imagePreview" style="display:none;"></div>
						<div id="imageCropped" style="display:none;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-offset-2 col-md-8">
		<a href="/users/my-account" class="btn btn-default">
			<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back to Account
		</a>
	</div>
</div>
