
var embed = new Twitch.Embed("twitch-embed", {
	width: "100%",
	height: 500,
	layout: "video-with-chat",
	theme: "dark",
	channel: "2dumbnerds",
	autoplay: false
});

embed.addEventListener(Twitch.Embed.VIDEO_READY, () => {
	var player = embed.getPlayer();
	player.play();
});
