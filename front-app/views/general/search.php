 <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-53215c985fb0a0eb" async="async"></script>    
  <div class="main-container">
  	<div class="content">
    	<div class="page-title">
    		<h1>Search Result</h1>
        </div>
        <div class="textCenter">
	    <?php
	    if(isset($searchValue)!=''){
		  echo 'Showing Result for : '.$searchValue;
	    }
	    ?>
           <div class="tabPanel">
	    <ul class="tab_ul" id="tabs">
	      <li class="active"><a href="javascript:void(0);">User</a></li>
	      <li><a href="javascript:void(0);">Flyer</a></li>
	      <li><a href="javascript:void(0);">Offer</a></li>
	    </ul>
	    <div class="tabContainer" id="tabContent">
	    <div id="tabs-1" class="tabDetails active">
		  <div class="memberListTable">
			<?php
	      if(is_array($resultUser)){
		  foreach($resultUser as $val){?>
			<div class="dealsBox">
			      <div class="dealsBoxTop"><a href="userbucketlist/index/<?php echo $val['id'];?>">
			           <img src="<?php if(@is_array(getimagesize(FILE_UPLOAD_URL.'siteuser/thumb/'.$val['profile_image']))){
				    echo FILE_UPLOAD_URL.'siteuser/thumb/'.$val['profile_image'];
				   }else{
				    echo FILE_UPLOAD_URL.'siteuser/noProfile.gif';
				   }
				    ?>"  alt=""/>
				   </a></div>
			      <div class="dealsBoxBottom">
				    <h3><a href="userbucketlist/index/<?php echo $val['id'];?>"><?php echo $val['first_name'];?> <?php echo $val['last_name'];?></a></h3>
			      </div>
			</div>
			<?php
		  }
	      }else{
		  echo 'No Result Found.<br/>Add this place or event to your dream list';
	      }
	      ?>
		  </div>
	    </div>
	    <div id="tabs-2" class="tabDetails">

	    <?php
		
		if(isset($flyer_list) && is_array($flyer_list) && count($flyer_list) > 0)
		{
			$i = 0;	
			foreach($flyer_list as $flyer)
			{
			  $i++;
			  $flyer_image = "";
			  //$days_left = (strtotime($flyer['exp_date_bucket_list']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
	    ?> 
	     
            <div class="dealsBox">
	      
	      <?php
              if($flyer['free_service'] == 'Yes')
              {
              ?>
                <div class="freeBox"></div>
              <?php
              }
              ?>
	      <?php
		if(isset($flyer['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."flyer/thumb/".$flyer['profile_image']) && $flyer['profile_image']!= '')
                {
		    $flyer_image = FILE_UPLOAD_URL."flyer/thumb/".$flyer['profile_image']; ?>
		<?php
                }
                else
                {
                  $flyer_image = IMAGE_UPLOAD_URL."no_img.png";
		}
                ?>
              <div class="dealsBoxTop"> <img src="<?php echo $flyer_image?>" alt="" height="192"> </div>
              <div class="dealsBoxBottom">
                <h3 data-toggle="modal" class="view-flyer" data-element="<?php echo $flyer['fl_id'];?>" data-target="#view-flyer<?php echo $flyer['fl_id'];?>">
			<?php echo stripcslashes($flyer['flyer_title']);?>
		</h3>
		
		
		<a href="javascript:void(0);" data-toggle="modal" class="view-vendor-profile vendorIcon" data-element="<?php echo $flyer['vendor_id'];?>" data-target="#view-vendor-profile<?php echo $flyer['vendor_id'];?>"><img src="<?php echo FRONTEND_URL;?>images/man-blue.png"></a>
                <ul>
                  <li><strong class="location"></strong><span><?php echo stripcslashes($flyer['city']);?></span></li>
                 <!-------------Flyer Friend list------------------>
		  <li>
			<strong class="bucket"></strong>
				<span>
					<span>
						<?php echo $flyer['flyer_bucket_count'];?>
					</span> bucket list(s)
				</span>
			<a href="javascript:void(0);" type="flyer" data-toggle="modal" class="view-name" data-element="<?php echo $flyer['fl_id'];?>" data-target="#view-name<?php echo $flyer['fl_id'];?>"style="margin-left: 20px;">View Details</a>	

		  </li>
		  <!-------------------------------------->
                  <li><strong class="days"></strong><span><span><?php echo $flyer['date_diff']; ?> </span> <?php echo(($flyer['date_diff']>1)? 'days': 'day')?> left</span>
                    <div class="share addthis_native_toolbox"></div>
                  </li>
                </ul>
                <a href="javascript:void(0);" title="Add to bucket" class="addToBucket" item="<?php echo $flyer['fl_id'];?>" data-item ="flyer">Add to bucket</a>
		<!--<span class="savingsBox">Savings <span>$45</span></span>-->
		<br class="spacer">
              </div>
            </div>
	    <?php
	    if($i == 3)
	    {
		//$i = 0;
	    ?>
            <br class="spacer">
	    <?php
                }
		}
		}
                else
                {
			echo 'No record found.<br/>Add this place or event to your dream list ';
                }
        ?>
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

	    
	    
	    
	    </div>
	    <div id="tabs-3" class="tabDetails">
		  <!---------------Deal List----------------->
		<?php  
		if(isset($deal_list) && is_array($deal_list) && count($deal_list) > 0)
		{
			$i = 0;	
			foreach($deal_list as $deal)
			{
			  $i++;
			  $deal_image = "";
			  //$days = (strtotime($deal['exp_date_of_deal_on_bucket']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
	    ?>
            <div class="dealsBox">
              
              <div class="dealsBoxTop">
                
                <?php
		if(isset($deal['deal_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."offer/thumb/".$deal['deal_image']) && $deal['deal_image']!= '')
                {
		    $deal_image = FILE_UPLOAD_URL."offer/thumb/".$deal['deal_image']; ?>
		    <img src="<?php echo $deal_image;?>" alt="<?php echo $deal['deal_image'];?>" height="192">
		<?php
                }
                else
                {
                  $deal_image = IMAGE_UPLOAD_URL."no_img.png";
                ?>
                <img src="<?php echo $deal_image?>" alt="no_img.png">
                <?php
                }
		?>
              </div>
              <div class="dealsBoxBottom">
                <h3 data-toggle="modal" class="view-offer" data-element="<?php echo $deal['deal_id'];?>" data-target="#view-offer<?php echo $deal['deal_id'];?>"><?php echo stripcslashes($deal['deal_title']);?></h3>
		
		<a href="javascript:void(0);" data-toggle="modal" class="view-vendor-profile vendorIcon" data-element="<?php echo $deal['created_by'];?>" data-target="#view-vendor-profile<?php echo $deal['created_by'];?>"><img src="<?php echo FRONTEND_URL;?>images/man-blue.png"></a>
                <ul>
                  <li><strong class="location"></strong><span><?php echo stripcslashes($deal['city']);?></span></li>
                  <!------------------Deal Friend List------------------------------>
		  <li>
			<strong class="bucket"></strong>
			<span>
				<span>
					<?php echo $deal['deal_bucket_count'];?>  </span> bucket list(s)
				</span>
			<a href="javascript:void(0);" type="deal" data-toggle="modal" class="view-name" data-element="<?php echo $deal['deal_id'];?>" data-target="#view-name<?php echo $deal['deal_id'];?>" style="margin-left: 20px;">View Details</a>
		  </li>
                  <!------------------------------------------------>
		  <li><strong class="days"></strong><span><span><?php echo $deal['date_diff']; ?></span> <?php echo(($deal['date_diff']>1)? 'days': 'day')?> left</span>
                    <div class="share addthis_native_toolbox"></div>
		   
                  </li>
                </ul>
                <a href="javascript:void(0);" title="Add to bucket" class="addToBucket" item="<?php echo $deal['deal_id'];?>" data-item ="deal">Add to bucket</a> <!--<span class="savingsBox">Savings <span>$45</span></span>-->
		<br class="spacer">
              </div>
            </div>
            <?php
	    if($i == 3)
	    {
		//$i = 0;
	    ?>
            <br class="spacer">
              <?php
                }
		}
		}
                else
                {
                    echo 'No record found.<br/>Add this place or event to your dream list ';
                }
		?>
		  <!---------------- deallist----------------------->
          
		  <div class="tab_details  active" id="deal_section">
		    
		  </div>
		  
		  <!----------------------------------------->
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
      
	    </div>
	  </div>
	    </div>

	   <!----------------Deal End---------------------->
        </div>
    </div>
  </div>
  


  
      <div class="modal fade" id="view-name" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog">
	   <div class="modal-content">
		   <div class="modal-header">
			 <h2>Bucket List User Details</h2>
			 <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
		   </div>
		   <div class="modal-body">
		       <div id="details_name" class="offer_details_Box"></div> 
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

<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->nsession->userdata('user_id');?>" /> 
    <script>
  $(document).ready(function(){
  
	$('.addToBucket').click(function(){
	
	var deal_flyer_id = $(this).attr('item');
	var type = $(this).attr('data-item');
	var user_id = $('#user_id').val();
	
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
						
						
				    }
				    
				}
		});				
	}
});		

                 
                 
 $('#tabs li').click(function(){
   var i = $(this).index();
   $('#tabs li').removeClass('active');
   $(this).addClass('active');
   $('#tabContent .tabDetails').hide().removeClass('active');
   $('#tabContent .tabDetails:eq('+i+')').show().addClass('active');
 });


});
  </script>
