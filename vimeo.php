<?php




function getVimeo_Embed($videoID = " ",$postID = null){
	global $allFeeds;
	
	//require_once(TEMPLATEPATH.'/feeds/vimeooauth/vimeo.php');
	require_once('vimeooauth/vimeo.php');
	
	//ASTODO update api key
	$vimeo = new phpVimeo('', '', '', '');
	
	
	
	$videos = $vimeo->call('vimeo.videos.getInfo', array('video_id' => $videoID, 'format' => 'php'));
	

/*
echo "<pre>";
print_r($videos);
echo "</pre>";
*/


	
 	$cellIntro = "<div class='pinboardItem videoService fitVid'>";
	$cellOutro = "</div>";
	

		$data = $videos->video[0];

		
		$cleanDate = date('d M,Y', strtotime($data->uploaded));
	
	
	//$videoID
	
	
		$internal = "<iframe src='http://player.vimeo.com/video/".$data->id."?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ff0179' width='500' height='281' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		
			<div class='internalPadding'>
				<div class='pinboardVideoTitle'>
					<h3>".$data->title."</h3>
				</div>
				<div class='pinboardVideoDescription'>
					<p>".$data->description."</p>
				</div>
				<div class='pinboardVideoStats'>
				
					<p class='username'>By <a href='".$data->owner->profileurl."' target='_blank'>".$data->owner->display_name."</a></p>
					<p class='subscribe'><a href='".$data->owner->profileurl."' target='_blank'>Subscribe</a></p>
				
					<p class='views'>Views: ".$data->number_of_plays."</p>
					<p class='uploadDate'>Uploaded on ".$cleanDate."</p>
	
				</div>
			</div>
			<div class='userForm'>
			". 
			//gravity_form(1, true, true, false, null, false, 300)
			
			

			do_shortcode('[gravityform id=1 name=ContactUs title=false description=false field_values="kwmc_user=david@daviddarke.co.uk" ajax="true" tabindex="300"]')
			."
			</div>
			<a href='#' class='submitPencil'></a>";
		
		array_push($allFeeds, $cellIntro.$internal.$cellOutro);
		
		
	
	




}


//getVimeo_Tag("hats","Search");






function getVimeo_Tag($tag = " ",$videoNumber = 5,$postID = null){
	global $allFeeds;
	
	//require_once(TEMPLATEPATH.'/feeds/vimeooauth/vimeo.php');
	require_once('vimeooauth/vimeo.php');
	
	//ASTODO update api key
	$vimeo = new phpVimeo('', '', '', '');
	
	
	
	$videos = $vimeo->call('vimeo.videos.getByTag', array('tag' => $tag, 'format' => 'php', 'per_page' => $videoNumber, 'full_response' => 1));
	



	
 	$cellIntro = "<div class='pinboardItem videoService fitVid'>";
	$cellOutro = "</div>";
	


	
	foreach($videos->videos->video as $data){
		//echo("ss");
/*
		echo("<pre>");
		
		//print_r($data);
		
		print_r($vimeoVideo->title);
			//$videoInfo = $vimeo->call('vimeo.videos.getInfo', array('video_id' => $vimeoVideo->id, 'format' => 'php'));
		print_r($vimeoVideo->id);
		//print_r($vimeoVideo->description);
		print_r($vimeoVideo->owner->display_name);
		print_r($data->owner->profileurl);
		print_r($vimeoVideo->number_of_plays);
		print_r($vimeoVideo->upload_date);



		//echo($vimeoVideo->id);
		
		echo("</pre>");
		
*/
		//<iframe src="http://player.vimeo.com/video/63098055?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=c9ff23" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		
		
		$cleanDate = date('d M,Y', strtotime($data->uploaded));
	
	
	
	
	
		$internal = "<iframe src='http://player.vimeo.com/video/".$data->id."?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ff0179' width='500' height='281' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		
			<div class='internalPadding'>
				<div class='pinboardVideoTitle'>
					<h3>".$data->title."</h3>
				</div>
				<div class='pinboardVideoDescription'>
					<p>".$data->description."</p>
				</div>
				<div class='pinboardVideoStats'>
				
					<p class='username'>By <a href='".$data->owner->profileurl."' target='_blank'>".$data->owner->display_name."</a></p>
					<p class='subscribe'><a href='".$data->owner->profileurl."' target='_blank'>Subscribe</a></p>
				
					<p class='views'>Views: ".$data->number_of_plays."</p>
					<p class='uploadDate'>Uploaded on ".$cleanDate."</p>
	
				</div>
			</div>
			<div class='userForm'>
			". 
			//gravity_form(1, true, true, false, null, false, 300)
			
			

			do_shortcode('[gravityform id=1 name=ContactUs title=false description=false field_values="kwmc_user=david@daviddarke.co.uk" ajax="true" tabindex="300"]')
			."
			</div>
			<a href='#' class='submitPencil'></a>";
		
		array_push($allFeeds, $cellIntro.$internal.$cellOutro);
		
		
	}
	




}


//getVimeo_Tag("hats","Search");


