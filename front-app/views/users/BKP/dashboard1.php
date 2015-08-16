<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!--<script type="text/javascript" src="<?php //echo FRONTEND_URL.'js/';?>jquery.gomap-1.3.3.min.js"></script>-->
<script type="text/javascript" src="<?php echo FRONTEND_URL.'js/';?>richmarker.js"></script>
<script type="text/javascript" src="<?php echo FRONTEND_URL.'js/';?>StyledMarker.js"></script>

<script>
   function popUpshow(id)
  {
      alert(id);
      $('#'+id).show();
  }
  var lat_arr	=	$.parseJSON(<?php print json_encode(json_encode( $friend_lat_arr)); ?>);
  var long_arr	=	$.parseJSON(<?php print json_encode(json_encode( $friend_long_arr)); ?>);
      
  
</script>

<?php //pr($friend_lat_arr);?>
    
<!--    <script type="text/javascript">
      var script = '<script type="text/javascript" src="richmarker';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '-compiled';
      }
      script += '.js"><' + '/script>';
      document.write(script);
    </script>-->


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
	  ?>
        marker = new RichMarker({
	 
	position: new google.maps.LatLng('<?php  echo $friend_lat_arr[$k];?>', '<?php echo $friend_long_arr[$k];?>'),
          map: map,
          draggable: false,
	  id: '<?php echo $fl['friend_id']."_".$fl['bucket_id'];?>',
          content: '<?php if(isset($user_profile[0]['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$user_profile[0]['profile_image']) && $user_profile[0]['profile_image'] !=''){?><img class="shw-img" onclick="popUpshow(<?php echo $fl['bucket_id']?>);" src="<?php echo IMAGE_UPLOAD_URL."siteuser/thumb/".$fl['profile_image'] ?>" style="height:20px;width:20px;"/><?php }?><div  id="<?php echo $fl['bucket_id'] ?>" style="display:none;"><?php echo "<strong>".stripslashes($fl['title'])."</strong><br>".stripslashes($fl['address']);?></div>',

          });
	  
        <?php
	      }
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
      

    </script>

<?php //pr($friend_list);?>

