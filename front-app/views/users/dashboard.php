<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!--<script type="text/javascript" src="<?php //echo FRONTEND_URL.'js/';?>jquery.gomap-1.3.3.min.js"></script>-->
<script type="text/javascript" src="<?php echo FRONTEND_URL.'js/';?>richmarker.js"></script>
<script type="text/javascript" src="<?php echo FRONTEND_URL.'js/';?>StyledMarker.js"></script>


  <div class="modal fade print_flyer_box" id="view-flyer" tabindex="-1" role="dialog" aria-hidden="true">
	 <div class="modal-dialog">
	     <div class="modal-content">
		  <div class="modal-header">
			   <h2>Flyer Details: <span id="flyertitle"></span></h2> <a href="javascript:void(0);" id="print_flyer" class="printlink" style="display: none;"></a> 
			   <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		  </div>
		  <div class="modal-body">
		      <div id="flyer_details" class="offer_details_Box"></div> 
		  </div>
	     </div>
	 </div>
   </div>



<?php //pr($ownbucketlist);
//pr($friend_list);
$friend_id=$friend_list[0]['friend_id'];
/*foreach($friend_list as $k=>$fl)
	  {
	      echo $fl['friend_id'];
	      if($friend_id!=$fl['friend_id']){
		     echo 'new';
	      }else{
		     echo 'old';
	      }
	  }*/
?>

<?php
if(isset($user_details->profile_image) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$user_details->profile_image) && $user_details->profile_image !=''){
      $profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$user_details->profile_image;
}else{
      $profile_image = FRONTEND_URL."images/no-profile-image.png";
}
?>

<script>
  
   function popUpshow(id)
  {
      //alert(id);
      $('#'+id).show();
  }
  
  function ownpopUpshow(id)
  {
    //$('#'+id).show();
    $('.owninfo_'+id).show();
  }
  function popUpclose(id)
  {
    //$('#'+id).hide();
    $('.owninfo_'+id).hide();
  }
  var lat_arr	=	$.parseJSON(<?php print json_encode(json_encode( $friend_lat_arr)); ?>);
  var long_arr	=	$.parseJSON(<?php print json_encode(json_encode( $friend_long_arr)); ?>);
      
  
</script>

    <script type="text/javascript">
      /**
       * Called on the intiial page load.
       */
       var map;
       var marker, marker2;      
       var latitude=0;
       var longitude=0;
       var zoomer=1;
       function show_bucket_map(id,typ,own,status){
	      
	      $('#print_flyer').hide();
	      $('#print_deal').hide();
	      if (typ=='flyer' && status=='Active') {
		$('#print_flyer').show();
	      }
	      if (typ=='deal' && status=='Active') {
		$('#print_deal').show();
	      }
	      
				  
       //alert(typ);
	      $.ajax({			
			    type: "POST",
			    url: FRONT_URL + "dashboard/get_lat_long/",
			    dataType: 'json',
			    data: { 'id': id, 'typ': typ },
			    success: function(resp){
				   /*$('#offer_details').html(msg);
				   $("#view-offer"+offer_id).attr("id","view-offer");*/
				   var latitude=resp.latitude;
				   var longitude=resp.longitude;
				   var zoomer=4;
				   if (own==1) {
					 var clicked=0;
				   }else{
					var clicked=1;  
				   }
				   
				  // $("#map").load();
				  init(latitude, longitude, zoomer, clicked);
			    }
		     });
       //22.5667� N, 88.3667� E
	     /* var latitude=22.5667;
	      var longitude=88.3667;*/
       }

      function init(latitude, longitude, zoomer, clicked) {
       //alert(latitude);
       if (isNaN(latitude)) {
	     latitude=0;
       }
       if (isNaN(longitude)) {
	     longitude=0;
       }
       if (isNaN(zoomer)) {
	     zoomer=1;
       }
       var mapCenter = new google.maps.LatLng(latitude, longitude);
       map = new google.maps.Map(document.getElementById('map'), {
	 zoom: zoomer,
	 center: mapCenter,
	 mapTypeId: google.maps.MapTypeId.ROADMAP
       });
       
	/***************************Bucket List******************************/
       if (clicked==1) {	
	      marker = new RichMarker({
	       
		    position: new google.maps.LatLng(latitude, longitude),
		    map: map,
		    draggable: false,
		   
		     content: '<div class="map-bg" ><img class="shw" src="<?php echo $profile_image ?>" style="height:40px;width:40px; border-radius:50%;"/></div>',
		    
		    
	     });
       }
       /*******************************************************************/
	<?php if(!empty($friend_list))
	{ $i=1;
	
       foreach($friend_list as $k=>$fl)
	  {
	      
	    //$cnt=count($friend_list);
	    //for($fc=0;$fc>$cnt;$cnt++){
	      
	      
	    //}
	    if($friend_lat_arr[$k]!=0 && $friend_long_arr[$k] !=0)
	    {
	      
	      $friend_bucket_id[$fl['friend_id']][] = $fl['bucket_id'];
  
	      {
		if($friend_id!=$fl['friend_id']){
		     $friend_id=$fl['friend_id'];
		     $i=$i+1;
		     if($i>3){
			    $i=1;
		     }
	      }     
		
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
		$view_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="view-offer-view" data-element="'.$fl["deal_flyer_id"].'" data-target="#view-offer-view'.$fl["deal_flyer_id"].'" title="'.stripcslashes($fl['title']).'">'.$details.'</a></span>';
	      }
	      elseif($fl['deal_flyer_type'] == 'flyer')
	      {
		$details = 'Flyer Details';
		$view_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="view-flyer-view" data-element="'.$fl["deal_flyer_id"].'" data-target="#view-flyer-view'.$fl['deal_flyer_id'].'" title="'.stripcslashes($fl['title']).'">'.$details.'</a></span>';
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
          content: '<div class="map-bg<?php echo $i;?>" id="<?php echo $fl['friend_id']."_".$fl['bucket_id'];?>" onclick="popUpshow(<?php echo $fl['bucket_id']?>);" style="display:none;"><img class="shw"   src="<?php echo $profile_image ?>" style="height:40px;width:40px; border-radius:50%;"/></div><div class="info_<?php echo $fl['bucket_id']; ?> map-info" id="<?php echo $fl['bucket_id'] ?>" style="display:none;"><strong><?php echo preg_replace('/[^A-Za-z0-9\-]/', '',stripcslashes($fl['title']));?></strong><?php echo preg_replace('/[^A-Za-z0-9\-]/', '',$review_details);?> <?php echo $view_result;  ?><?php echo $add_bucket;?><br><?php echo preg_replace('/[^A-Za-z0-9\-]/', '',stripcslashes($fl['address'])); ?> <span class="close" id="<?php echo $fl['bucket_id'] ?>" onclick="popUpclose(<?php echo $fl['bucket_id']?>);"></span></div>',

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
          content: '<div class="map-bg" id="ownmap_<?php echo $ol['bucket_id'];?>" onclick="ownpopUpshow(<?php echo $ol['bucket_id'];?>);"><img class="shw"  src="<?php echo $profile_image; ?>" style="height:40px;width:40px; border-radius:50%;"/></div><div class="owninfo_<?php echo $ol['bucket_id']; ?> map-info" id="<?php echo $ol['bucket_id']; ?>" style="display:none;"><strong><?php echo preg_replace('/[^A-Za-z0-9\-]/', '',stripcslashes($ol['flyer_title']));?></strong><?php echo $own_result;?><br><?php echo preg_replace('/[^A-Za-z0-9\-]/', '',stripcslashes($ol['fadress'])); ?><span class="close" id="<?php echo $ol['bucket_id']; ?>" onclick="popUpclose(<?php echo $ol['bucket_id'];?>);"></span></div>',

          });
	  
        <?php
	      
	    }
	  }
	}
	
	?>
	//////////////////Bucket Lists//////////////////////
	<?php
	//pr($bucketInfo);
	if(!empty($bucketInfo))
	{
	  foreach($bucketInfo as $k=>$ol)
	  {
	    if($bucket_lat_arr[$k]!=0 && $bucket_long_arr !=0)
	    {
	      
	      $details = '';
	      $own_result = '';
		$details = 'Item Details';
		$own_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="own-flyer-view" data-element="'.$ol["deal_flyer_id"].'" data-target="#own-flyer-view'.$ol['deal_flyer_id'].'">'.$details.'</a></span>';

	  ?>
	     marker = new RichMarker({
	 
position: new google.maps.LatLng('<?php  echo $bucket_lat_arr[$k];?>', '<?php echo $bucket_long_arr[$k];?>'),
map: map,
draggable: false,
id: '<?php echo $ol['bucket_id'];?>',
content: '<div class="map-bg" id="ownmap_<?php echo $ol['bucket_id'];?>" onclick="ownpopUpshow(<?php echo $ol['bucket_id']?>);"><img class="shw"  src="<?php echo $profile_image ?>" style="height:40px;width:40px; border-radius:50%;"/></div><div class="owninfo_<?php echo $ol['bucket_id']; ?> map-info" id="<?php echo $ol['bucket_id'] ?>" style="display:none;"><strong><?php echo preg_replace('/[^A-Za-z0-9\-]/', '',stripcslashes($ol['title']));?></strong><?php echo $own_result;?><br><span class="close" id="<?php echo $ol['bucket_id'] ?>" onclick="popUpclose(<?php echo $ol['bucket_id']?>);"></span></div>',

});     
	  
        <?php
	      
	    }
	  }
	}
	
	?>
	///////////////////////////////////////////////////
	
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

    <div class="content noGap">
      <div class="dashProfile">
	<?php if(isset($succmsg) && $succmsg != '' ){ ?>
	    <div class="alert success-msg display-show" align="center">
	      <p><?php echo stripslashes($succmsg);?></p>
	      
	    </div>			    
      <?php } ?>
        <div class="dashProLeft">
	      <div class="profileImgLt">
          <div class="profileImg">
	      <span id="dashboardProfileImg">
	   
	    <img src="<?php echo $profile_image?>" alt="no_img.png">
	    </span>
	    
	  </div>

	   <!--<a href="<?php //echo FRONTEND_URL;?>register/updateImg" class="img-upload" data-toggle="modal" data-target="#change-image-popup">Change Image</a>-->
	  <a href="javascript:void(0);" class="img-upload" data-toggle="modal" data-target="#change-image-popup">Change Image</a>
	  
	  </div>
	  
          <div class="profileInfo">
            <h2><?php echo stripslashes($user_details->first_name).' '.stripslashes($user_details->last_name);?></h2>
            <p>
	    <?php
	    if($user_details->city != ''){echo stripslashes($user_details->city).', ';}
	    if($user_details->state != ''){echo stripslashes($user_details->state);}
	    ?></p>
            <p class="traveler_type"><strong>Traveler Type : </strong><?php
	    
	    if(is_array($traveler_type) && count($traveler_type) > 0)
	    {
	      
	      $i=0;
		foreach($traveler_type as $travel)
		{
		  $i++;
	   ?>
				     
	   <span><?php
	   if($i==count($traveler_type))
	   {
	     $val = '';
	   }
	   else
	   {
	     $val = ',';
	   }
	   echo stripslashes($travel['type_name'].$val);?></span>
	    <?php
	     
		}
	    
	    }
	    else
	    {
	      echo 'N/A';
	    }
	    
	   
	    ?>
	    </p>
          </div>
	  <div class="rightBtnSec">
	  <div class="frnd_list">
	    <a href="<?php echo FRONTEND_URL."friendlist";?>" class="blueBtn">Add More Friends</a>
	    <br/>
	    
	    <?php
	   
	    $i=0;
	    if(is_array($pendingFriendRq)){
	      foreach ($pendingFriendRq as $val){
		$i+=1;
	      }
	    }
	    if($i > 0){
	      echo "You have ".$i." <br/>new friend request!";
	    }
	    ?>
	  </div>
	 
	    <div class="selectBox discountType">
              <dl class="select-box ">
                <dt> <span class="com-button"><a href="javascript:void(0);" class="blueBtn"> Compare Dotz (+)
                  <!--<p class="multiSel"></p>-->
                  </a> </span></dt> 
                <dd>
                  <div class="mutliSelect">
                    <ul>
                      <?php if(is_array($friend) && count($friend) > 0)
                           {
                            foreach($friend as $fr)
                            {
			      if(isset($friend_bucket_id[$fr['user_id']]) ){
				
				$fl_id = implode(",",$friend_bucket_id[$fr['user_id']]);
			      }
			      else
			      {
				$fl_id = 0;
			      }
			      
                            ?>
                            <li>  
                                   <input type="checkbox" class="chk chkType" name="type[]" data-fl-id="<?php echo $fl_id;?>" data-element="<?php echo stripslashes($fr['first_name'])." ".stripslashes($fr['last_name']); ?>" value="<?php echo $fr['user_id'];?>" id="<?php echo $fr['user_id'];?>" />
				   <?php echo stripslashes($fr['first_name'])." ".stripslashes($fr['last_name']); ?>
				   
			    </li>
                            <?php
                            }
                           }
                            ?>
                    
                    </ul>
                  </div>
                </dd>
              </dl>
            </div>

	  
	  
        </div>
	</div>
        <div class="dashProRight"> <!--<a href="<?php //echo FRONTEND_URL."register/updateProfile/";?>" class="blueBtn">Edit my Profile</a>--> </div>
        <br class="spacer"/>
      </div>
      

      
      <div class="dashBan" id="map" style="height: 400px;width: 100%; position: relative;"> <p style="position: absolute; top: 50%; width: 100%; text-align: center; font-size:20px; color:#0098d4;">Loading..... </p></div>
      <div class="dashBucket"> <span class="round"><img src="<?php echo FRONTEND_URL; ?>images/bucket.jpg" alt="" /></span>
        <h2> BUCKET LIST </h2>
        <a href="<?php echo FRONTEND_URL; ?>friendlist">(<label id="cmplt_itme"></label> items completed ! You are in 4th Place among your <span>friends</span>)</a> 
