jQuery(document).ready(function ($) {

    //Get the hero video ID.
    var HeroVid = document.getElementById('media-video');

    if (HeroVid) {

        //When play button is clicked
        document.getElementById('playHeroVid').addEventListener('click', function () {
            HeroVid.play();
            $(this).hide();
            $('#pauseHeroVid').show().focus();

        });

        //When pause button is clicked
        document.getElementById('pauseHeroVid').addEventListener('click', function () {
            HeroVid.pause();
            $(this).hide();
            $('#playHeroVid').show().focus();
        });
    }
});