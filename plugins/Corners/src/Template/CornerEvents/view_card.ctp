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
				<div style="min-height:70px">
					<div id="ajaxMessage" style="display:none; margin:0px;"></div>
				</div>
				<table class="table">
					<thead></thead>
					<tbody>
						<?php foreach ($theEvent[0]->corner_matches as $match):?>
							<?php
								$btn1Class = $btn2Class = "fighter btn btn-default";
								$picked1 = $picked2 = '';
								if (isset($userPicks[$match->id])) {
									if ($userPicks[$match->id]->corner_fighter_id == $match->fighter1->id) {
										$btn1Class = "fighter btn btn-success";
										$picked1 = '<span class="glyphicon glyphicon-ok" style="color:green"></span>';
									}
									if ($userPicks[$match->id]->corner_fighter_id == $match->fighter2->id) {
										$btn2Class = "fighter btn btn-success";
										$picked2 = '<span class="glyphicon glyphicon-ok" style="color:green"></span>';
									}
								}
							?>
							<tr id="match-<?= $match->id;?>">
								<td>
									<?php if ($picksOpen):?>
										<a id="fight-btn-<?= $match->fighter1->id;?>"
										class="<?= $btn1Class;?>" data-match="<?= $match->id;?>"
										data-fighter="<?= $match->fighter1->id;?>"
										data-opponent="<?= $match->fighter2->id;?>">
											<span class="glyphicon glyphicon-ok"></span>
										</a>
									<?php else:?>
										<?= $picked1;?>
									<?php endif;?>
									<?= $match->fighter1->last_name;?>
								</td>
								<td>- VS -</td>
								<td>
									<?php if ($picksOpen):?>
										<a id="fight-btn-<?= $match->fighter2->id;?>"
										class="<?= $btn2Class;?>" data-match="<?= $match->id;?>"
										data-fighter="<?= $match->fighter2->id;?>"
										data-opponent="<?= $match->fighter1->id;?>">
											<span class="glyphicon glyphicon-ok"></span>
										</a>
									<?php else:?>
										<?= $picked2;?>
									<?php endif;?>
									<?= $match->fighter2->last_name;?>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		<?php endif;?>
	</div>
</div>

<script type="text/javascript">
	$('.fighter').click(function() {
		if ($(this).hasClass('btn-success')) {
			return;
		}
		makePick(this);
		return;
	});

	function makePick(clicked) {
		var matchId = $(clicked).attr('data-match');
		var fighterId = $(clicked).attr('data-fighter');
		var opponentId = $(clicked).attr('data-opponent');
		var disableButton = '#fight-btn-' + opponentId;
		$.ajax({
			url: '/corners/corner-picks/add-pick/',
			type: 'POST',
			data: {
				'corner_match_id': matchId,
				'corner_fighter_id': fighterId,
				'corner_event_id': <?= $theEvent[0]->id;?>
			},
			beforeSend: function(request) {
				request.setRequestHeader('X-CSRF-Token', '<?= $this->request->getParam('_csrfToken');?>');
			},
			success: function(data) {
				console.debug(data);

				if (data.save) {
					$(clicked).removeClass('btn-default');
					$(clicked).addClass('btn-success');
					$(disableButton).removeClass('btn-success');
					$(disableButton).addClass('btn-default');
				}
				$('#ajaxMessage').addClass(data.class);
				$('#ajaxMessage').html(data.message);
				$('#ajaxMessage').show();
				window.setTimeout(function(){$('#ajaxMessage').hide();}, 5000);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.debug(textStatus);
				console.debug(errorThrown);
			}
		});
	}
</script>