<!--        <div class="frnd_list">
	  <a href="<?php //echo FRONTEND_URL; ?>flyer/offer_flyer_list"><span class="moreofferflyers">See More Offers and Flyers!</span></a>
	</div>-->
	      <div class="watchVideoBtn seemore-offer"><a href="<?php echo FRONTEND_URL; ?>flyer/offer_flyer_list" class="flyer-btn">More Offers and Flyers!</a></div>
              <div class="dashOption dashTop">
                  <ul id="bucket_menu">
		    <li><a href="javascript:void(0);" data-val="all" class="actv">All</a></li>
                    <li><a href="javascript:void(0);" data-val="bucketActive">Active</a></li>
                    <li><a href="javascript:void(0);" data-val="expired">Expired </a></li>
                    <li><a href="javascript:void(0);" data-val="completed" >Completed </a></li>
		    <li><a href="javascript:void(0);" data-val="My own item" >My Dream List </a></li>
                    <li><a href="javascript:void(0);" data-val="Invited" class="invited" >Invited <?php if(is_array($pendingList) &&  count($pendingList)>0){echo "( ".count($pendingList)." invites pending )";}?></a></li>
		    
                  </ul>
		  <div class="input-box">
		      <select id="type_name" name="type_name">
			<option value="0">All</option>
			<option value="flyer">Flyer</option>
			<option value="deal">Offer</option>
		      </select>
		      </div>
              </div>
	      <div class="own-item"><a href="javascript:void(0);" data-toggle="modal" class="add-my-item" data-element="" data-target="#my_item"data-val="My own item" >Add to my Dream List</a></div>

      </div>
      
      
      
      <div class="dashboard">
        <div>
         <!-- <div class="scrollbar">
            <div class="track">
              <div class="thumb">
                <div class="end"></div>
              </div>
            </div>
          </div>-->
          <div class="viewport">
            <div class="overview">
              <div class="dashListing">
              	<ul id="dashboard_bucket_list">
		  
		  <?php
		  //pr($bucketInfo);
		  $cmp_count = 0;
		  $totalSavings = 0;
		  $totalCompletedSavings =0;
		  $totalExpireSavings=0;
		  $totalActiveSavings=0;
		    if(is_array($bucketInfo)) {
		    foreach($bucketInfo as $bucket){
		      if($bucket['bucket_status'] == 'Completed')
		      {
		      
			if($bucket['type']!='flyer')
			{ 
			  $totalCompletedSavings = $totalCompletedSavings + $bucket['savings'];
			  //$totalCompletedSavings = $totalCompletedSavings + 7.9;
			}
		      }
		      elseif($bucket['expired'] == 'Yes' )
		      {
			if($bucket['type']!='flyer')
			{ 
			  $totalExpireSavings = $totalExpireSavings + $bucket['savings'];
			}
		      }
		      elseif($bucket['bucket_status'] == 'Active')
		      {
			if($bucket['type']!='flyer')
			{ 
			  $totalActiveSavings = $totalActiveSavings + $bucket['savings'];
			}
		      }
		     
			if($bucket['type']!='flyer')
			{ 
			  $totalSavings = $totalSavings + $bucket['savings'];
			  
			}
		      
		    ?>
                    <li class="<?php
		    if($bucket['bucket_status'] == 'Completed'){
		     echo "completed";} else { 
		    echo ($bucket['expired'] == 'Yes')?'expired':"bucket".$bucket['status'];}?> <?php echo $bucket['type'];?>" data-type="<?php echo $bucket['type'];?>"
		    id="main_<?php echo $bucket['bucket_id'];?>">
                    	<div class="listUp">
                        	<div class="listLeft">
				   
				   <?php if($bucket['type']=='flyer'){ ?>

				   <a href="javascript:void(0);" onclick='show_bucket_map("<?php echo $bucket['deal_flyer_id'];?>","<?php echo $bucket['type'];?>","","<?php echo $bucket['bucket_status']?>");' data-toggle="modal" class="view-flyer viewOfferLt" data-element="<?php echo $bucket['deal_flyer_id'];?>" data-target="#view-flyer<?php echo $bucket['deal_flyer_id'];?>" title="<?php echo stripcslashes($bucket['title']);?>">
					  <span><?php echo $bucket['title'];?></span>
				   </a>
				   <?php }else{ ?>
				   <a href="javascript:void(0);" onclick='show_bucket_map("<?php echo $bucket['deal_flyer_id'];?>","<?php echo $bucket['type'];?>","","<?php echo $bucket['bucket_status']?>");' data-toggle="modal" class="view-offer viewOfferLt" data-element="<?php echo $bucket['deal_flyer_id'];?>" data-target="#view-offer<?php echo $bucket['deal_flyer_id'];?>"  title="<?php echo stripcslashes($bucket['title']);?>">
					  <span><?php echo $bucket['title'];?></span>
				   </a>
				   <span class="savingsBox">Savings <span id="save_<?php echo $bucket['bucket_id'];?>"><?php echo '$'.$bucket['savings'];?></span></span>
				<?php }?>
				  
				  <?php //}?>
				  <div class="input-box">
					  <select onchange="changePrivacy(<?php echo $bucket['bucket_id'];?>, this.value);">
					    <option value="0" <?php if($bucket['privacy']=='0'){?> selected="selected" <?php } ?> >Private</option>
					    <option value="1" <?php if($bucket['privacy']=='1'){?> selected="selected" <?php } ?> >Friends Only</option>
					    <option value="2" <?php if($bucket['privacy']=='2'){?> selected="selected" <?php } ?> >Public</option>
					  </select>
					</div>
                            </div>
                            <div class="listRight">
                            	<p>
				<a href="javascript:void(0);" data-toggle="modal" class="view-vendor-profile" data-element="<?php echo $bucket['vendor_id'];?>" data-target="#view-vendor-profile<?php echo $bucket['vendor_id'];?>"><?php echo $bucket['company_name'];?></a>
				
				</p> 
                                <div class="listIcons">
				  <?php
				    if($bucket['bucket_status'] == 'Completed'){
				    $cmp_count++;
				  ?>
                                <span><a href="javascript:void(0);"><img title="Completed" id="completed_<?php echo $bucket['bucket_id'];?>" src="<?php echo FRONTEND_URL;?>images/tick.png" alt="" /></a></span>
				<?php }
				else
				{
				?>
				<span>
				   <a href="javascript:void(0);" class="fl" id="review_<?php echo $bucket['bucket_id'];?>" data-id = "<?php echo $bucket['bucket_id'];?>" data-element="<?php echo $bucket['type']; ?>">
					  <img title="Post Review" src="<?php echo FRONTEND_URL;?>images/tick-g.png" alt="" />
				   </a>
				</span>
				<?php
				}
				?>
				
                               
                                <span><a href="javascript:void(0);" title="Delete" class="bucket_delete" data-id="<?php echo $bucket['bucket_id'];?>"><img src="<?php echo FRONTEND_URL;?>images/close.png" alt="" /></a></span>
				
				
                                </div>
                            </div>
                        </div>
                        <div class="listDown">
				   <div class="listLeft">
                        		<p>on bucket list of <?php echo $bucket['otherpeople_count'];?> other people</p>
				   </div>
				   <dl class="invite-select-box" id="invite_option_<?php echo $bucket['bucket_id'];?>" style="<?php echo($bucket['privacy']==0 || $bucket['privacy']==2)? 'display: none':'display: block'?>">
				   <dt> <a href="javascript:void(0);" class="invite_hide"> <span>Invite Friends</span>
				     <p class="multiSel"></p>
				     </a> </dt> 
				   <dd class="invite_list">
				     <div class="inviteMutliSelect">
					  <span class="inviteAction_<?php echo $bucket['bucket_id'];?>"></span>
				       <ul id="invite_list_ul">
					 <?php if(is_array($friend) && count($friend) > 0)
					      {
					       foreach($friend as $fr)
					       {
						 if(isset($bucket['final_accpt_list']) && in_array($fr['user_id'],$bucket['final_accpt_list'])){
							$frName = stripslashes($fr['first_name']. ' '.$fr['last_name']);
							$bucket_item_name = stripslashes($bucket['title']); 
					       ?>
					        <li class="invitefrnd_name">  
						      <input type="checkbox" class="chk invite_check" name="type[]" data-fl-id="" data-element="<?php echo $frName; ?>" value="<?php echo $fr['user_id'];?>" id="<?php echo $fr['user_id'].'_'.$bucket['bucket_id'].'_'.$frName.'_'.$bucket_item_name;?>" checked  disabled/>
						      <?php echo stripslashes($fr['first_name'])." ".stripslashes($fr['last_name']); ?>
						      <!--Already Accepted   -->
					       </li>				       
					       <?php }else{
						 $frName = stripslashes($fr['first_name']. ' '.$fr['last_name']);
						 $bucket_item_name = stripslashes($bucket['title']);
						 ?>
					       <li class="invitefrnd_name">  
						      <input type="checkbox" class="chk invite_check" name="type[]" data-fl-id="" data-element="<?php echo $frName; ?>" value="<?php echo $fr['user_id'];?>" id="<?php echo $fr['user_id'].'_'.$bucket['bucket_id'].'_'.$frName.'_'.$bucket_item_name;?>" <?php if(isset($bucket['invite_list']) && is_array($bucket['invite_list']) && count($bucket['invite_list'])>0 && in_array($fr['user_id'],$bucket['invite_list'])){echo "checked disabled";}?>/>
						      <?php echo $frName; ?>	      
					       </li>
					       <?php
						 }
					       }
					      }
					       ?>
				       
				       </ul>
				     </div>
				   </dd>
				 </dl>
			      <div id="privacyMsg<?php echo $bucket['bucket_id'];?>" class="listRight privacyMsgSetDiv"></div>
                            <!--<div class="listRight">
                            	<a href="">Offer Expired!  <span>See Other Vendor Offers</span></a>
                            </div>-->
                        </div>
                    </li>
		    <?php } } else {//echo "<li>No Record Found </li>"; ?>
		    <li class="noRecord">No Record Found </li>
		    <?php } ?>
                </ul>
              </div>
	      
	      <!--------------------my own list------------------------------>
	      
	     <div id="my_own_page" class="dashListing2">
	      <p><h3 style="text-align: center;color: red;">Add your dreams to your bucket list today, and Traveldotz will tailor future offers to fit you!</h3></p><br/>
	      <ul id="own_item">
		<?php
		    if(is_array($ownbucketlist)) {
		    foreach($ownbucketlist as $ownbucket){
		    ?>
		<li id="own_<?php echo $ownbucket['bucket_id'];?>" class="<?php echo $ownbucket['type'];?>">
		  <div class="listUp">
		     <div class="listLeft">
       <a href="javascript:void(0);" data-toggle="modal" class="own-flyer viewOfferLt" data-element="<?php echo $ownbucket['deal_flyer_id'];?>" data-target="#own-flyer"><span><?php echo $ownbucket['flyer_title']; ?></span></a>
		       

		     <div class="input-box">
		      <select onchange="changePrivacy(<?php echo $ownbucket['bucket_id'];?>, this.value);">
			<option value="0" <?php if($ownbucket['privacy']=='0'){?> selected="selected" <?php } ?> >Private</option>
			<option value="1" <?php if($ownbucket['privacy']=='1'){?> selected="selected" <?php } ?> >Friends Only</option>
			<option value="2" <?php if($ownbucket['privacy']=='2'){?> selected="selected" <?php } ?> >Public</option>
		      </select>
		    </div>
		       
		     </div>
		     <div class="listRight">				      
			    <p></p> 
			    <div class="listIcons">
			    
			    <span><a href="javascript:void(0);" class="fl" id="review_<?php echo $ownbucket['bucket_id'];?>" data-id = "<?php echo $ownbucket['bucket_id'];?>" data-element="<?php echo $ownbucket['type']; ?>"><img title="Post Review" src="<?php echo FRONTEND_URL;?>images/tick-g.png" alt="" /></a></span>
       
			    <span><a href="javascript:void(0);" onclick='show_bucket_map("<?php echo $ownbucket['deal_flyer_id'];?>","flyer","1","");' title="Delete" class="bucket_delete" data-id="<?php echo $ownbucket['bucket_id'];?>" id="<?php echo $ownbucket['deal_flyer_id'];?>" data-element="Own"><img src="<?php echo FRONTEND_URL;?>images/close.png" alt="" /></a></span>
		    
		   
			    </div>
		     </div>
		  </div>
		  <div class="listDown">
		    <div class="listLeft">
                        		<!--<p>on bucket list of 0 other people</p>-->
					
					
                            </div>
			      <div id="privacyMsg" class="listRight privacyMsgSetDiv"></div>
		  </div>


            <div class="listDown">
                <div class="listLeft">
                    <p>on bucket list of <?php echo $ownbucket['otherpeople_count'];?> other people</p>
                </div>
                <dl class="invite-select-box" id="invite_option_<?php echo $ownbucket['bucket_id'];?>" style="<?php echo($ownbucket['privacy']==0 || $ownbucket['privacy']==2)? 'display: none':'display: block'?>">
                    <dt> <a href="javascript:void(0);" class="invite_hide"> <span>Invite Friends</span>
                            <p class="multiSel"></p>
                        </a> </dt>
                    <dd class="invite_list">
                        <div class="inviteMutliSelect">
                            <span class="inviteAction_<?php echo $ownbucket['bucket_id'];?>"></span>
                            <ul id="invite_list_ul">
                                <?php
				//pr($ownbucketlist);
				if(is_array($friend) && count($friend) > 0)
                                {
                                    foreach($friend as $fr)
                                    {
                                        if(isset($ownbucket['final_accpt_list']) && in_array($fr['user_id'],$ownbucket['final_accpt_list'])){
                                            ?>
                                            <li>
                                                <input type="checkbox" class="chk invite_check" name="type[]" data-fl-id="" data-element="<?php echo stripslashes($fr['first_name'])." ".stripslashes($fr['last_name']); ?>" value="<?php echo $fr['user_id'];?>" id="<?php echo $fr['user_id'].'_'.$ownbucket['bucket_id'];?>" checked  disabled/>
                                                <?php echo stripslashes($fr['first_name'])." ".stripslashes($fr['last_name']); ?>
                                                <!--Already Accepted   -->
                                            </li>
                                        <?php }else{?>
                                            <li>
                                                <input type="checkbox" class="chk invite_check" name="type[]" data-fl-id="" data-element="<?php echo stripslashes($fr['first_name'])." ".stripslashes($fr['last_name']); ?>" value="<?php echo $fr['user_id'];?>" id="<?php echo $fr['user_id'].'_'.$ownbucket['bucket_id'];?>" <?php if(isset($ownbucket['invite_list']) && is_array($ownbucket['invite_list']) && count($ownbucket['invite_list'])>0 && in_array($fr['user_id'],$bucket['invite_list'])){echo "checked";}?>/>
                                                <?php echo stripslashes($fr['first_name'])." ".stripslashes($fr['last_name']); ?>
                                            </li>
                                        <?php
                                        }
                                    }
                                }
                                ?>

                            </ul>
                        </div>
                    </dd>
                </dl>
                <div id="privacyMsg<?php echo $ownbucket['bucket_id'];?>" class="listRight privacyMsgSetDiv"></div>
                <!--<div class="listRight">
                    <a href="">Offer Expired!  <span>See Other Vendor Offers</span></a>
                </div>-->
            </div>



		</li>
		<?php
		    }
		    }
		    else
		    {
		     ?>
		     <li class="noRecordOwn">No Record Found </li>
		     <?php
		    }
		?>
	      </ul>
	     </div> 
	      <!--------------------my own list------------------------------>
	      
	      
	      	    <div  id="invite_list_div" class="dashListing2">
	      <div class="acceptDecline"></div>
	      <ul>
		     <?php
		     $totalInvitesavings = 0;
		    //pr($pendingList);
			    if(is_array($pendingList) &&  count($pendingList)>0)
			    {
				   foreach($pendingList as $v)
				   {
				    $offerPrice = $offer_val['offer_price'];
				    if($v['discount_type'] == '$')
				    {
					    $savings = ($offerPrice - $v['amount']);
				    }
				    if($v['discount_type'] == '%')
				    {
					    
				    $savings = ($offerPrice - (($offerPrice * $v['amount'])/100));
				    
				    }
				    $totalInvitesavings = $totalInvitesavings + $savings;
		     ?>
			    <li id="invite_<?php echo $v['invite_id'];?>" class="<?php echo $v['deal_flyer_type'];?>" >
			    <div class="listUp">
				    <div class="listLeft">				      
					  <a data-id="<?php echo $v['bucket_id'];?>" class="fl viewOfferLt" href="javascript:void(0);"><span><?php echo $v['bucket_name'];?></span></a>
					  <span class="savingsBox">Savings <span><?php echo '$'.$savings;?></span></span>
<!--					  <div class="input-box">
					  <select onchange="changePrivacy(<?php //echo $v['bucket_id'];?>, this.value);">
					    <option value="0" <?php //if($v['privacy']=='0'){?> selected="selected" <?php //} ?> >Private</option>
					    <option value="1" <?php //if($v['privacy']=='1'){?> selected="selected" <?php //} ?> >Friends Only</option>
					    <option value="2" <?php //if($v['privacy']=='2'){?> selected="selected" <?php //} ?> >Public</option>
					  </select>
				   </div>
-->				</div>
				<div class="listRight">
				    <p>
				    <a href="javascript:void(0);" data-toggle="modal" class="view-vendor-profile" data-element="<?php echo $v['vendor_id'];?>" data-target="#view-vendor-profile<?php echo $v['vendor_id'];?>"><?php echo $v['company_name'];?></a>
				    
				    </p> 
				</div>
			    </div>
			    <div class="listDown">
				   <div class="listLeft">
					<p>on bucket list of <?php echo $v['otherpeople_count'];?> other people</p>
				   </div>
				   <div class="accept_decline">
					  <div class="invited_by">Invited By <?php echo stripcslashes($v['send_from']);?></div>
					  <div class="action">
						 <input type="button" value="Accept" class="accept_invite blueBtn" data-element="<?php echo $v['invite_id'];?>">
						 <input type="button" value="Decline" class="decline_invite blueBtnDk" data-element="<?php echo $v['invite_id'];?>">
					  </div>
				   </div>  
				  <div class="listRight privacyMsgSetDiv" id="privacyMsg78"></div>
			    </div>
                    </li>
		     <?php }}else{?>
			    <li class="NoInvite">No invite found</li>
		     <?php }?>
	      </ul>
            </div>

	      
	      
            </div>
	  <div class="btmSaving">
	  <span class="savingsBox">Total savings<span id='totalsaved_val'><?php echo '$'.$totalSavings;?></span></span>
	  </div>
          </div>
        </div>
      </div>
    </div>


  <div class="modal fade" id="view-vendor-profile" tabindex="-1" role="dialog" aria-hidden="true">
	   <div class="modal-dialog">
	       <div class="modal-content">
		       <div class="modal-header">
			  Vendor Details     <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		       </div>
		       <div class="modal-body">
			   <div id="view_vendor_details" class="offer_details_Box">Loading...</div> 
		       </div>
	       </div><!-- /.modal-content -->
	   </div><!-- /.modal-dialog -->
  </div><!-- /.modal ---->

