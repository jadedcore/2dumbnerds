<table width="100%" cellspacing="0" cellpadding="0" border="0" >
	<tbody>
		<tr>
			<td align="center" bgcolor="#000000">
				<table width="640" cellspacing="0" cellpadding="10" border="0">
					<tbody>
						<tr>
							<td bgcolor="#000000" width="100">
								<img src="https://2dumbnerds.com/img/dummies.png" style="width:100%" />
							</td>
							<td bgcolor="#000000" width="540">
								<h1>
									<span style="color:#9d9d9d;">2 Dumb</span>
									<span style="color:#d95b0d">Nerds</span>
								</h1>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="640" cellspacing="0" cellpadding="0" border="0">
					<tbody>
						<tr>
							<td bgcolor="#000000" width="640" align="left">
								<span style="color:#9d9d9d">
									Hello <?= h($messageData['first_name']);?>,
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="640" cellspacing="0" cellpadding="0" border="0">
					<tbody>
						<tr>
							<td bgcolor="#000000" width="640" align="left">
								<p style="color:#9d9d9d; text-indent:30px;">
									Someone is trying to reset your account on
									<a href="https://2dumbnerds.com" style="color:#d95b0d">
										2dumbnerds.com
									</a>.&nbsp;
									If this is you, click on the following link to reset your password. -->
									<?php $link = $messageData['id'] . '/' . $messageData['reset_token'];?>
									<a href="https://2dumbnerds.com/users/recover-password/<?= $link; ?>" style="color:#d95b0d">
										LINK
									</a>.
								</p>
								<p style="color:#9d9d9d; text-indent:30px;">
									If you did not reset your password then go ahead and delete this e-mail and take
									the blue pill. You will wake up nice and cozy in your bed with no memory of this...
								</p>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="640" cellspacing="0" cellpadding="0" border="0">
					<tbody>
						<tr>
							<td bgcolor="#000000" width="640" align="left">
								<p style="color:#9d9d9d">
									See you online,<br />
									2 Dumb <span style="color:#d95b0d">Nerds</span>
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
