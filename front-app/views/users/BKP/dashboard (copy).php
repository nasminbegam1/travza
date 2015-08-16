<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script>
  window.onload=function initialize() {
    var mapOptions = {
      zoom: 129,
      center: new google.maps.LatLng(23.0171240, 72.5330533),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      streetViewControl: false
    }
    map = new google.maps.Map(document.getElementById("map"), mapOptions);

      marker = new google.maps.Marker({
	position: new google.maps.LatLng(23.0171240, 72.5330533),
	map: map
       });

    
    marker = new google.maps.Marker({
	position: new google.maps.LatLng(23.1, 72.6),
	map: map
       });
      
    google.maps.event.trigger(map, 'resize');

  }

</script>
    <div class="content">
      <div class="dashProfile">
	<?php if(isset($succmsg) && $succmsg != '' ){ ?>
	    <div class="alert success-msg display-show" align="center">
	      <p><?php echo stripslashes($succmsg);?></p>
	    </div>			    
      <?php } ?>
        <div class="dashProLeft">
          <div class="profileImg">
	    <?php
	      if(isset($user_details->profile_image) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$user_details->profile_image) && $user_details->profile_image !=''){
		    $profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$user_details->profile_image;
	      ?>
	      <img src="<?php echo $profile_image?>" alt="<?php echo $user_details->profile_image;?>">
	      <?php
	      }else{
		    $profile_image = IMAGE_UPLOAD_URL."no-profile-image.png";
	      ?>
	      <img src="<?php echo $profile_image?>" alt="no_img.png">
	      <?php
	      }
	    ?>
	  </div>
          <div class="profileInfo">
            <h2><?php echo stripslashes($user_details->first_name).' '.stripslashes($user_details->last_name);?></h2>
            <p>
	    <?php
	    if($user_details->city != ''){echo stripslashes($user_details->city).', ';}
	    if($user_details->state != ''){echo stripslashes($user_details->state);}
	    ?></p>
            <p>Traveler Type : <?php if($user_details->type_name != ''){echo stripslashes($user_details->type_name);}else{echo 'N/A';}?></p>
          </div>
        </div>
        <div class="dashProRight"> <a href="<?php echo FRONTEND_URL."register/updateProfile/";?>" class="blueBtn">Edit my Profile</a> </div>
        <br class="spacer"/>
      </div>
      <div class="dashBan" id="map" style="height: 400px;width: 700px;">  </div>
      <div class="dashBucket"> <span class="round"><img src="<?php echo FRONTEND_URL; ?>images/bucket.jpg" alt="" /></span>
        <h2> BUCKET LIST </h2>
        <a href="#">(3 items completed ! You are in 4th Place among your <span>friends</span>)</a> 
        
              <div class="dashOption">
                  <ul id="bucket_menu">
		    <li><a href="javascript:void(0);" data-val="all">All</a></li>
                    <li><a href="javascript:void(0);" data-val="bucketActive">Active</a></li>
                    <li><a href="javascript:void(0);" data-val="expired">Expired </a></li>
                    <li><a href="javascript:void(0);" data-val="completed" >Completed </a></li>
                    
                  </ul>
              </div>

      </div>
      
      
      
      <div class="dashboard">
        <div id="scrollbar1">
          <div class="scrollbar">
            <div class="track">
              <div class="thumb">
                <div class="end"></div>
              </div>
            </div>
          </div>
          <div class="viewport">
            <div class="overview">
              <div class="dashListing">
              	<ul id="dashboard_bucket_list">
		  
		  <?php
		    if(is_array($bucketInfo)) {
		    foreach($bucketInfo as $bucket){
		    ?>
                    <li class="<?php echo ($bucket['expired'] == 'Yes')?'expired':"bucket".$bucket['status'];?>">
                    	<div class="listUp">
                        	<div class="listLeft">
                        		<p><?php echo $bucket['title'];?></p>
                            </div>
                            <div class="listRight">
                            	<p><a href="#">Vendor Profile</a></p>
                                <div class="listIcons">
                                <span><a href="#"><img src="<?php echo FRONTEND_URL;?>images/man2.png" alt="" /></a></span>
                                <span><a href="#"><img src="<?php echo FRONTEND_URL;?>images/close.png" alt="" /></a></span>
                                <span><a href="#"><img src="<?php echo FRONTEND_URL;?>images/tick.png" alt="" /></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="listDown">
                        	<div class="listLeft">
                        		<p>on bucket list of <?php echo $bucket['otherpeople_count'];?> other people</p>
                            </div>
                            <!--<div class="listRight">
                            	<a href="">Offer Expired!  <span>See Other Vendor Offers</span></a>
                            </div>-->
                        </div>
                    </li>
		    <?php } } ?>
		    <li class="noRecord" style="display: none;">No Record Found </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
<script type="text/javascript">
$(document).ready(function()
{
	var $scrollbar = $("#scrollbar1");
	$scrollbar.tinyscrollbar();
  });

  
$('#bucket_menu li a').click(function(){

  var vl = $(this).attr('data-val');
  
  $('#dashboard_bucket_list li').hide();
  $('.'+vl).show();
  
  if (vl == 'all') {
   $('#dashboard_bucket_list li').show();
  }
  
  if ($('#dashboard_bucket_list li').is(':visible')) {
    $('.noRecord').hide();
  }
  else
  {
    $('.noRecord').show();
  }

  });  
  
</script>    
