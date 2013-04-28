<?php

function getYoutube_Tag($tag = " ",$videoNumber = 5,$postID = null){
	global $allFeeds;

 	$cellIntro = "<div class='pinboardItem videoService fitVid'>";
	$cellOutro = "</div>";
	$url="http://gdata.youtube.com/feeds/api/videos?q='$tag'&format=5&max-results=$videoNumber&v=2&alt=jsonc";
    $json = file_get_contents($url,0,null,null);
    $json_output = json_decode($json);
    
   
    
    foreach ( $json_output->data->items as $data ){


		$cleanDate = date('d M,Y', strtotime($data->uploaded));
	
		$internal = "<iframe width='400' height='200' src='http://www.youtube.com/embed/".$data->id."' frameborder='0' allowfullscreen></iframe>
			<div class='internalPadding'>
				<div class='pinboardVideoTitle'>
					<h3>".$data->title."</h3>
				</div>
				<div class='pinboardVideoDescription'>
					<p>".$data->description."</p>
				</div>
				<div class='pinboardVideoStats'>
				
					<p class='username'>By <a href='http://www.youtube.com/user/".$data->uploader."' target='_blank'>".$data->uploader."</a></p>
					<p class='subscribe'><a href='http://youtube.com/subscription_center?add_user=".$data->uploader."' target='_blank'>Subscribe</a></p>
				
					<p class='views'>Views: ".$data->viewCount."</p>
					<p class='uploadDate'>Uploaded on ".$cleanDate."</p>
	
				</div>
			</div>
			<div class='userForm'>
			". 
			//gravity_form(1, true, true, false, null, false, 300)
			
			

			do_shortcode('[gravityform id=1 name=ContactUs title=true description=true field_values="kwmc_user=david@daviddarke.co.uk" ajax="true" tabindex="300"]')
			."
			</div>
			<a href='#' class='submitPencil'></a>";
		
		
    
		array_push($allFeeds, $cellIntro.$internal.$cellOutro);
    
    
    			//	$user_info = get_user_by('id', 1);

			//echo $user_info->data->user_email;

    
    
    }
	
}

function getYoutube_Embed($videoID = "NoID",$postID = null){
	global $allFeeds;

 	$cellIntro = "<div class='pinboardItem videoService fitVid'>";
	$cellOutro = "</div>";
	
	
	
	$url="http://gdata.youtube.com/feeds/api/videos/$videoID?v=2&alt=jsonc";
    $json = file_get_contents($url,0,null,null);
    $json_output = json_decode($json);
    
     
    
    //$json_output
  /*
  echo "<pre>";
    print_r($json_output);
    echo "</pre>";
    
    
*/
    $data = $json_output->data;

    	$shortText = limit_words($data->description, 14);


		$cleanDate = date('d M,Y', strtotime($data->uploaded));
	
		$internal = "<iframe width='400' height='200' src='http://www.youtube.com/embed/".$data->id."' frameborder='0' allowfullscreen></iframe>
			<div class='internalPadding'>
				<div class='pinboardVideoTitle'>
					<h3>".$data->title."</h3>
				</div>
				<div class='pinboardVideoDescription'>
					<p>".$shortText."</p>
				</div>
				<div class='pinboardVideoStats'>
				
					<p class='username'>By <a href='http://www.youtube.com/user/".$data->uploader."' target='_blank'>".$data->uploader."</a></p>
					<p class='subscribe'><a href='http://youtube.com/subscription_center?add_user=".$data->uploader."' target='_blank'>Subscribe</a></p>
				
					<p class='views'>Views: ".$data->viewCount."</p>
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
    
    
    			//	$user_info = get_user_by('id', 1);

			//echo $user_info->data->user_email;

    
    

	
}
