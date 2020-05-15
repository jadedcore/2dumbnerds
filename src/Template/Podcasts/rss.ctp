<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title>2 Dumb Nerds</title>
		<link>https://2dumbnerds.com</link>
		<language>en-us</language>
		<copyright>&#xA9; <?= date('Y');?> 2 Dumb Nerds</copyright>
		<itunes:subtitle>Video Games and Nerd Talk</itunes:subtitle>
		<itunes:author>2 Dumb Nerds</itunes:author>
		<itunes:summary>
			A podcast full of terrible jokes, self-deprecation and video games. Also poorly produced... so... listen
			at your own risk.
		</itunes:summary>
		<atom:link href="https://2dumbnerds.com/podcasts/rss" rel="self" type="application/rss+xml" />
		<itunes:explicit>yes</itunes:explicit>
		<description>
			A podcast full of terrible jokes, self-deprecation and video games. Also poorly produced... so... listen
			at your own risk.
		</description>
		<itunes:owner>
			<itunes:name>2 Dumb Nerds</itunes:name>
			<itunes:email>sup@2dumbnerds.com</itunes:email>
		</itunes:owner>
		<itunes:image href="http://2dumbnerds.com/img/2dn_chalk_1400.jpg" />
		<itunes:category text="Games &amp; Hobbies">
			<itunes:category text="Video Games"/>
		</itunes:category>
		<?php foreach ($podcasts as $cast):?>
			<item>
				<title><?= h($cast['title']) . ': ' . h($cast['subtitle']);?></title>
				<itunes:author>2 Dumb Nerds</itunes:author>
				<itunes:subtitle><?= h($cast['subtitle']);?></itunes:subtitle>
				<itunes:summary>
					<?php if (!empty($cast['summary'])):?>
						<?= h($cast['summary']);?>
					<?php endif;?>
				</itunes:summary>
				<enclosure url="http://<?= $cast['url'];?>" length="<?= $cast['length'];?>" type="<?= $cast['type'];?>" />
				<guid>https://<?= $cast['url'];?></guid>
				<pubDate><?= $cast['created']->i18nFormat('EEE, dd MMM yyyy HH:mm:ss zzz');?></pubDate>
				<itunes:duration><?= $cast['duration'];?></itunes:duration>
				<itunes:keywords>
					<?php if (!empty($cast->keywords_decoded)):?>
						<?php foreach ($cast->keywords_decoded as $keyword):?>
							<?= $keyword;?>,
						<?php endforeach;?>
					<?php endif;?>
				</itunes:keywords>
			</item>
		<?php endforeach;?>
	</channel>
</rss>
