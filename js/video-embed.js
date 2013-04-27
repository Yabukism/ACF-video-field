(function($){

/*
jQuery(document).ready(function($){


    $( "#tabs" ).tabs();

});
*/

	/*
	*  acf/setup_fields
	*
	*  This event is triggered when ACF adds any new elements to the DOM. 
	*
	*  @type	function
	*  @since	1.0.0
	*  @date	01/01/12
	*
	*  @param	event		e: an event object. This can be ignored
	*  @param	Element		postbox: An element which contains the new HTML
	*
	*  @return	N/A
	*/
	
	//GetContent(document.getElementById(&quot;id_field&quot;).value,&quot;id&quot;);"
	//GetContent(document.getElementById(&quot;search_field&quot;).value,&quot;search&quot;);
	$(document).live('acf/setup_fields', function(e, postbox){

		$(".youtubesearch").click(function(){
			
			
			
		GetContent($(this).prev('.search_field').val(),"search");
			
		});

		function GetContent(foreign_id,view_type)
		{
			var default_id = "itpdwd"; // Define default YouTube username ID here
			var max_videos = 4;  // How many to show
			
			if (!foreign_id)
			{	foreign_id = default_id;
				view_type = "id";
			}
			
			// Compute the request URL (either by username or by search term)
			//  Note: "alt=json-in-script&callback=?" params are in URL to allow cross-domain JSON using jQuery
			//  See: http://docs.jquery.com/Ajax/jQuery.getJSON#urldatacallback
			var url;
			if (view_type=="id")
				url = "http://gdata.youtube.com/feeds/api/users/" + escape(foreign_id) + "/uploads?max-results=" + max_videos +
					"&alt=json-in-script&callback=?";
			else
				url = "http://gdata.youtube.com/feeds/api/videos?vq=" + escape(foreign_id) + "&max-results=" + max_videos +
					"&alt=json-in-script&callback=?";
			
			// Clear the HTML display
			document.getElementById("videos").innerHTML = "";
			
			// Get the data from the web service and process
			$.getJSON(url,
				function(data)
				{
					$.each(data.feed.entry, function(i,item)
					{
						// Extract video ID from the videos API ID
						var api_id = item.id.$t; api_id.match(/\/(\w+?)$/);
						var id = RegExp.$1;
						
						var title = item.title.$t;
						
						// Get first 10 chars of date_taken, which is the date: YYYY-MM-DD
						var date_pub = item.published.$t.substring(0, 10);
						
						// Collect the authors
						var author_text = "";
						$.each(item.author, function(j,item2)
						{	if (author_text) author_text += ", ";
							author_text += '<a href="' + item2.uri.$t + '">' + item2.name.$t + '</a>';
						});
						
						// Format the HTML for this video
						var text = '<div align="left" class="video">' +
							'<b class="title">' + title + '</b><br/>' +
							'Published: ' + date_pub + ' by ' + author_text + '<br/>' +
							'<iframe width="560" height="315" src="http://www.youtube.com/embed/'+id+'" frameborder="0" allowfullscreen></iframe></div>';
						
						// Now append to the HTML display
						$(text).appendTo("#videos");
			
					});
				}
			);
		
		}


	});

			


})(jQuery);


