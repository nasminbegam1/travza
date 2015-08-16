<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!--<script type="text/javascript" src="<?php //echo FRONTEND_URL.'js/';?>jquery.gomap-1.3.3.min.js"></script>-->
<script type="text/javascript" src="<?php echo FRONTEND_URL.'js/';?>richmarker.js"></script>
<script type="text/javascript" src="<?php echo FRONTEND_URL.'js/';?>StyledMarker.js"></script>


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
    $('#'+id).show();
  }
  function popUpclose(id)
  {
    $('#'+id).hide();
  }
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
      function init(latitude, longitude, zoomer, clicked) {
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
	<?php 
	if(!empty($bucketlist))
	{
	  foreach($bucketlist as $k=>$ol)
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
       <?php
	//pr($bucketInfo);
	if(!empty($bucketInfo))
	{
	  foreach($bucketInfo as $k=>$ol)
	  {
	    if($bucket_lat_arr[$k]!=0 && $bucket_long_arr !=0)
	    {
	      if($ol['deal_flyer_type'] == 'deal')
	      {
		$details = 'Offer Details';
		$view_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="view-offer-view" data-element="'.$ol["deal_flyer_id"].'" data-target="#view-offer-view'.$ol["deal_flyer_id"].'">'.$details.'</a></span>';
	      }
	      elseif($ol['deal_flyer_type'] == 'flyer')
	      {
		$details = 'Flyer Details';
		$view_result = ' | <span><a href="javascript:void(0);" data-toggle="modal" class="view-flyer-view" data-element="'.$ol["deal_flyer_id"].'" data-target="#view-flyer-view'.$ol['deal_flyer_id'].'">'.$details.'</a></span>';
	      }

	  ?>
	     marker = new RichMarker({
	 
position: new google.maps.LatLng('<?php  echo $bucket_lat_arr[$k];?>', '<?php echo $bucket_long_arr[$k];?>'),
map: map,
draggable: false,
id: '<?php echo $ol['bucket_id'];?>',
content: '<div class="map-bg" id="ownmap_<?php echo $ol['bucket_id'];?>" onclick="ownpopUpshow(<?php echo $ol['bucket_id']?>);"><img class="shw"  src="<?php echo $profile_image ?>" style="height:40px;width:40px; border-radius:50%;"/></div><div class="owninfo_<?php echo $ol['bucket_id']; ?> map-info" id="<?php echo $ol['bucket_id'] ?>" style="display:none;"><strong><?php echo stripslashes($ol['title']);?></strong><?php echo $view_result;?><br><span class="close" id="<?php echo $ol['bucket_id'] ?>" onclick="popUpclose(<?php echo $ol['bucket_id']?>);"></span></div>',

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
          
    </script>

    <div class="content">
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
	  <div class="frnd_list">
	      
	    <a href="<?php echo FRONTEND_URL."friend-bucketlist/".$user_id;?>" class="blueBtn">Grid view</a>
	  
	  </div>
	  
        </div>
      </div>
      
      <div class="dashBan" id="map" style="height: 400px;width: 100%;">  </div>
      <div class="dashBucket"> <span class="round"><img src="<?php echo FRONTEND_URL; ?>images/bucket.jpg" alt="" /></span>
        <h2> BUCKET LIST </h2>
              <div class="dashOption dashTop">
                  <ul id="bucket_menu">
                    <li><a href="javascript:void(0);" data-val="bucketActive" class="actv">Active</a></li>
                    <li><a href="javascript:void(0);" data-val="completed" >Completed </a></li>
		    <li><a href="javascript:void(0);" data-val="My own item" >Friend's Dream List </a></li>
                   
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
		  $cmp_count = 0;
		  $totalSavings = 0;
		  $totalCompletedSavings =0;
		  $totalExpireSavings=0;
		  $totalActiveSavings=0;
		    if(is_array($bucketInfo)) {
		    foreach($bucketInfo as $bucket){

		      
		    ?>
                    <li class="<?php
		    if($bucket['bucket_status'] == 'Completed'){
		     echo "completed";} else { 
		    echo ($bucket['expired'] == 'Yes')?'expired':"bucket".$bucket['status'];}?> <?php echo $bucket['type'];?>" data-type="<?php echo $bucket['type'];?>"
		    id="main_<?php echo $bucket['bucket_id'];?>" >
                    	<div class="listUp">
                        	<div class="listLeft">
				   
				   <?php if($bucket['type']=='flyer'){ ?>
				   <a href="javascript:void(0);" onclick='show_bucket_map("<?php echo $bucket['deal_flyer_id'];?>","<?php echo $bucket['type'];?>");' data-toggle="modal" class="view-flyer viewOfferLt" data-element="<?php echo $bucket['deal_flyer_id'];?>" data-target="#view-flyer<?php echo $bucket['deal_flyer_id'];?>">
					  <span><?php echo $bucket['title'];?></span>
				   </a>
				   <?php }else{ ?>
				   <a href="javascript:void(0);" onclick='show_bucket_map("<?php echo $bucket['deal_flyer_id'];?>","<?php echo $bucket['type'];?>");' data-toggle="modal" class="view-offer viewOfferLt" data-element="<?php echo $bucket['deal_flyer_id'];?>" data-target="#view-offer<?php echo $bucket['deal_flyer_id'];?>">
					  <span><?php echo $bucket['title'];?></span>
				   </a>
				<?php }?>
                            </div>
                        </div>
                        <div class="listDown">
				   <div class="listLeft">
                        		<p>on bucket list of <?php echo $bucket['otherpeople_count'];?> other people</p>
				   </div>
                        </div>
                    </li>
		    <?php } } else {//echo "<li>No Record Found </li>"; ?>
		    <li class="noRecord">No Record Found </li>
		    <?php } ?>
                </ul>
              </div>
	      
	      <!--------------------my own list------------------------------>
	      
	     <div id="my_own_page" class="dashListing2">
	      <ul id="own_item">
		<?php
		    if(is_array($bucketlist)) {
		    foreach($bucketlist as $ownbucket){
		    ?>
		<li id="own_<?php echo $ownbucket['bucket_id'];?>" class="<?php echo $ownbucket['type'];?>">
		  <div class="listUp">
		     <div class="listLeft">
       <a href="javascript:void(0);" data-toggle="modal" class="own-flyer viewOfferLt" data-element="<?php echo $ownbucket['deal_flyer_id'];?>" data-target="#own-flyer"><span><?php echo $ownbucket['flyer_title']; ?></span></a>
		     </div>
		  </div>
	      <div class="listDown">
                <div class="listLeft">
                    <p>on bucket list of <?php echo $ownbucket['otherpeople_count'];?> other people</p>
                </div>
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
				    
		     ?>
			    <li id="invite_<?php echo $v['invite_id'];?>" class="<?php echo $v['deal_flyer_type'];?>" >
			    <div class="listUp">
				    <div class="listLeft">				      
					  <a data-id="<?php echo $v['bucket_id'];?>" class="fl viewOfferLt" href="javascript:void(0);"><span><?php echo $v['bucket_name'];?></span></a>
					  <span class="savingsBox">Savings <span><?php echo '$'.$savings;?></span></span>
				</div>
			    </div>
			    <div class="listDown">
				   <div class="listLeft">
					<p>on bucket list of <?php echo $v['otherpeople_count'];?> other people</p>
				   </div>
			    </div>
                    </li>
		     <?php }}else{?>
			    <li class="NoInvite">No invite found</li>
		     <?php }?>
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



  <div  id="view-offer-view" style="display: none;" class="viewOfferPop">
    <div class="viewOfferIn">
      <div class="viewOfferHeader">
      <span class="closeIcon" id="close_offer">X</span>
      <h2>Offer Details</h2>
      </div>
      <div id="offer_details_view" class="viewOfferContent"></div>
    </div>  
  </div>

  <div  id="view-flyer-view" style="display: none;" class="viewOfferPop">
    <div class="viewOfferIn">
      <div class="viewOfferHeader">
      <span class="closeIcon" id="close_flyer">X</span>
      <h2>Flyer Details</h2>
      </div>
      <div id="flyer_details_view" class="viewOfferContent"></div>
    </div>  
  </div>
<div id="own-flyer-view" style="display: none;" class="viewOfferPop">
    <div class="viewOfferInn">
    <div class="viewOfferHeader">
	<span class="closeIcon" id="close_ownreview">X</span>
	   <h2>Item Details</h2>
    </div>
	   <div id="own_review_details" class="viewOfferContent"></div>
</div>
</div>





<script type="text/javascript">
$(document).ready(function()
{
       $('.actv').trigger('click');  
       $('.dashListing2').css('display','none');
       $('.invite_list').css('display','none');
       var $scrollbar = $("#scrollbar1");
       $scrollbar.tinyscrollbar();

});

  
  
$('#type_name').change(function(){

$('.actv').trigger('click');

  });  
  
$('#bucket_menu li a').click(function(){

       var type_index = $('#type_name').val();

       var vl = $(this).attr('data-val');

       if (vl!= 'My own item') {
     
	      $('#my_own_page').css('display','none');
    
	      $('#dashboard_bucket_list li').hide();
	      $('.'+vl).show();
    
	      if ($('#dashboard_bucket_list li').is(':visible')) {
	      $('.noRecord').hide();
	      }
	      else
	      {
	      $('.noRecord').show();
	      }
       }
       else if(vl == 'My own item')
       {
	      $(this).parent().parent().find('a').removeClass('actv');
	      $('.scrollbar').height('35px !important');
	      $('#scrollbar1 .viewport').height('35px !important');
	      $(this).addClass('actv');
	      $('.btmSaving').css('display','none');
	      $('#dashboard_bucket_list li').hide();
	      $('.dashListing2').css('display','none');
	      $('#my_own_page').css('display','block');
       
       }
  
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
			 }
		});
	});
	
	
	
	
	$(document).on('click','.view-flyer-view',function(){
		var flyer_id = $(this).attr('data-element');
		$('#view-flyer-view').attr("id","view-flyer-view"+flyer_id);
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
			}
		});
	});

 var ret = '';


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

  $(document).on('click','#close_ownreview',function(){
   
   
   $('#own_review_details').html('');
   $('#own-flyer-view').hide();
   
   
 });
</script>
 
