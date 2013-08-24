<?php
/*
Plugin Name: Advanced Custom Fields: Easy video embed
Plugin URI: http://wordpress.org/extend/plugins/advanced-custom-fields-limiter-field/
Description: Video stuff...
Version: 1.0.0
Author: Atomic Smash - David Darke
Author URI: atomicsmash.co.uk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


//http://gdata.youtube.com/feeds/api/videos?q=skateboarding+dog?v=2&alt=json


//You tube smaple output
/*
<script 
	    type="text/javascript" 
    src="http://gdata.youtube.com/feeds/users/GoogleDevelopers/uploads?v=2&alt=json-in-script&format=5&callback=showMyVideos">
</script>


function showMyVideos(data) {
  var feed = data.feed;
  var entries = feed.entry || [];
  var html = ['<ul>'];
  for (var i = 0; i < entries.length; i++) {
    var entry = entries[i];
    var title = entry.title.$t;
    html.push('<li>', title, '</li>');
  }
  html.push('</ul>');
  document.getElementById('videos').innerHTML = html.join('');
} 
*/


/*
- embed using full embed code
- embed using video ID
	-allow user to specify width and height
	
- search youtube
	- search videos
	- search username

Fit vids mention

*/




class acf_field_video_embed{
	/*
	*  Construct
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function __construct()
	{
		// set text domain
		/*
		$domain = 'acf-limiter';
		$mofile = trailingslashit(dirname(__File__)) . 'lang/' . $domain . '-' . get_locale() . '.mo';
		load_textdomain( $domain, $mofile );
		*/
		
		
		// version 4+
		add_action('acf/register_fields', array($this, 'register_fields'));	

		//add_action( 'init', array( $this, 'init' ));

	}
	
	
	function init()
	{
		if(function_exists('register_field'))
		{ 
			//echo("s");
			register_field('acf_field_limiter', dirname(__File__) . '/video-embed-v3.php');
		}
	}
	
	/*
	*  register_fields
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function register_fields()
	{
		include_once('video-embed-v4.php');
	}
	
}

new acf_field_video_embed();
		
?>