<!------------------------- My own item----------------------->

 <div class="modal fade" id="my_item" tabindex="-1" role="dialog" aria-hidden="true">
	   <div class="modal-dialog">
	       <div class="modal-content">
		       <div class="modal-header">
			  My Dream List Details
			  <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		       </div>
		       <div class="modal-body">
			<form action="" method="post" id="own_form">
			<div class="joinForm">
			   <ul class="form-list">
			    
                	<li>
                    	<div class="field">
                        	<label for="Item Name">Item Name</label>
                            <div class="input-box">
                            	<input type="text" class="input-text required" value="<?php echo set_value('item_name');?>" id="item_name" name="item_name">
                            </div>
                        </div>
                        </li>
			
			<li class="fields">
                    	<div class="field">
                        	<label for="Country">Address</label>
                            <div class="input-box">
				<textarea id="address" name="address"></textarea>
			    </div>
                        </div>
		        </li>
                    
		         <li class="fieldsTwo">
                    	<div class="field">
                        	<label for="Country">Country</label>
                            <div class="input-box">
			        <select name="country" id="country" class="required" onChange="country_chk(this.value)">
				    <option value="">Select Country</option>
				    <?php
				    foreach($countries as $country){?>
				    <option value="<?php echo $country['id']?>" <?php if($country['id'] == '1'){ ?> selected="selected"<?php } ?>><?php echo $country['country_name']?></option>
				    <?php }?>
				</select>
                            </div>
                        </div>
                        <div class="field">
                        	<label for="City">City</label>
                            <div class="input-box">
                            	<input name="city" id="city" value="<?php echo set_value('city');?>" class="input-text required" type="text" />
                            </div>
                        </div>
                    </li>
                    <li class="fieldsTwo">
                    	<div class="field stateList">
                        	<label for="State">State / Province</label>
                            <div class="input-box"> 
				<select name="state" id="state" class="required">
				 <?php
				 if(is_array($states) && count($states) > 0)
				    foreach($states as $state_list){?>
				    <option value="<?php echo $state_list['default_name']?>" ><?php echo $state_list['default_name']?></option>
				    <?php }?>
                            	</select>
                           </div>
                        </div>
                        <div class="field">
                        	<label for="Zip">Zip / Postal Code</label>
                            <div class="input-box">
                            	<input name="zip" id="zip" value="<?php echo set_value('zip');?>" class="input-text" type="text" />
                            </div>
                        </div>
			
                    </li>
		    <li class="fields">
                    	<div class="field">
                        	<label for="Description">Description</label>
                            <div class="input-box">
				<textarea id="descptn" name="descptn"></textarea>
			    </div>
                        </div>
		    </li>
		    
		    <li class="fields">
                    	<div class="field">
                        	<label for="Description">Who can see this on your bucket list ? </label>
                            <div class="input-box">
				<select name="privacy" id="privacy" class="required">
				  <option value="1">Friends</option>
				 <option value="0">Private</option>
				 <option value="2">Public</option>
                            	</select>
			    </div>
                        </div>
		    </li>
			
                </ul>
		       </div>
			<div class="formButtons regButton">
		        <input type="hidden" value="Process" name="action">
                	<input type="submit" class="blueBtn" value="SUBMIT" title="SUBMIT" id="sub">
                </div>
		</form>
		</div>
	       </div><!-- /.modal-content -->
	   </div><!-- /.modal-dialog -->
  </div><!-- /.modal ---->

