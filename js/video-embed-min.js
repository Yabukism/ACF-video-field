(function(e){e(document).live("acf/setup_fields",function(t,n){function r(t,n){var r="itpdwd",i=4,s;if(!t){t=r;n="id"}e(".acf-vf-results").html("");s="http://gdata.youtube.com/feeds/api/videos?vq="+escape(t)+"&max-results=8&v=2&alt=json-in-script&callback=?";e.getJSON(s,function(t){e.each(t.feed.entry,function(t,n){var r=n.id.$t;r.match(/\/(\w+?)$/);var i=n.media$group.yt$videoid.$t,s=n.title.$t;console.log(n);var o=n.media$group.media$thumbnail[2].url,u=n.published.$t.substring(0,10),a="";e.each(n.author,function(e,t){a&&(a+=", ");a+='<a href="'+t.uri.$t+'">'+t.name.$t+"</a>"});var f="<img src='"+o+"' />";e(f).appendTo(".acf-vf-results");var f='<div align="left" class="video"><b class="title">'+s+"</b><br/>"+"Published: "+u+" by "+a+"<br/>"+i+'<iframe width="560" height="315" src="http://www.youtube.com/embed/'+i+'" frameborder="0" allowfullscreen></iframe></div>'})})}e(".input").keydown(function(t){if(t.keyCode==13){$searchTerm=e(this).val();r(e(this).val(),"search");return!1}});e(".videoSearchSubmit").live("click",function(){$searchTerm=e(this).prev(".videoSearchBox").val();r(e(this).prev(".videoSearchBox").val(),"search");return!1})})})(jQuery);