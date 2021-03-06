<html lang="en">
	<head>
		<meta charset="utf-8" />
		<style>
			html {
				background-color: #FC0D1E;
				font-family: "Helvetica";
			}
			body {
				color: white;
				font-size: 36px;
			}
			.main {
				text-align: center;
				display: flex;
				align-items: center;
				justify-content: center;
				flex-direction: column;
			}
			a {
				background-color: white;
				color: #FC0D1E;
				border-radius: 3px;
				padding: 0 6px 0 6px;
				white-space: nowrap;
			}
			.fadein {
				opacity: 1;
				animation: fadein 1s ease-in-out 2s both;
			}
			@-moz-keyframes fadein {
				0% {opacity: 0}
				100% {opacity: 1}
			}
			@-webkit-keyframes fadein {
				0% {opacity: 0}
				100% {opacity: 1}
			}
			@keyframes fadein {
				0% {opacity: 0}
				100% {opacity: 1}
			}
			.spinnerHolder {
				width: 96px;
				height: 96px;
				animation: spin 0.8s cubic-bezier(0.75,0.3,0.3,0.75) infinite;
			}
			@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
			@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
			@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
			.spinnerSizing {
				width: 48px;
				height: 48px;
				overflow: hidden;
			}
			.spinner {
				width: 94px;
				height: 94px;
				border-radius: 88px;
				border: 10px solid #fff;
				box-sizing: border-box;
				display: block;
			}
			.small {
				font-size: 8px;
			}
			/* tablet and desktop */
			@media only screen and (min-width: 600px)  {
				p {
					margin: 10;
				}
				.main {
					position: absolute;
					top: 0;
					left: 0;
					width: 100%;
					height: 100vh;
					padding: 0;
					margin: 0;
					border: 0;
				}
			}
		</style>
	</head>
	<body>
		<div class="main" id="main">
			<div id="top">
				<p class="fadein">Your allotted bandwidth for <a href="#">2dumbnerds.com</a> has been exceeded.</p>
				<p class="fadein">Please upgrade your internet plan to continue browsing.</p>
			</div>
			<div class="middle">
				<div class="spinnerHolder">
					<div class="spinnerSizing">
						<div class="spinner"></div>
					</div>
				</div>
			</div>
			<div id="bottom">
				<p>Loading...</p>
				<p class="fadein">The FCC will end Net Neutrality on December 14th if we don't convince congress to stop them.</p>
				<p class="fadein"><a href="https://www.battleforthenet.com/breaktheinternet/" target="_blank">Join the protest</a> and <a href="https://www.battleforthenet.com/" target="_blank">call congress</a> today to SAVE NET NEUTRALITY</p>
			</div>
		</div>
</body>
</html>