<!------------------------- My own item----------------------->

  
  
  
  <!------------------------- My own item modal----------------------->
  

  <div class="modal fade" id="own-flyer" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog">
	   <div class="modal-content">
		   <div class="modal-header">
			      <h2>Item Details</h2> 
			      <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		   </div>
		   <div class="modal-body">
		       <div id="own_details" class="offer_details_Box"></div> 
		   </div>
	   </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
  </div><!-- /.modal ---->
      <!------------------------- My own item modal----------------------->
      
      
  <div class="modal fade print_offer_box" id="view-offer" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog">
	   <div class="modal-content">
		   <div class="modal-header">
			      <h2>Offer Details: <span id="offertitle"></span></h2> <a href="javascript:void(0);" id="print_deal" class="printlink" style="display: none;"></a> 
			      <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		   </div>
		   <div class="modal-body">
		       <div id="offer_details" class="offer_details_Box"></div> 
		   </div>
	   </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
  </div><!-- /.modal ---->
 
    <div class="modal fade" id="change-image-popup" tabindex="-1" role="dialog" aria-hidden="true">
	   <div class="modal-dialog">
	       <div class="modal-content">
		       <div class="modal-header">
			  Update Profile Picture    <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		       </div>
		       <div class="modal-body">
			   <div class="uploadPhoto"><a href="<?php echo FRONTEND_URL;?>register/updateProfilephoto">Upload Photo</a></div>
			   <div class="takePhoto"><a href="<?php echo FRONTEND_URL;?>register/updateImg">Take Photo</a></div>
			   <br class="spacer"/>
			   <ul>
			    <li><b>For photo Resizing help click the link for your device: Resizing pictures on a Mac or Resizing pictures on a PC</b><br/><br/>
			PC Laptop/Desktop Users:
		    </li><br/>
		    <li><iframe class="popup-iframe" width="100%" height="315" src="https://www.youtube.com/embed/mRu04zt-hnk" frameborder="0" allowfullscreen></iframe></li>
		    <li>Apple Laptop/Desktop Users: </li><br/>
		    <li><iframe class="popup-iframe" width="100%" height="315" src="https://www.youtube.com/embed/YTPXrFCe8cI" frameborder="0" allowfullscreen></iframe></li>
		</ul>	   
			   
			   
		       </div>
	       </div><!-- /.modal-content -->
	   </div><!-- /.modal-dialog -->
  </div><!-- /.modal ---->

  <div  id="view-offer-view" style="display: none;" class="viewOfferPop">
    <div class="viewOfferIn">
      <div class="viewOfferHeader">
      <span class="closeIcon" id="close_offer">X</span>
      <h2>Offer Details: <span id="offertitle2"></span></h2>
      </div>
      <div id="offer_details_view" class="viewOfferContent offer_details_Box"></div>
    </div>  
  </div>

  <div  id="view-flyer-view" style="display: none;" class="viewOfferPop">
    <div class="viewOfferIn">
      <div class="viewOfferHeader">
      <span class="closeIcon" id="close_flyer">X</span>
      <h2>Flyer Details: <span id="flyertitle2"></span></h2>
      </div>
      <div id="flyer_details_view" class="viewOfferContent offer_details_Box"></div>
    </div>  
  </div>
  
   <div id="view-review" style="display: none;" class="viewOfferPop">
    <div class="viewOfferInn">
    <div class="viewOfferHeader">
	<span class="closeIcon" id="close_review">X</span>
	   <h2>Review Details</h2>
    </div>
	   <div id="view_review_details" class="viewOfferContent"></div>
  </div>
   </div>
  
