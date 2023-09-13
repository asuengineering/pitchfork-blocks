document.addEventListener('DOMContentLoaded', function () {

	//Get the hero video element.
	var HeroVid = document.getElementById('media-video');

	if (HeroVid) {

		// When play button is clicked
		document.getElementById('playHeroVid').addEventListener('click', function () {
			HeroVid.play();
			this.style.display = 'none';
			document.getElementById('pauseHeroVid').style.display = 'block';
			document.getElementById('pauseHeroVid').focus();
		});

		// When pause button is clicked
		document.getElementById('pauseHeroVid').addEventListener('click', function () {
			HeroVid.pause();
			this.style.display = 'none';
			document.getElementById('playHeroVid').style.display = 'block';
			document.getElementById('playHeroVid').focus();
		});
	}

});

