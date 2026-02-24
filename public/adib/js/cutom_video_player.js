// global variable for the player
var player;

// this function gets called when API is ready to use
function onYouTubePlayerAPIReady() {
  // create the global player from the specific iframe (#video)
  player = new YT.Player('video', {
    events: {
      // call this function when player is ready to use
      'onReady': onPlayerReady
    }
  });
}

function onPlayerReady(event) {
  // bind events
  var playButton = document.getElementById("play-button");
	  player.playVideo();
	  player.unMute();
	  player.setVolume(50); 


  playButton.addEventListener("click", function() {
  player.playVideo();
  });
  
  var pauseButton = document.getElementById("pause-button");
  pauseButton.addEventListener("click", function() {
    player.pauseVideo();
  });
  
}

// Inject YouTube API script
var tag = document.createElement('script');
tag.src = "//www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


	
	function changeContent(newVideoID) {	
		player.loadVideoByUrl(videoURL[newVideoID]); //newVideoId will be 0 or 1 or 2 .....
	}
	
	

		
	function toggleVolume() {
       if (player.isMuted()) {
        player.unMute()
		document.getElementById("muteIcon").src = "assets/icons/sound-on-64.png";
      
	  } else {
        player.mute()
		document.getElementById("muteIcon").src = "assets/icons/sound-off-64.png";  
      }
	}
	



function togglePlay(){
//alert("yes");
player.playVideo();
document.getElementById("PlaystreamLink").style.display = "none";  
}//end toggle function



// ------------------------------------------------------------------------------------------------------->			 Zoom/Camera Controls	