<link href="<?php echo FRONTEND_URL?>js/rating/rateit.css" rel="stylesheet" type="text/css">
<script src="<?php echo FRONTEND_URL?>js/rating/jquery.rateit.js" type="text/javascript"></script>
<!----------------------------Rating and Review-----------------------------------
<div class="flyer_popup_outer" style="display: none;" >
<div class="flyer_popup">
	<h1 id="review_fl_title"></h1>
	
	<p><span class="flyerReview"> Great! You are about to check this <span class="red"> item off your bucket list!</span> </span></p>
	<span class="flyerReview"> How would you rate this on a scale of 1-5 star?</span>
	
	<div id="rateit" class="rateit"  data-rateit-value="0"></div>
	<input type="hidden" id="review_rating">

	
	<span class="flyerReview"> What tips could you provide about your experience?
	<textarea name="experince_tips" id="experince_tips"></textarea>
	
	</span>
	<span class="flyerReview"> What else would you like to tell other TravelDotz members about this experience?
		<textarea name="tell_other_members" id="tell_other_members"></textarea>
	</span>
	<span class="flyerReview err-msg" id="review_err"></span><br>
	<input type="button" value="Submit" class="submit" id="submit_review">
	<input type="button" value="Cancel" class="submit" id="cancel_review">
		
</div>
</div-->
       <div class="modal" id="popupReview"  tabindex="-1" role="dialog" aria-hidden="true">
	     
	 <div class="modal-dialog">
	     <div class="modal-content">
		  <div class="modal-header">
			    <h1 id="review_fl_title"></h1>
			    <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		  </div>
		  <div class="modal-body">
		      <p><span class="flyerReview"> Great! You are about to check this <span class="red"> item off your bucket list!</span> </span></p>
			    <span class="flyerReview"> How would you rate this on a scale of 1-5 star?</span>
			    
			    <div id="rateit" class="rateit"  data-rateit-value="0"></div>
			    <input type="hidden" id="review_rating">
		    
			    
			    <span class="flyerReview"> What tips could you provide about your experience?
			    <textarea name="experince_tips" id="experince_tips"></textarea>
			    
			    </span>
			    <span class="flyerReview"> What else would you like to tell other TravelDotz members about this experience?
				    <textarea name="tell_other_members" id="tell_other_members"></textarea>
			    </span>
			    <span class="flyerReview err-msg" id="review_err"></span><br>
			    <input type="button" value="Submit" class="submit blueBtn" id="submit_review">
			    <input type="button" value="Cancel" class="submit blueBtn" id="cancel_review">
		  </div>
	     </div>
	 </div>
   </div>
<input type="hidden" id="bucket_id">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->nsession->userdata('user_id');?>" />


<!---------------------------------------------------------------------------------------->



<div id="own-flyer-view" style="display: none;" class="viewOfferPop">
    <div class="viewOfferInn">
    <div class="viewOfferHeader">
	<span class="closeIcon" id="close_ownreview">X</span>
	   <h2>Item Details</h2>
    </div>
	   <div id="own_review_details" class="viewOfferContent"></div>
</div>
</div>



<input type="hidden" name="active_deduct_val" id="active_deduct_val" value="0" />
<input type="hidden" name="expired_deduct_val" id="expire_deduct_val" value="0" />
<input type="hidden" name="all_val" id="all_val" value="0" />
<input type="hidden" name="completed_added_val" id="completed_added_val" value="0" />

<input type="hidden" name="completed_total_val" id="completed_total_val" value="<?php echo $totalCompletedSavings;?>"/>
<input type="hidden" name="expired_total_val" id="expired_total_val" value="<?php echo $totalExpireSavings;?>" />
<input type="hidden" name="active_total_val" id="active_total_val" value="<?php echo $totalActiveSavings;?>" />
<input type="hidden" name="all_total_val" id="all_total_val" value="<?php echo $totalSavings;?>" />
<input type="hidden" name="completed_count" id="completed_count" value="<?php echo $cmp_count;?>" />

<script type="text/javascript">
  
$(document).ready(function()
{
  $('.dashListing2').css('display','none');
  $('.invite_list').css('display','none');
	var $scrollbar = $("#scrollbar1");
	$scrollbar.tinyscrollbar();
	
	$('#cmplt_itme').text('<?php echo $cmp_count;?>');
	$('.chk').change(function(){
	      //alert($(":checkbox:checked").length);
	      //alert($('input.chkType').filter(':checked').length);
	      if($('input.chkType').filter(':checked').length == 3)
		  $('input.chkType:not(:checked)').attr('disabled', 'disabled');
	      else
		  $('input.chkType').removeAttr('disabled');
	  });
	
    $(".select-box dt a").on('click', function () {
          $(".select-box dd ul").slideToggle('fast');
      });

      $(".select-box dd ul li a").on('click', function () {
          $(".select-box dd ul").hide();
      });

      function getSelectedValue(id) {
           return $("#" + id).find("dt a span.value").html();
      }
	
      $(document).bind('click', function (e) {
          var $clicked = $(e.target);
          if (!$clicked.parents().hasClass("select-box")) $(".select-box dd ul").hide();
      });
	
	var cnt=0;
      $('.mutliSelect input[type="checkbox"]').on('click', function () {
	//alert(cnt);
	  $(".chk").each(function(){
	    var checked = $(this).prop('checked');
	    
	    if (checked == true) {
	      return false;	      
	    }
	    /*if (!checked) {
	      $(".hida").show();
	      //$(".multiSel").hide();
	    }*/
	  });
	 
	  
          var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
              title = $(this).attr('data-element') + ",";
          if ($(this).is(':checked')) {
	      $(".multiSel").show();
	      cnt=cnt+1;
              //var html = '<span title="' + title + '">' + title + '</span>';
	      if (cnt>0) {
		     var html = '<span>' + cnt + ' Friend(s) showing.</span>';
		     //$('.multiSel').append(html);
		     $('.multiSel').html(html);
		     $(".hida").hide();
	      }
          } 
          else {
              //$('span[title="' + title + '"]').remove();
	      cnt=cnt-1;
	      var html = '<span>' + cnt + ' Friend(s) showing.</span>';
 	      $('.multiSel').html(html);	      
              var ret = $(".hida");
              //$('.select-box dt a').append(ret);
              
          }
	  if(cnt<1){
		     //alert(cnt);
		     $(".hida").show();
		     $('.multiSel').hide();
	      }
      });

      
      
//$(".print_offer_box").find('.print').on('click', function() {
//   $.print(".print_offer_box");
//});

});

  
 $('.vendor_name').click(function(){
    var vendor_name = $(this).attr('title');
    
    if (vendor_name != '') {
      swal({
	title: vendor_name,			  			  
	confirmButtonText: "OK"
      });
     
    }
      

      
  
  }); 
  
  
$('#type_name').change(function(){

$('.actv').trigger('click');

  });  
  
