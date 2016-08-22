<!-- Middle Content-->
<div class="container-fluid content-bg">
   <div class="spacer"></div>
   <div class="container padding">
      <div class="col-md-2 col-xs-12">
         <div class="bradcome-menu">
            <ul>
               <li><a href="<?php echo base_url(); ?>">Home</a></li>
               <li><img src="<?php echo base_url(); ?>assets/designs/images/arrow1.png" width="7" height="6"></li>
               <li><a href="#"> About Us </a></li>
            </ul>
         </div>
      </div>
	 
   </div>
   <div class="container inner-content padding">
      <ul class="list-unstyled video-list-thumbs row">
      <?php
      //You can see related documentation and compose own request here: https://developers.google.com/youtube/v3/docs/search/list
      //You must enable Youtube Data API v3 and get API key on Google Developer Console(https://console.developers.google.com)
      
      set_error_handler('videoListDisplayError');
      
      //To try without API key: $video_list = json_decode(file_get_contents('example.json'));
      $video_list = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelId.'&maxResults='.$maxResults.'&key='.$API_key.''));
      
      foreach($video_list->items as $item)
      {
      	    //Embed video
      		if(isset($item->id->videoId)){
      			
      	echo '<li id="'. $item->id->videoId .'" class="col-lg-3 col-sm-6 col-xs-6 youtube-video">
      		<a href="#'. $item->id->videoId .'" title="'. $item->snippet->title .'">
      			<img src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" class="img-responsive" height="130px" />
      			<h2>'. $item->snippet->title .'</h2>
      			<span class="glyphicon glyphicon-play-circle"></span>
      		</a>
      	</li>
      	';
      	
      		}
      		//Embed playlist
      		else if(isset($item->id->playlistId))
      		{
      			echo '<li id="'. $item->id->playlistId .'" class="col-lg-3 col-sm-6 col-xs-6 youtube-playlist">
      		<a href="#'. $item->id->playlistId .'" title="'. $item->snippet->title .'">
      			<img src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" class="img-responsive" height="130px" />
      			<h2>'. $item->snippet->title .'</h2>
      			<span class="glyphicon glyphicon-play-circle"></span>
      		</a>
      	</li>
      	';
      		}
      
      }
      
      
      function videoListDisplayError()
      {
      	echo '<div class="alert alert-danger" role="alert"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> <i class="fa fa-exclamation-triangle"></i> Error while displaying videos!</div>';
      }
      
      
      ?>
      	
      	
      </ul>
      
      <a href="https://www.youtube.com/channel/<?php echo $channelId; ?>" target="_blank" class="btn btn-danger btn-lg"><i class="fa fa-youtube"></i> More videos...</a>


   </div>
   <div class="spacer"></div>
</div>
</div>
<!-- Middle Content-->

<script src="<?php echo base_url();?>assets/designs/js/jquery.min.js"></script>
<script>
//For video
$(".youtube-video").click(function(e){
	$(this).children('a').html('<div class="vid"><iframe src="https://www.youtube.com/embed/'+ $(this).attr('id') +'?autoplay=1" frameborder="0" allowfullscreen></iframe></div>');
    return false;
	 e.preventDefault();
	});
	//For playlist
	$(".youtube-playlist").click(function(e){
	$(this).children('a').html('<div class="vid"><iframe src="https://www.youtube.com/embed/videoseries?list='+ $(this).attr('id') +'&autoplay=1" frameborder="0" allowfullscreen></iframe></div>');
    return false;
	 e.preventDefault();
	});
	
</script>
 
 
