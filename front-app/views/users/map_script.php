<script type="text/javascript">
      /**
       * Called on the intiial page load.
       */

      var map;
      var marker, marker2;
      function init() {
        var mapCenter = new google.maps.LatLng(0, 0);
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 1,
          center: mapCenter,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });
	<?php if(!empty($friend_list))
	{
	  foreach($friend_list as $k=>$fl)
	  {
	    if($friend_lat_arr[$k]!=0 && $friend_long_arr[$k] !=0)
	    {
	      
	      $friend_bucket_id[$fl['friend_id']][] = $fl['bucket_id'];
  
	      {
		
	      if(isset($fl['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$fl['profile_image']) && $fl['profile_image'] !=''){
		$profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$fl['profile_image'];
	      }else{
		$profile_image = IMAGE_UPLOAD_URL."no_img.png";
	      }
		$review='';
		$review_details='';
	      if($fl['status'] == 'Completed')
	      {
		$review = 'Review';
		$review_details = ' | <span><a href="javascript:void(0);" class="view-review" data-element='.$fl['bucket_id'].' data-target="#view-review'.$fl['bucket_id'].'">'.$review.'</a></span>';
	      }
	      
	      $details = '';
	      $view_result = '';
	      
	      if($fl['deal_flyer_type'] == 'deal')
	      {
		$details = 'Offer Details';
		$view_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="view-offer-view" data-element="'.$fl["deal_flyer_id"].'" data-target="#view-offer-view'.$fl["deal_flyer_id"].'">'.$details.'</a></span>';
	      }
	      elseif($fl['deal_flyer_type'] == 'flyer')
	      {
		$details = 'Flyer Details';
		$view_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="view-flyer-view" data-element="'.$fl["deal_flyer_id"].'" data-target="#view-flyer-view'.$fl['deal_flyer_id'].'">'.$details.'</a></span>';
	      }
	      $add_bucket = '';
	      if($fl['is_in_bucket']==0)
	      {
		$add_bucket = '| <a href="javascript:void(0);" title="Add to bucket" id='.$fl["deal_flyer_id"].' class="addBucket" item='.$fl["deal_flyer_id"].' data-item ="'.$fl["deal_flyer_type"].'">Add to bucket</a>';
	      }
	  ?>
        marker = new RichMarker({
	 
	position: new google.maps.LatLng('<?php  echo $friend_lat_arr[$k];?>', '<?php echo $friend_long_arr[$k];?>'),
          map: map,
          draggable: false,
	  id: '<?php echo $fl['friend_id']."_".$fl['bucket_id'];?>',
          content: '<div class="map-bg" id="<?php echo $fl['friend_id']."_".$fl['bucket_id'];?>" onclick="popUpshow(<?php echo $fl['bucket_id']?>);" style="display:none;"><img class="shw"   src="<?php echo $profile_image ?>" style="height:40px;width:40px; border-radius:50%;"/></div><div class="info_<?php echo $fl['bucket_id']; ?> map-info" id="<?php echo $fl['bucket_id'] ?>" style="display:none;"><strong><?php echo stripslashes($fl['title']);?></strong><?php echo $review_details;?> <?php echo $view_result;  ?><?php echo $add_bucket;?><br><?php echo stripslashes($fl['address']); ?> <span class="close" id="<?php echo $fl['bucket_id'] ?>" onclick="popUpclose(<?php echo $fl['bucket_id']?>);"></span></div>',

          });
	  
        <?php
	      }
	    }
	  }
	}
	
	if(!empty($ownbucketlist))
	{
	  foreach($ownbucketlist as $k=>$ol)
	  {
	    if($own_lat_arr[$k]!=0 && $own_long_arr[$k] !=0)
	    {
	      
	    
		
	      if(isset($ol['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$ol['profile_image']) && $ol['profile_image'] !=''){
		$profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$ol['profile_image'];
	      }else{
		$profile_image = IMAGE_UPLOAD_URL."no_img.png";
	      }
	      
	      $details = '';
	      $own_result = '';
	      if($ol['deal_flyer_type'] == 'flyer')
	      {
		$details = 'Item Details';
		$own_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="own-flyer-view" data-element="'.$ol["deal_flyer_id"].'" data-target="#own-flyer-view'.$ol['deal_flyer_id'].'">'.$details.'</a></span>';
	      }	

	  ?>
        marker = new RichMarker({
	 
	position: new google.maps.LatLng('<?php  echo $own_lat_arr[$k];?>', '<?php echo $own_long_arr[$k];?>'),
          map: map,
          draggable: false,
	  id: '<?php echo $ol['bucket_id'];?>',
          content: '<div class="map-bg" id="ownmap_<?php echo $ol['bucket_id'];?>" onclick="ownpopUpshow(<?php echo$ol['bucket_id']?>);"><img class="shw"  src="<?php echo $profile_image ?>" style="height:40px;width:40px; border-radius:50%;"/></div><div class="owninfo_<?php echo $ol['bucket_id']; ?> map-info" id="<?php echo $ol['bucket_id'] ?>" style="display:none;"><strong><?php echo stripslashes($ol['flyer_title']);?></strong><?php echo $own_result;?><br><?php echo stripslashes($ol['fadress']); ?> <span class="close" id="<?php echo $ol['bucket_id'] ?>" onclick="popUpclose(<?php echo $ol['bucket_id']?>);"></span></div>',

          });
	  
        <?php
	      
	    }
	  }
	}
	
	?>
	
        var div = document.createElement('DIV');

        google.maps.event.addDomListener(document.getElementById('toggle-draggable'),
          'click', function() {
          //marker.setDraggable(!marker.getDraggable());
          //marker2.setDraggable(!marker2.getDraggable());
        });
      }


      google.maps.event.addDomListener(window, 'load', init);
      

      
  $( document ).ready(function() {   
  $('.chk').on("click", function(){
	
	   var chk_id = $(this).val();
	  
	//if($('.chk').is(":checked"))
	if($('#'+chk_id).is(":checked"))
	{
	
	    var id = $(this).val();
	    
	    var fl_id =  $(this).attr('data-fl-id');
	    var str = fl_id.split(',');
	    if (fl_id !=0) {
	      
	    
	      for(i=0;i<str.length;i++)
	      {	 
		f_id = id+'_'+str[i];
		
		$('#'+f_id).show();
	    }
	      
	    }
	}
	//})

	else
	{
	   var id = $(this).val();
	  
	    var fl_id =  $(this).attr('data-fl-id');
	     
	    var str = fl_id.split(',');
	   
	    if (fl_id !=0) {
	      
	    
	      for(i=0;i<str.length;i++)
	      {	 
		f_id = id+'_'+str[i];
		
		$('#'+f_id).hide();
		$('.info_'+str[i]).hide();
	    }
	      
	    }
	}
  });
  });
    
    </script>