$('#bucket_menu li a').click(function(){

  var type_index = $('#type_name').val();

    var vl = $(this).attr('data-val');
  if (vl!= 'My own item' && vl != 'Invited') {
      
    $('#my_own_page').css('display','none');
    
    $('#invite_list_div').css('display','none');
   $('.btmSaving').css('display','block');
    
    $('.dashListing').css('display','');
    $(this).parent().parent().find('a').removeClass('actv');
    
    $(this).addClass('actv');
    
    $('#dashboard_bucket_list li').not('.invitefrnd_name').hide();
    if (type_index == 0) {
      $('.'+vl).show();
      //$('.'+vl+'.flyer').show();
      //$('.'+vl+'.deal').show();
    }
    else
    {
      if (type_index == 'deal') {	
	$('.'+vl+'.flyer').hide();
	$('.'+vl+'.deal').show();
	
	
	
      }
      else
      {      
       $('.'+vl+'.deal').hide();
       $('.'+vl+'.flyer').show();
       
       
      }
      
      
      
      
    }
    
    if (vl == 'bucketActive') {
     //$('#totalsaved_val').text('$<?php echo $totalActiveSavings;?>');
     var actv_val= $('#active_total_val').val();
     $('#totalsaved_val').text('$'+actv_val);
    }
    if (vl == 'expired') {
      //$('#totalsaved_val').text('$<?php echo $totalExpireSavings;?>');
      var exp_val= $('#expired_total_val').val();
      $('#totalsaved_val').text('$'+exp_val);
    }
    if (vl == 'completed') {
      var completed_val       = $('#completed_total_val').val();
      var expdeduct_val       = $('#expire_deduct_val').val();
      var actvdeduct_val      = $('#active_deduct_val').val();
      var all_deduct_val      = $('#all_val').val();
      var alltotalval = parseFloat(completed_val)+parseFloat(expdeduct_val)+parseFloat(actvdeduct_val)+parseFloat(all_deduct_val);
     //$('#totalsaved_val').text('$<?php echo $totalCompletedSavings;?>');
     $('#totalsaved_val').text('$'+alltotalval);
    }
    
    
    if (vl == 'all') {
     $('#dashboard_bucket_list li').show();
     $('#totalsaved_val').text('$<?php echo $totalSavings;?>');
    }
    
    if ($('#dashboard_bucket_list li').is(':visible')) {
      $('.noRecord').hide();
    }
    else
    {
      $('.noRecord').show();
    }
    
    
    if (type_index == 'deal') {
	if (vl == 'all') {
	   
	    $('.deal').show();
	    $('.flyer').hide();
	  }
      }
      else if (type_index == 'flyer')
      {
	  if (vl == 'all') {
	  
	    $('.deal').hide();
	    $('.flyer').show();
	  }
      }
      else
      {
	if (vl == 'all') {
	  
	    $('.deal').show();
	    $('.flyer').show();
	  }
      }
    
    
  }
  else if (vl == 'Invited') {
    
       $(this).parent().parent().find('a').removeClass('actv');    
       $(this).addClass('actv');  
       $('.dashListing').css('display','none');
       $('#my_own_page').css('display','none');
       $('.btmSaving').css('display','block');
       $('.NoInvite').attr('style','');
       $('#totalsaved_val').text('$<?php echo $totalInvitesavings;?>');
       $('#invite_list_div').css('display','block');
       
        if (type_index == 'deal') {
	
	    $('.deal').show();
	    $('.flyer').hide();
	  
	}
	if (type_index == 'flyer') 
	{
	    
	      $('.deal').hide();
	      $('.flyer').show();
	    
	}
       if (type_index == 0) 
	{
		$('.flyer').show();
		$('.deal').show();
	      
	}
    
  }
  else if(vl == 'My own item')
  {
    $(this).parent().parent().find('a').removeClass('actv');
    $('.scrollbar').height('35px !important');
    $('#scrollbar1 .viewport').height('35px !important');
    $(this).addClass('actv');
    //$('.'+vl).show();
    
    $('.btmSaving').css('display','none');
    if (type_index == 'deal') {
	
	   
	    $('.deal').show();
	    $('.flyer').hide();
	  
      }
      if (type_index == 'flyer') 
      {
	  
	    $('.deal').hide();
	    $('.flyer').show();
	  
      }
     if (type_index == 0) 
    {
	    $('.flyer').show();
	  
    }
    
       $('.dashListing').css('display','none');
        $('#invite_list_div').css('display','none');
	
	$('.dashListing2').css('display','none');
	$('.NoInvite').css('display','none');
	
       $('#my_own_page').css('display','block');
       
  }
  
  //$('.'+type_index).show();
  //
  //if (type_index == 'flyer') {
  //  $('.deal').hide();
  //}
  //else
  //{
  //  $('.flyer').hide();
  //}
  
  
  
});
$(document).on("click",".bucket_delete",function() {
  //$('.bucket_delete').click(function(){
    var id = $(this).attr('data-id');
    
    var element = $(this).attr('data-element');
    var flyer_id = $(this).attr('id');
    
    
    swal({
	title: "Are you sure?",
	text: "You will not be able to recover this !",
	type: "warning",
	showCancelButton: true,
	confirmButtonColor: "#DD6B55",
	confirmButtonText: "Yes, delete it!",
	closeOnConfirm: false
      },
      function(){
	  
	  $.ajax({
	    
	    type:"POST",
	    url:"<?php echo FRONTEND_URL; ?>" + "dashboard/delete_review/",
	    data: {id:id,element:element,flyer_id:flyer_id},
	    success:  function(msg){      
	      
	      $('#main_'+id).remove();
	      $('#own_'+id).remove();
	      $('#ownmap_'+id).css('display','none');
		  swal({
			  title: "",
			  text: "Record  has been deleted successfully.",
			  type: "success",
			  html: true,
			  animation: "slide-from-top",
			  timer: 5000,
			  confirmButtonText: "Close"
		 });
	
	      }
	  });
    });
    });
  
  
  $('.fl').click(function(){
    
      var fl_title = $(this).text();
      $('#review_fl_title').text(fl_title);
      //$('.popupReview').show();
      $('#popupReview').show();
      
      bucket_id = $(this).attr('data-id');
      bucket_type = $(this).attr('data-element');
      $('#bucket_id').val(bucket_id);
      //$('#popupReview').addClass('fade');
   });
  
  $('#cancel_review').click(function(){
      //$('.flyer_popup_outer').hide();
      //$('.popupReview').hide();
      $('#popupReview').hide();
      $('#experince_tips').val('');
      $('#tell_other_members').val('');
      //$('#review_rating').val('');
      
      
    });
  
  $('#submit_review').click(function(){
		  var experince_tips = $('#experince_tips').val();
		  var tell_other_members = $('#tell_other_members').val();
		  var review_rating = $('#review_rating').val();		  
		  
		  var deal_id = $('#deal_id').val();
		  
		  //if (experince_tips == '' || tell_other_members == '' || review_rating == '') {
		  //  $('#review_err').html('All Fields are mandatory');
		  //  return false;
		  //}
		  if (review_rating == '') {
		    $('#review_err').html('Rating is mandatory');
		    return false;
		  }
		  else
		  {
		    $('#review_err').html(''); 
		  }
		  
		  $.ajax({
				  
			  type: "POST",
				  url: "<?php echo FRONTEND_URL; ?>" + "dashboard/add_review/",
				  data: { 'experince_tips': experince_tips,'tell_other_members': tell_other_members,'rating':review_rating,'bucket_id':bucket_id},
				  success: function(msg){
				    
				      if(msg >0)
				      {
						  
						  //$('#submit_review').parent().parent().hide();
						  //$('#success_review').show();
						  //$('.flyer_popup_outer').hide();
						  //$('.popupReview').hide();
						  $('#popupReview').hide();
						  $('#experince_tips').val('');
						  $('#tell_other_members').val('');
						  //$('#completed_'+bucket_id).css('display','list-item');
						   //---------------------------------------//
						  var class_name = $('.actv').attr('data-val');
						  $('#main_'+bucket_id).removeClass(class_name);
						  $('#main_'+bucket_id).removeClass(bucket_type);
						  
						  if (class_name == 'My own item') {
						    //$('#own_'+bucket_id).removeClass(class_name);
						    //$('#own_'+bucket_id).removeClass(bucket_type);
						    //$('#own_'+bucket_id).addClass('completed');
						    //$('#own_'+bucket_id).addClass(bucket_type);
						    
						    var completedFlyerHtml = $('#own_' + bucket_id).addClass('completed').html();
						    $('#own_' + bucket_id).remove();
						    $('#dashboard_bucket_list').append('<li id="main_'+bucket_id+'">'+completedFlyerHtml+'</li>');
						    
						    //$('#own_'+bucket_id).css('display','none');
						    //$("#own_"+bucket_id).attr("id",'main_'+bucket_id);
						    //$('#main_'+bucket_id).css('display','block');
						  }
						  
						  
						  $('#main_'+bucket_id).addClass('completed');
						  $('#main_'+bucket_id).addClass(bucket_type);
						  if (class_name != 'all'){
						    $('#main_'+bucket_id).css('display','none');
						    
						  }
						   var save_val = $('#save_'+bucket_id).text();
						   var res = save_val.split("$");
						   
						  if (class_name == 'expired') {
						    var total_expsavings = $('#expired_total_val').val();
						    var expired_savings = parseFloat(total_expsavings) - parseFloat(res[1]);
						    var exp_single_val = $('#expire_deduct_val').val();
						    var expired_deduct_val = parseFloat(exp_single_val) + parseFloat(res[1]);
						    $('#expire_deduct_val').val(expired_deduct_val);
						    $('#expired_total_val').val(expired_savings);
						    $('#totalsaved_val').text('$'+expired_savings);
						  }
						  
						  if (class_name == 'bucketActive') {
						   var total_activesavings = $('#active_total_val').val();
						   var active_savings = parseFloat(total_activesavings) - parseFloat(res[1]);
						   var actv_single_val = $('#active_deduct_val').val();
						   var active_deduct_val = parseFloat(actv_single_val) + parseFloat(res[1]);
						   $('#active_deduct_val').val(active_deduct_val);
						   $('#active_total_val').val(active_savings);
						   $('#totalsaved_val').text('$'+active_savings);
						  }
						  
						  if (class_name == 'all') {
						   var all_single_val = $('#all_val').val();
						   var all_val = parseFloat(all_single_val) + parseFloat(res[1]);
						   $('#all_val').val(all_val);
						  }
						  
						  var completeditem_cunt = $('#completed_count').val();
						  $('#cmplt_itme').text(completeditem_cunt+++1);
						  var getval =  $('#cmplt_itme').text();
						  $('#completed_count').val(getval);
						  
						  
						  
						  //---------------------------------------//
						  $('#review_'+bucket_id).css('display','none');
						  $('#review_'+bucket_id).parent().html('<a href="javascript:void(0);"><img title="Completed" id="completed_'+bucket_id+'" src="<?php echo FRONTEND_URL;?>images/tick.png" alt="" />');
						  //$('#review_rating').val('');
						  
						  swal({
							  title: "",
							  text: "Your review is successfully submitted!",
							  type: "success",
							  html: true,
							  animation: "slide-from-top",
							  timer: 5000,
							  confirmButtonText: "Close"
						 });
						  
						  //location.reload(); 
						  
				      }
				      else 
				      {
						  //$('#failure_review').show();
						  swal({
							  title: "Error",
							  text: "Your review is not submitted!",
							  type: "error",
							  html: true,
							  animation: "slide-from-top",
							  timer: 5000,
							  confirmButtonText: "Close"
						 });
						  
				      }
				      
				  }
		  });
		  
		  
		  
	$('.view-offer').click(function(){
		//$('#print').hide();
		var offer_id = $(this).attr('data-element');
		$('#view-offer').attr("id","view-offer"+offer_id);
		title = $(this).attr('title');
		$.ajax({			
			 type: "POST",
			 url: FRONT_URL + "home/view_offer/",
			 data: { 'offer_id': offer_id },
			 success: function(msg){
				  $('#offer_details').html(msg);
				  $("#view-offer"+offer_id).attr("id","view-offer");
				  $('#offertitle').html(title);
			 }
		});
	});
	
	
	
	$('.view-flyer').click(function(){
		var flyer_id = $(this).attr('data-element');
		$('#view-flyer').attr("id","view-flyer"+flyer_id);
		title = $(this).attr('title');
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "home/view_flyer/",
			data: { 'flyer_id': flyer_id },
			success: function(msg){
				 $('#flyer_details').html(msg);
				 $("#view-flyer"+flyer_id).attr("id","view-flyer");
				 $('#flyertitle').html(title);
			}
		});
	});		  

		  
  });
  function changePrivacy(bucketId, privacy){
    //alert(privacy);
    $.ajax({			
      type: "POST",
      url: FRONT_URL + "dashboard/ChangePrivacy/",
      data: { 'bucket_id': bucketId, 'privacy': privacy },
      success: function(msg){
	      $('#privacyMsg'+bucketId).show("slow");
	      $('#privacyMsg'+bucketId).html(msg);
	      if (privacy==0 || privacy==2) {
		     $('#invite_option_'+bucketId).hide();
	      }else{
	          $('#invite_option_'+bucketId).show();
	      }
      }
    });
    setTimeout(function(){
        var selectedEffect = 'blind';
        var options = {};
        $(".privacyMsgSetDiv").hide(selectedEffect, options, 500)
     }, 5000);
  }  
 
 
 $(document).on('click','.view-review',function(){
	//alert("aaa");
		var id = $(this).attr('data-element');
		//alert(id);
		$('#view-review').attr("id","view-review"+id);
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "dashboard/view_review/",
			data: { 'id': id },
			success: function(msg){
				 $('#view_review_details').html(msg);
				 //$(this).dblclick();
				 $("#view-review"+id).show();
				 $("#view-review"+id).attr("id","view-review");
			}
		});
	
 });
 
 //!!!< ---------------------------- my own item map ------------------------->
  $(document).on('click','.own-flyer-view',function(){
	
		var own_id = $(this).attr('data-element');
		//alert(own_id);
		$('#own-flyer-view').attr("id","own-flyer-view"+own_id);
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "dashboard/own_flyer/",
			data: { 'own_id': own_id },
			success: function(msg){
				 $('#own_review_details').html(msg);
				
				 $("#own-flyer-view"+own_id).show();
				 $("#own-flyer-view"+own_id).attr("id","own-flyer-view");
			}
		});
	
 });

 $(document).on('click','#close_ownreview',function(){
   
   
   $('#own_review_details').html('');
   $('#own-flyer-view').hide();
   
   
 });
