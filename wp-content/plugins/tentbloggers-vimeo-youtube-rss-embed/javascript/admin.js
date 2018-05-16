jQuery(function($) {
	$('#tentblogger-vimeo-youtube-button').click(function(evt) {	
		evt.preventDefault();
		send_to_editor(
			parse_video_token(
				prompt('Enter the URL of your video (Vimeo and YouTube only!):')
			) // end parse_video_token
		); // send_to_editor
	});
});

/**
 * Determines from which service the video came from and then retrieves
 * the video ID from the URL.
 * 
 * @sInput	The URL from which to extract the video's ID.
 */
function parse_video_token(sInput) {

	var sShortCode = null;
	
	if(sInput.indexOf('youtube') > -1) {
		
		var aQueryString = sInput.split('?');
		var sQueryString = aQueryString[1];
		var sYouTubeId = sQueryString.split('v')[1].split('&')[0].split('=')[1];
		
		sShortCode = '[tentblogger-youtube ' + sYouTubeId + ']';
		
	} else if(sInput.indexOf('youtu') > -1) {
		
		var aQueryString = sInput.split('/');
		var sYouTubeId = aQueryString[aQueryString.length - 1];
		
		sShortCode = '[tentblogger-youtube ' + sYouTubeId + ']';
		
	} else if(sInput.indexOf('vimeo') > -1) {
		
		// If they're grabbing videos from channels...
		if(sInput.indexOf('#') > -1) {
			sVimeoId = sInput.split('#')[1];
			
		// Otherwise, use the standard URL...
		} else {
			var aParameters = sInput.split('/');
			sVimeoId = aParameters[aParameters.length - 1];
		} // end if/else
		
		sShortCode = '[tentblogger-vimeo ' + sVimeoId + ']';
		
	} else {
		sShortCode = "[You didn't enter a valid video URL. Please try again.]";
	} // end if/else

	return sShortCode;
	
} // end parse_video_token