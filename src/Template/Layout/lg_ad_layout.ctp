<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = '2DumbNerds';
?>
<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset();?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $cakeDescription ?>:
		<?= $this->fetch('title');?>
	</title>
	<?= $this->Html->meta('icon');?>
	<?= $this->fetch('meta');?>

	<!-- Latest compiled and minified CSS -->
	<?=
		$this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', [
			'integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u',
			'crossorigin' => 'anonymous'
		]);
	?>

	<!-- Move page defined css here -->
	<?= $this->fetch('css');?>

	<!-- This .css takes precedence -->
	<?= $this->Html->css('corestyle');?>


	<!-- Latest jQuery -->
	<?=
		$this->Html->script('https://code.jquery.com/jquery-3.2.1.min.js', [
			'integrity' => 'sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=',
			'crossorigin' => 'anonymous'
		]);
	?>

	<!-- Latest compiled and minified JavaScript -->
	<?=
		$this->Html->script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', [
			'integrity' => 'sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa',
			'crossorigin' => 'anonymous'
		]);
	?>

	<?= $this->Html->script('googleanalytics.min');?>

	<!-- Move page specific .js here -->
	<?= $this->fetch('script');?>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-target="#main-nav" data-toggle="collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">
					<img src="/img/2dn_logo.png" alt="2 Dumb Nerds" style="width:60px" />
				</a>
			</div>
			<div class="collapse navbar-collapse" id="main-nav">
				<ul class="nav navbar-nav">
					<li>
						<a href="/podcasts">Podcasts</a>
					</li>
					<li>
						<a href="/streams">Streams</a>
					</li>
					<li>
						<a href="/vanilla-cake/vanilla-categories">Forums</a>
					</li>
					<li>
						<a href="/pages/coming_soon">Reviews</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if (isset($authUser['role']['name']) && $authUser['role']['name'] === 'admin'):?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Admin <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="/admin/users">Manage Users</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="/admin/platforms/index">Manage Platforms</a></li>
								<li><a href="/admin/companies/index">Manage Developers/Publishers</a></li>
								<li><a href="/admin/games/index">Manage Games</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="/admin/series/index">Manage Series</a></li>
								<li><a href="/streams/index">Manage Streams</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="/admin/podcasts/add">Post New Podcast</a></li>
							</ul>
						</li>
					<?php endif;?>
					<?php if (!empty($authUser)):?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<?= $authUser['display_name'];?> <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="/users/my_account">My Account</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="/users/logout">Log Out</a></li>
							</ul>
						</li>
					<?php else:?>
						<li><a href="/users/login">Sign In / Register</a></li>
					<?php endif;?>
				</ul>
			</div>
		</div>
	</nav>
	<div id="ad-banner" class="container-fluid hidden-xs">
		<a href="http://wilsonspickles.com" target="_blank">
			<div class="row">
				<div class="col-xs-12">
					<img src="/img/pickle-logo.png" style="height: 300px;" />
				</div>
			</div>
		</a>
	</div>
	<div id="mobile-ad-banner" class="container-fluid visible-xs">
		<a href="http://wilsonspickles.com" target="_blank">
			<div class="row">
				<div class="col-xs-12">
					<img src="/img/wilsons-small.png" style="height: 75px;" />
				</div>
			</div>
		</a>
	</div>
	<div class="container clearfix">
		<div class="row">
			<div class="col-xs-12">
				<?= $this->Flash->render(); ?>
			</div>
		</div>
		<?php if (isset($authUser['role']['name']) && $authUser['role']['name'] === 'unverified'):?>
			<div class="row">
				<div class="col-xs-12">
					<div class="message">
						<p>
							Hello <strong>N00B</strong>, we sent you an e-mail to confirm your account.  Please verify
							so we can stop calling you <strong>N00B</strong>. Plus, you can also do more if you are a
							verified user. Didn't get the e-mail?
							<a href="/users/resendVerification">Send it again...</a>
						</p>
					</div>
				</div>
			</div>
		<?php endif;?>
		<div class="row">
			<div class="col-xs-12">
				<div class="pull-right">
					<h4 style="color:#a9470a">
						<div class="row">
							<div class="col-xs-12">
								Socially Inept:&nbsp;
								<a href="https://twitter.com/2DumbNerds" target="_blank" style="text-decoration:none;">
									<img src="/img/twitter.png" style="width:25px;" />
								</a>
								<a href="https://www.twitch.tv/2dumbnerds" target="_blank" style="text-decoration:none;">
									<img src="/img/twitch.png" style="width:25px;" />
								</a>
								<a href="https://discord.gg/nWwxhxf" target="_blank" style="text-decoration:none;">
									<img src="/img/discord.png" style="width:25px;" />
								</a>
								<a href="https://www.instagram.com/2dumbnerds/" target="_blank" style="text-decoration:none;">
									<img src="/img/instagram.png" style="width:25px;" />
								</a>
							</div>
						</div>
					</h4>
				</div>
			</div>
		</div>
		<?= $this->fetch('content'); ?>
	</div>
	<footer style="min-height: 50px;">
		<?= $this->fetch('scriptFooter');?>
	</footer>
</body>
</html>