//!!!< ---------------------------- my own item map ------------------------->
$(document).on('click','#close_review',function(){
   
   
   $('#view_review_details').html('');
   $('#view-review').hide();
   
   
 });

$(document).on('click','#close_flyer',function(){
   
   
   $('#flyer_details_view').html('');
   $('#view-flyer-view').hide();
   
   
 });
$(document).on('click','#close_offer',function(){
   
   
   $('#offer_details_view').html('');
   $('#view-offer-view').hide();
   
   
 });


 
	$(document).on('click','.view-offer-view',function(){	
		var offer_id = $(this).attr('data-element');
		$('#view-offer-view').attr("id","view-offer-view"+offer_id);
		title = $(this).attr('title');
		$.ajax({			
			 type: "POST",
			 url: FRONT_URL + "home/view_offer/",
			 data: { 'offer_id': offer_id },
			 //beforeSend:function(){
			 // 
			 // $(this).trigger('click');
			 // },
			 success: function(msg){
				  //$('#offer_details_view').css('z-index',9999);
				  $('#offer_details_view').html(msg);
				  //$(this).dblclick();
				  $("#view-offer-view"+offer_id).show();
				  $("#view-offer-view"+offer_id).attr("id","view-offer-view");
				  $('#offertitle2').html(title);
				  //alert('title');
			 }
		});
	});
	
	
	
	
	$(document).on('click','.view-flyer-view',function(){
		var flyer_id = $(this).attr('data-element');
		$('#view-flyer-view').attr("id","view-flyer-view"+flyer_id);
		title = $(this).attr('title');
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "home/view_flyer/",
			data: { 'flyer_id': flyer_id },
			success: function(msg){
			         //$('#flyer_details_view').css('z-index',9999);
				 $('#flyer_details_view').html(msg);
				 //$(this).dblclick();
				 $("#view-flyer-view"+flyer_id).show();
				 $("#view-flyer-view"+flyer_id).attr("id","view-flyer-view");
				 $('#flyertitle2').html(title);
			}
		});
	});
	
  	//$('.addBucket').click(function(){
	$(document).on('click','.addBucket',function(){
	var deal_flyer_id = $(this).attr('item');
	var type = $(this).attr('data-item');
	var user_id = $('#user_id').val();
	var id = $(this).attr('id');
	if (user_id == '') {
	   //$('.check_user_login').show();				
	   swal({
	       title: "Who are you?",
	       text: "You have to login first as a user to add to bucket!<br><a href=\"<?php echo FRONTEND_URL;?>login\">Click Here</a> to login",
	       //type: "error",
	       imageUrl: '<?php echo FRONTEND_URL; ?>images/qus-icons.png',
	       imageSize:"51x52",
	       html: true,
	       animation: "slide-from-top",
	       timer: 5000,
	       confirmButtonText: "Close"
	   });
	}
	else
	{
		$.ajax({
				
			type: "POST",
				url: "<?php echo FRONTEND_URL; ?>" + "home/add_to_cart/",
				data: { 'deal_flyer_id': deal_flyer_id,'user_id': user_id, 'type':type },
				success: function(msg){
				    if(msg == "exist")
				    {
					       //$('.already_added').show();
					       swal({
							title: "Error!",
							text: "You have already added this Offer/Flyer!",
							type: "error",
							html: true,
							animation: "slide-from-top",
							timer: 5000,
							confirmButtonText: "Close"
					       });
						$('#'+id).hide();
				    }
				    else
				    {
						
						swal({
							title: "",
							text: "Record has been added in the bucket successfully",
							type: "success",
							html: true,
							animation: "slide-from-top",
							timer: 5000,
							confirmButtonText: "Close"
					       });
						
						$('#'+id).hide();
				    }
				    
				}
		});				
	}
});
 //<!-----------my own item---------------------->