<?php //pr($friend_bucket_id);//pr($friend_list); //pr($friend_lat_arr,0); pr($friend_long_arr); // bd631e5d6146582695ef6643e004a55a ?>


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
		    $profile_image = FRONTEND_URL."images/no-profile-image.png";
	      ?>
	      <img src="<?php echo $profile_image?>" alt="no_img.png">
	      <?php
	      }
	    ?>
	  </div>
	  
	  <div class="frnd_list">
	    <a href="<?php echo FRONTEND_URL."friendlist";?>">Add More Friends</a>
	    <br/>
	    <?php
	    //print_r($pendingFriendRq);
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
	  
	  
	  <?php
	  //print_r($friend);
	  ?>
	  
	    <div class="selectBox discountType">
              <dl class="select-box">
                <dt> <a href="javascript:void(0);"> <span class="hida">Select Friends</span>
                  <p class="multiSel"></p>
                  </a> </dt> 
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
                                   <input type="checkbox" class="chk" name="type[]" data-fl-id="<?php echo $fl_id;?>" data-element="<?php echo stripslashes($fr['first_name'])." ".stripslashes($fr['last_name']); ?>" value="<?php echo $fr['user_id'];?>" />
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

	  <!--<div class="frnd_list"><a href="<?php// echo FRONTEND_URL."friendlist";?>">More Friend</a></div>-->
	  
        </div>
        <div class="dashProRight"> <!--<a href="<?php //echo FRONTEND_URL."register/updateProfile/";?>" class="blueBtn">Edit my Profile</a>--> </div>
        <br class="spacer"/>
      </div>
      <div class="dashBan" id="map" style="height: 400px;width: 1000px;">  </div>
      <div class="dashBucket"> <span class="round"><img src="<?php echo FRONTEND_URL; ?>images/bucket.jpg" alt="" /></span>
        <h2> BUCKET LIST </h2>
        <a href="<?php echo FRONTEND_URL; ?>friendlist">(<label id="cmplt_itme"></label> items completed ! You are in 4th Place among your <span>friends</span>)</a> 
        <div class="frnd_list">
	  <a href="<?php echo FRONTEND_URL; ?>flyer/offer_flyer_list"><span class="moreofferflyers">See More Offers and Flyers!</span></a>
	</div>
              <div class="dashOption">
                  <ul id="bucket_menu">
		    <li><a href="javascript:void(0);" data-val="all" class="actv">All</a></li>
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
		  //pr($bucketInfo);
		  $cmp_count = 0;
		    if(is_array($bucketInfo)) {
		    foreach($bucketInfo as $bucket){
		    
		    ?>
                    <li class="<?php
		    if($bucket['bucket_status'] == 'Completed'){
		     echo "completed";} else { 
		    echo ($bucket['expired'] == 'Yes')?'expired':"bucket".$bucket['status'];}?>"
		    id="main_<?php echo $bucket['bucket_id'];?>" <?php if($bucket['privacy']=='0' && $bucket['user_id']!=$this->nsession->userdata('user_id')){?> style="display:none;" <?php }?> >
                    	<div class="listUp">
                        	<div class="listLeft">
				  
				  <?php if($bucket['bucket_status'] == 'Completed'){?>
                        		<p><?php echo $bucket['title'];?></p>
				  <?php } else { ?>
				  <p><a href="javascript:void(0);" class="fl" data-id = "<?php echo $bucket['bucket_id'];?>"><?php echo $bucket['title'];?></a></p>
				  <?php }?>
				
                            </div>
                            <div class="listRight">
                            	<p>
				  <!--<a href="javascript:void(0);" class="vendor_name" title="<?php echo $bucket['vendor_name'];?>">Vendor Profile</a>-->
				<a href="javascript:void(0);" data-toggle="modal" class="view-vendor-profile" data-element="<?php echo $bucket['vendor_id'];?>" data-target="#view-vendor-profile<?php echo $bucket['vendor_id'];?>">Vendor Profile</a>
				
				</p> 
                                <div class="listIcons">
				<?php if($bucket['type']=='flyer'){ ?>
				  <span><a href="javascript:void(0);" data-toggle="modal" class="view-flyer" data-element="<?php echo $bucket['deal_flyer_id'];?>" data-target="#view-flyer<?php echo $bucket['deal_flyer_id'];?>"><img src="<?php echo FRONTEND_URL;?>images/zoom-icons.png" alt="" /></a></span>
				<?php }else{ ?>
				<span><a href="javascript:void(0);" data-toggle="modal" class="view-offer" data-element="<?php echo $bucket['deal_flyer_id'];?>" data-target="#view-offer<?php echo $bucket['deal_flyer_id'];?>"><img src="<?php echo FRONTEND_URL;?>images/zoom-icons.png" alt="" /></a></span>
				<?php }?>
                                
                                <span><a href="javascript:void(0);" title="Delete" class="bucket_delete" data-id="<?php echo $bucket['bucket_id'];?>"><img src="<?php echo FRONTEND_URL;?>images/close.png" alt="" /></a></span>
				
				<?php
				    if($bucket['bucket_status'] == 'Completed'){
				    $cmp_count++;
				  ?>
                                <span><a href="javascript:void(0);"><img title="Completed" src="<?php echo FRONTEND_URL;?>images/tick.png" alt="" /></a></span>
				<?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="listDown">
                        	<div class="listLeft">
                        		<p>on bucket list of <?php echo $bucket['otherpeople_count'];?> other people</p>
					<div>
					  <select onchange="changePrivacy(<?php echo $bucket['bucket_id'];?>, this.value);">
					    <option value="0" <?php if($bucket['privacy']=='0'){?> selected="selected" <?php } ?> >Private</option>
					    <option value="1" <?php if($bucket['privacy']=='1'){?> selected="selected" <?php } ?> >Friends Only</option>
					    <option value="2" <?php if($bucket['privacy']=='2'){?> selected="selected" <?php } ?> >Public</option>
					  </select>
					</div>
                            </div>
				<div id="privacyMsg<?php echo $bucket['bucket_id'];?>" class="listRight privacyMsgSetDiv"></div>
                            <!--<div class="listRight">
                            	<a href="">Offer Expired!  <span>See Other Vendor Offers</span></a>
                            </div>-->
                        </div>
                    </li>
		    <?php } } else echo "<li>No Record Found </li>"; ?>
		    <li class="noRecord" style="display: none;">No Record Found </li>
                </ul>
              </div>
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


  <div class="modal fade" id="view-flyer" tabindex="-1" role="dialog" aria-hidden="true">
	 <div class="modal-dialog">
	     <div class="modal-content">
		  <div class="modal-header">
			   <h2>Flyer Details</h2>
			   <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		  </div>
		  <div class="modal-body">
		      <div id="flyer_details" class="offer_details_Box"></div> 
		  </div>
	     </div>
	 </div>
   </div>

  <div class="modal fade" id="view-offer" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog">
	   <div class="modal-content">
		   <div class="modal-header">
			      <h2>Offer Details</h2>
			      <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		   </div>
		   <div class="modal-body">
		       <div id="offer_details" class="offer_details_Box"></div> 
		   </div>
	   </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
  </div><!-- /.modal ---->

<link href="<?php echo FRONTEND_URL?>js/rating/rateit.css" rel="stylesheet" type="text/css">
<script src="<?php echo FRONTEND_URL?>js/rating/jquery.rateit.js" type="text/javascript"></script>

<div class="flyer_popup_outer" style="display: none;" >
<div class="flyer_popup">
	<h1 id="review_fl_title"></h1>
	<p><span class="flyerReview"> Great you have check this <span class="red"> item of your bucket list!</span> </span></p>
	<span class="flyerReview"> How would you rate this on a scale of 1-5 star?</span>
	
	<div id="rateit" class="rateit"  data-rateit-value="0"></div>
	<input type="hidden" id="review_rating">

	
	<span class="flyerReview"> What tips could you provide about your experience?
	<textarea name="experince_tips" id="experince_tips"></textarea>
	
	</span>
	<span class="flyerReview"> What else would you like to tell other TravelDotz member about this experience?
		<textarea name="tell_other_members" id="tell_other_members"></textarea>
	</span>
	<span class="flyerReview err-msg" id="review_err"></span><br>
	<input type="button" value="Submit" class="submit" id="submit_review">
	<input type="button" value="Cancel" class="submit" id="cancel_review">
		
</div>
</div>
<input type="hidden" id="bucket_id">
    
<script type="text/javascript">
$(document).ready(function()
{
 
 
	var $scrollbar = $("#scrollbar1");
	$scrollbar.tinyscrollbar();
	$('#cmplt_itme').text('<?php echo $cmp_count;?>');
	
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
	
	
      $('.mutliSelect input[type="checkbox"]').on('click', function () {
	
	  $(".chk").each(function(){
	    var checked = $(this).prop('checked');
	    if (checked == true) {
	      return false;
	    }
	    if (!checked) {
	      $(".hida").show();
	    }
	  });
          var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
              title = $(this).attr('data-element') + ",";
          if ($(this).is(':checked')) {
              var html = '<span title="' + title + '">' + title + '</span>';
              $('.multiSel').append(html);
              $(".hida").hide();
          } 
          else {
              $('span[title="' + title + '"]').remove();
              var ret = $(".hida");
              $('.select-box dt a').append(ret);
              
          }
      });


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
  
$('#bucket_menu li a').click(function(){

    var vl = $(this).attr('data-val');
    
    $(this).parent().parent().find('a').removeClass('actv');
    
    $(this).addClass('actv');
    
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

  $('.bucket_delete').click(function(){
    var id = $(this).attr('data-id');
    
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
	    data: {id:id},
	    success:  function(msg){      
	      
	      $('#main_'+id).remove();	      
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
      $('.flyer_popup_outer').show();
      bucket_id = $(this).attr('data-id');
      $('#bucket_id').val(bucket_id);
  
   });
  
  $('#cancel_review').click(function(){
      $('.flyer_popup_outer').hide();
      
      $('#experince_tips').val('');
      $('#tell_other_members').val('');
      //$('#review_rating').val('');
      
      
    });
  
  $('#submit_review').click(function(){
		  var experince_tips = $('#experince_tips').val();
		  var tell_other_members = $('#tell_other_members').val();
		  var review_rating = $('#review_rating').val();		  
		  
		  var deal_id = $('#deal_id').val();
		  
		  if (experince_tips == '' || tell_other_members == '' || review_rating == '') {
		    $('#review_err').html('All Fields are mandatory');
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
						  $('.flyer_popup_outer').hide();
						  $('#experince_tips').val('');
						  $('#tell_other_members').val('');
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
		
		var offer_id = $(this).attr('data-element');
		$('#view-offer').attr("id","view-offer"+offer_id);
		$.ajax({			
			 type: "POST",
			 url: FRONT_URL + "home/view_offer/",
			 data: { 'offer_id': offer_id },
			 success: function(msg){
				  $('#offer_details').html(msg);
				  $("#view-offer"+offer_id).attr("id","view-offer");
			 }
		});
	});
	
	
	
	$('.view-flyer').click(function(){
		var flyer_id = $(this).attr('data-element');
		$('#view-flyer').attr("id","view-flyer"+flyer_id);
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "home/view_flyer/",
			data: { 'flyer_id': flyer_id },
			success: function(msg){
				 $('#flyer_details').html(msg);
				 $("#view-flyer"+flyer_id).attr("id","view-flyer");
			}
		});
	});		  

		  
  });
  function changePrivacy(bucketId, privacy){
    //alert(privacy);
    $.ajax({			
      type: "POST",
      url: FRONT_URL + "dashboard1/ChangePrivacy/",
      data: { 'bucket_id': bucketId, 'privacy': privacy },
      success: function(msg){
	       $('#privacyMsg'+bucketId).html(msg);
	       
      }
    });
    setTimeout(function(){
        var selectedEffect = 'blind';
        var options = {};
        $(".privacyMsgSetDiv").hide(selectedEffect, options, 500)
     }, 5000);
  }
 
</script>    
