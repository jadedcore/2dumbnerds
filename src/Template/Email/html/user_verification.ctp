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
									Hello <?= h($messageData['display_name']);?>,
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
									You recently created an account on
									<a href="https://2dumbnerds.com" style="color:#d95b0d">
										2dumbnerds.com
									</a>&nbsp;
									Please verify your e-mail address by clicking on this link -->
									<?php $link = $messageData['id'] . '/' . $messageData['verification'];?>
									<a href="https://2dumbnerds.com/users/verify/<?= $link; ?>" style="color:#d95b0d">
										LINK
									</a>
									so we can de-N00B-ify your account.
								</p>
								<p style="color:#9d9d9d; text-indent:30px;">
									If you did not create an account on our site, then someone is impersonating
									you... so please let us know by responding to this e-mail so we can remove
									the account.
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