function country_chk(str)
{
	var country_id = str;
		$.ajax({
		       type: "POST",
		       url: '<?php echo FRONTEND_URL."state/chkstateExists";?>',
		       data: {country_id: country_id},
		       success:function(data) {
				if (data!= '') {
					$('.stateList').html(data);
				}
		       }	
			});

}

 var ret = '';
  $(function() {
 
    $("#own_form").validate({
   

        // Specify the validation rules
        rules: {

           item_name		: "required",
	   //address		: "required",
	   country		: "required",
	   city			: "required",
	   state		: "required",
//	   zip:
//	   {
//	    required: true,
//	    number: true 
//           },
	  privacy : "required",
        },
        
       
        messages: {
	   
	    item_name		:  "Please enter Item Name",
	    //address 		: "Please enter address",
	    country		: "Please select a country",
	    city		: "Please enter city name",
	    state		: "Please enter state name",
	//    zip: {
	//	  required	: "Please enter Zip code",
	//	  number	: "Zip must be in numbers"
	//    },
	    privacy : "Please select who can see your bucket list"
        },
        
        submitHandler: function(form) {
	 
		var item_name    = $("#item_name").val();
		var address      = $("#address").val();
		var country      = $("#country").val();
		var city         = $("#city").val();
		var state        = $("#state").val();
		var zip          = $("#zip").val();
		var descptn      = $("#descptn").val();
		var privacy      = $("#privacy").val();
		$.ajax({			
			 type: "POST",
			 url: FRONT_URL + "dashboard/addmy_own_item/",
			 data: { 'item_name': item_name, 'address': address, 'country': country, 'city': city, 'state': state, 'zip': zip, 'descptn': descptn, 'privacy': privacy},
			
			 success: function(value){
				  var markers = [];
				  var value1 = $.parseJSON(value);
				  if (value1['msg'] == 'true') {
				   $('#my_item').find('.close').trigger('click');
				   swal({
							  title: "Success!",
							  text: "Your item added successfully!",
							  type: "success",
							  html: true,
							  animation: "slide-from-top",
							  timer: 5000,
							  confirmButtonText: "Close"
						 });
				   $('.noRecordOwn').hide();
				   
				   $("#item_name").val('');
				   $("#address").val('');
				   $("#country").val('');
				   $("#city").val('');
				   $("#state").val('');
				   $("#zip").val('');
				   $("#descptn").val('');
				   $("#privacy").val('');
				   
				   
				   
				   
				   
				    $("#own_item").append('<li id="own_'+value1["bucket_id"]+'"><div class="listUp"><div class="listLeft"><a href="javascript:void(0);" data-toggle="modal" class="own-flyer" data-element="'+value1["offer_flyer_id"]+'" data-target="#own-flyer"><p>'+item_name+'</p></a></div><div class="listRight"><p></p><div class="listIcons"><span><a href="javascript:void(0);" title="Delete" class="bucket_delete" data-id='+value1["bucket_id"]+' id="'+value1["offer_flyer_id"]+'" data-element="Own"><img src="<?php echo FRONTEND_URL;?>images/close.png" alt="" /></a></span></div></div></div><div class="listDown"><div class="listLeft"></div><div id="privacyMsg" class="listRight privacyMsgSetDiv"></div></div></li>');
				    
	      var details = '';
	      var own_result = '';
	      if(value1['deal_flyer_type'] == 'flyer')
	      {
		details = 'Item Details';
		own_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="own-flyer-view" data-element="'+value1["offer_flyer_id"]+'" data-target="#own-flyer-view'+value1["offer_flyer_id"]+'">'+details+'</a></span>';
	      }	
				           marker = new RichMarker({
				
					    center: new google.maps.LatLng(value1['latitude'],value1['longitude']),
					    position: new google.maps.LatLng(value1['latitude'],value1['longitude'] ),
					    map: map,
					    draggable: false,
					    
					    content: '<div class="map-bg" id="ownmap_'+value1["bucket_id"]+'" onclick="ownpopUpshow('+value1["bucket_id"]+');"><img class="shw" src="'+value1['profile_image']+'" style="height:40px;width:40px;border-radius:50%;"/></div><div class="owninfo_'+value1["bucket_id"]+' map-info" id="'+value1["bucket_id"]+'" style="display:none;"><strong>'+value1["title"]+'</strong>'+own_result+'<br>'+value1["address"]+'<span class="close" id="'+value1["bucket_id"]+'" onclick="popUpclose('+value1["bucket_id"]+');"></span></div>',
					   });
					    markers.push(marker);
				  }
				  else if (value1['msg'] == 'false') {
				    $('#my_item').find('.close').trigger('click');
				    swal({
							title: "Error!",
							text: "Can not add own item!",
							type: "error",
							html: true,
							animation: "slide-from-top",
							timer: 5000,
							confirmButtonText: "Close"
					       });
				    
				            
					    
				  }
			 }
		});
	 
        }
    });

  });


//$('.own-flyer').click(function(){
  $(document).on("click",".own-flyer",function() {
	    
		var own_id = $(this).attr('data-element');
		
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "dashboard/own_flyer/",
			data: { 'own_id': own_id },
			success: function(msg){
				 $('#own_details').html(msg);				 
				
			}
		});
	});
 ///<--------------- my own item ------------------------->///
 
 
 ///$('.invite_hide').click(function(){
$(document).on('click','.invite_hide',function(){
       $(this).parent().next(".invite_list").children('.inviteMutliSelect').find('li').css('display','block');
       $(this).parent().next(".invite_list").toggle('slow');       
});
 
 //$('.invite_check').click(function(){
$(document).on("click",".invite_check",function() {
       /**********Confirm Before Sending Request******/
       var frnd_bucket_id = $(this).attr('id').split('_');
       var txt;
       var add_remove	  = 0;
       if ($(this).prop('checked')==true)
	      add_remove	=	1;
       else
	      add_remove	=	0;
       if(add_remove==1){		     
       var r = confirm("Are you sure you wish to invite "+frnd_bucket_id[2]+" to participate in "+frnd_bucket_id[3]+" ?");
       }else if(add_remove==0){
	      var r = confirm("Are you sure you wish to delete "+frnd_bucket_id[2]+" from invitation of "+frnd_bucket_id[3]+" ?");
       }
       if (r == true) {	
	      $.ajax({		
		     type: "POST",
		     url: "<?php echo FRONTEND_URL; ?>" + "dashboard/invite",
		     data: { 'user_id': frnd_bucket_id[0],'bucket_id': frnd_bucket_id[1],'add_remove':add_remove},
		     success: function(data)
		     {
			    if (add_remove ==1)
			    {
				   $('.inviteAction_'+frnd_bucket_id[1]).css('color','green');
				   $('.inviteAction_'+frnd_bucket_id[1]).html('Invitaion Sent');
			    }
			    else
			    {
				   $('.inviteAction_'+frnd_bucket_id[1]).css('color','red');
				   $('.inviteAction_'+frnd_bucket_id[1]).html('Invitaion Deleted');
			    }
			    
			    setTimeout(function(){
				    $('.inviteAction_'+frnd_bucket_id[1]).html('');
			  }, 2000);
		     }
	      });
       }else{
	       if ($(this).prop('checked')==true){
		      $(this).prop('checked', false);
	       }else{
		   $(this).prop('checked', true);  
	       }
	      //alert(add_remove);
	      //location.reload();
	      /*if(add_remove == 1){
		     $(this).prop('checked', true);
	      }else if (add_remove == 0) {
		    $(this).prop('checked', false);
	      }*/
       }
});
 
 $('.accept_invite,.decline_invite').click(function(){
       var accpt_dec = 0;
       if($(this).attr('value') == 'Accept')
	      accpt_dec = 1;
	      
       var invite_id = $(this).attr('data-element');
       $.ajax({		
	      type: "POST",
	      url: "<?php echo FRONTEND_URL; ?>" + "dashboard/accept_invite",
	      data: { 'invite_id': invite_id,'accpt_dec':accpt_dec},
	      success: function(data){
		     $('#invite_'+data).remove();
		     
		     if(accpt_dec == 1)
		     {
			    $('.acceptDecline').css('color','green');
			    $('.acceptDecline').html('Invitaion Accepted');		     
		     }
		     else
		     {
			    $('.acceptDecline').css('color','red');
			    $('.acceptDecline').html('Invitaion Declined');		
		     }		     
		     if($('#invite_list_div ul li').length == 0)
		     {
			    $('.invited').html('Invited');
			    $('#invite_list_div ul').html("<li>No invitation found</li>");
		     }
		     else
		     {
			    $('.invited').html('Invited ( '+$('#invite_list_div ul li').length+' invites pending )');
		     }
		     setTimeout(function(){
			     $('.acceptDecline').html('');
		   }, 2000);
	      }
       });       
 });
</script>

<script type="text/javascript">
$(function () {
    $("#print_deal").click(function () {

       //$('.video_row').hide();
       //$('.close').hide();
       //$('#print_deal').hide();
        var contents = $(".print_offer_box").html();
	//contents = $(contents).find('.video_row').remove().end();
	
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
	frameDoc.document.write('<html><head><title></title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="<?php echo FRONTEND_URL?>css/style.css" rel="stylesheet" type="text/css" />');
	frameDoc.document.write('<link href="<?php echo FRONTEND_URL?>css/printdetails.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });
    
    $("#print_flyer").click(function () {
        //$('.video_row').hide();
        //$('#print_flyer').hide();
        var contents = $(".print_flyer_box").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        //frameDoc.document.write('<html><head><title>DIV Contents</title>');
	frameDoc.document.write('<html><head><title></title>');
        frameDoc.document.write('</head><body>');
        //Append the external CSS file.
        frameDoc.document.write('<link href="<?php echo FRONTEND_URL?>css/style.css" rel="stylesheet" type="text/css" />');
	frameDoc.document.write('<link href="<?php echo FRONTEND_URL?>css/printdetails.css" rel="stylesheet" type="text/css" />');
        //Append the DIV contents.
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);
    });    
});
</script>