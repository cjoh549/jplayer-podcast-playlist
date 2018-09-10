<?php
$rss_feed = file_get_contents("http://www.podcastone.com/podcast?categoryID2=1008");

$rss_xml = new SimpleXMLElement($rss_feed);
?>

<head>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js">
  </script>
  <script type="text/javascript" src="/jPlayer/dist/jplayer/jquery.jplayer.min.js">
  </script>
  
<link href="/jPlayer/dist/skin/pink.flag/css/jplayer.pink.flag.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/jPlayer/dist/add-on/jplayer.playlist.min.js"></script>
  
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

	var myPlaylist = new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_N",
		width: "90%",
		aspectratio: "16:9",
		cssSelectorAncestor: "#jp_container_N"
	}, [
		<?php
		foreach ($rss_xml->channel->item as $podcast) {
		?>
			{
				title:"<?php echo addslashes($podcast->title) ?>",
				mp3:"<?php echo $podcast->link ?>",
				poster: "<?php echo $rss_xml->channel->image->url ?>"
			},
		<?php	
		}
		?>

	], {
		playlistOptions: {
			enableRemoveControls: true
		},
		swfPath: "../dist/jplayer",
		supplied: "webmv, ogv, m4v, oga, mp3",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		audioFullScreen: false
	});
});
//]]>
</script>

<style>
.jp-playlist { height:475px; overflow-y: auto !important; overflow-x: hidden !important; }

@media screen and (max-width: 500px) {

    /* jplayer */
    .jp-video video, .jp-audio, .jp-controls-holder {
        width: 100% !important;
    }

   .jp-video, .jp-video > div, .jp-video img {
       height: auto !important;
       width: 100% !important;
   }

   .jp-video-360p {
       max-width: 570px !important;
   }

   .jp-video-270p {
       max-width: 480px !important;
   }

   .jp-progress {
       width: 130px;
   }
}
</style>

</head>

<body>

<div id="jp_container_N" class="jp-video jp-video-270p" role="application" aria-label="media player">
	<div class="jp-type-playlist">
		<div id="jquery_jplayer_N" class="jp-jplayer"></div>
		<div class="jp-gui">
			<div class="jp-video-play">
				<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
			</div>
			<div class="jp-interface">
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
				<div class="jp-details">
					<div class="jp-title" aria-label="title">&nbsp;</div>
				</div>
				<div class="jp-controls-holder">
					<div class="jp-volume-controls">
						<button class="jp-mute" role="button" tabindex="0">mute</button>
						<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
					</div>
					<div class="jp-controls">
						<button class="jp-previous" role="button" tabindex="0">previous</button>
						<button class="jp-play" role="button" tabindex="0">play</button>
						<button class="jp-stop" role="button" tabindex="0">stop</button>
						<button class="jp-next" role="button" tabindex="0">next</button>
					</div>
					<div class="jp-toggles">
						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
						<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
						<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
					</div>
				</div>
			</div>
		</div>
		<div class="jp-playlist">
			<ul>
				<!-- The method Playlist.displayPlaylist() uses this unordered list -->
				<li></li>
			</ul>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>


</body>