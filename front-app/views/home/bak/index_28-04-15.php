<link href="<?php echo FRONTEND_URL?>js/rating/rateit.css" rel="stylesheet" type="text/css">
<script src="<?php echo FRONTEND_URL?>js/rating/jquery.rateit.js" type="text/javascript"></script>



       <div class="bannerPan">
		<div class="banRoundBox">
			<span class="roundTopText">Travel<span>dotz</span></span>
			<span class="redTopText">informs</span>
			<span class="greyTopText"> travelers of what</span>
			<span class="blueTopText"> <span>the world has to</span> <strong>offer</strong></span>
			<br class="spacer">
			<a href="<?php echo FRONTEND_URL;?>register" title="">Join Now</a>
		</div>
		<div id="owl-demo" class="owl-carousel">
				
		<?php
		
		if(isset($banner_list))
		{
			foreach($banner_list as $banner)
			{
				
				$image = ""; 
				if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."banner/".$banner['banner_image'])){
				$image = FILE_UPLOAD_URL."banner/".$banner['banner_image']; ?>
				<div class="item"><img src="<?php echo $image;?>" alt=""></div>
				<?php }
				?>
				
				
				
	    <?php 
			}
		}
		?>
            
		</div>
		
	</div>
	<!-- End : Banner -->
	<!-- Start : Main Container -->
	<div class="mainPan">
		<div class="contentInn">
				<div class="conTopBar">
					<div class="leftOne">
						<img src="images/top-img-1.png" alt="">
					</div>
					<div class="leftTwo">
						<h3>CREATE YOUR <span>DOTZ</span> BUCKET LIST</h3>
						<p>Find discounts for activities on your bucket list, connect with travelers and locals around the world and share your experiences. Traveldotz is the new way to help you experience life to the fullest! </p>
					</div>
					<br class="spacer">
					<div class="leftThree">
						<h3>Compare <span>dotz</span></h3>
						<p>Compete with your friends by comparing your DOTZ on a map of places your have traveled </p>
					</div>
					<div class="leftFour">
						<img src="images/top-img-2.png" alt="">
					</div>
					<br class="spacer">
					<div class="leftOne">
						<img src="images/top-img-3.png" alt="">
					</div>
					<div class="leftTwo">
						<h3>Shop Your <span>DOTZ</span></h3>
						<p>Show you're a TravelDotz traveler by wearing some of our cool gear.  Clothing and travel products are available for your next adventure!</p>
					</div>
				<br class="spacer">
				</div>
		</div>
	</div>
	<div class="mainPanTwo">
		
		<div class="mainInnTwo">
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $this->nsession->userdata('user_id');?>" />
			<input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $this->nsession->userdata('vendor_id');?>" />
			<!--<div id="dialog"  style="display: none;">
<p>Product already exist in the cart.</p>
		        </div>
			<div id="dialog1" style="display: none;">
<p>Product added to cart.</p>
		        </div>-->
			<ul id="tabs" class="tab_ul">
                    <li class="active"><a href="javascript:void('0');" title="">New Offers</a></li>
                    <li><a href="javascript:void('0');" title="">Top Offers For You</a></li>
                    <li><a href="javascript:void('0');" title="">Getaway Offers</a></li>
                    <li><a href="javascript:void('0');" title="">New Flyers</a></li> 
                </ul>
			<br class="spacer">
			<div class="dealPan" id="tab_content">
                	<div class="tab_details  active">
				
						<?php
		if(isset($offer_value) && is_array($offer_value) && count($offer_value) > 0)
		{
				$offer_price = $offer_value['offer_price'];
				$preferred_listing = $offer_value['preferred_listing'];
		}
		if(isset($deal_list) && is_array($deal_list) && count($deal_list) > 0)
		{
				$i = 0;
			foreach($deal_list as $deal)
			{
				$i++;
				$deal_image = "";
				
				$days = (strtotime($deal['exp_date_of_deal']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
				
				if($deal['custom_discount_type'] == '$')
				{
					$save = 	$offer_price - $deal['custom_discount_amount'];
				}
				if($deal['custom_discount_type'] == '%')
				{
					$save = 	$offer_price - (($offer_price * $deal['custom_discount_amount'])/100);
				}
				if($deal['preferred_listing'] == "Yes")
				{
						$savings_amt = $save + $preferred_listing;
				}
				else
				{
						$savings_amt = $save;
				}
				?>
				
				<div class="dealsBox">
						
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<?php
				if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."offer/thumb/".$deal['deal_image'])){
				$deal_image = FILE_UPLOAD_URL."offer/thumb/".$deal['deal_image']; ?>
								<img src="<?php echo $deal_image;?>" alt="">
								<?php }
								?>
							</div>
							<div class="dealsBoxBottom">
							<h3><?php echo stripcslashes($deal['deal_title']);?></h3>
							<ul>
								<li><strong class="location"></strong><span><?php echo stripcslashes($deal['city']);?></span></li>
								<li><strong class="bucket"></strong><span><span><?php echo $deal['deal_count'];?></span>&nbsp; bucket list</span></li>
								<li><strong class="days"></strong><span><span><?php echo $days; ?></span>&nbsp; days left</span> </span><!--<div class="share"></div>--><span class='st_sharethis_large' displayText='ShareThis'></li>
							</ul>
							<a href="javascript:void(0);" title="Add to bucket" class="addToBucket" item="<?php echo $deal['deal_id'];?>" data-item ="deal">Add to bucket</a>
							<span class="savingsBox">Savings <span>$<?php echo $savings_amt;?></span></span>
							<br class="spacer">
							</div>
				</div>
				
				
				
				
	    <?php
	    if($i == 3)
	    {
		$i = 0;
		?>
		<br class="spacer">	
		<?php
	    }
			}
		}
		?>
						<br class="spacer">						
						
					</div>
			 <div class="tab_details">
<!--						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-1.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket" >Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
-->						

						<br class="spacer">
						
					</div>


						<div class="tab_details">
					
					
						<br class="spacer">
					
					</div>
			<div class="tab_details">
						
		<?php
		
		
		if(isset($flyer_list) && is_array($flyer_list) && count($flyer_list) > 0)
		{
			foreach($flyer_list as $flyer)
			{
				$flyer_image = "";
				$days1 = (strtotime($flyer['exp_date_flyer']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
				?>
				
				<div class="dealsBox">
						
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<?php
				if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH."flyer/thumb/".$flyer['profile_image'])){
				$flyer_image = FILE_UPLOAD_URL."flyer/thumb/".$flyer['profile_image']; ?>
								<img src="<?php echo $flyer_image;?>" alt="">
								<?php }
								?>
							</div>
							<div class="dealsBoxBottom">
							<h3><?php echo stripcslashes($flyer['flyer_title']);?></h3>
							<ul>
								<li><strong class="location"></strong><span><?php echo stripcslashes($flyer['city']);?></span></li>
								<li><strong class="bucket"></strong><span><span><?php echo $flyer['flyer_count'];?></span>&nbsp; bucket list</span></li>
								<li><strong class="days"></strong><span><span><?php echo $days1; ?></span>&nbsp; days left</span>  <span class='st_sharethis_large' displayText='ShareThis'></span><!--<div class="share"></div>--></li>
							</ul>
							<a href="javascript:void(0);" title="Add to bucket" class="addToBucket" item="<?php echo $flyer['fl_id'];?>" data-item ="flyer">Add to bucket</a>
							<!--<span class="savingsBox">Savings <span>$45</span></span>-->
							<br class="spacer">
							</div>
				</div>
				
				
				
				
	    <?php 
			}
		}
		?>
				<br class="spacer">		
						
					</div>
            </div>
			
			
		</div>
	</div>
	
	<div class="mainPanThree">
		<div class="mainInnThree">
			<div class="tipsPan">
				<h2>Tips and Experiences</h2>
				<h4>443,214 and counting successful bucket list goals achieved </h4>
				
				<?php
				$class = '';
				if(is_array($local_user))
				{
				    if(count($local_user) == 1)
				    {
					   $class = 'tips_one';
				    }
				    if(count($local_user) == 2)
				    {
					   $class = 'tips_two';
				    }
				}
	 			?>
				
				<div class="tipsCont <?php echo $class;?>">
						
					<?php
				    if(is_array($local_user))
				    {
					
					     foreach($local_user as $user)
					     {
						      $user_name = stripslashes($user['username']);
						      $profile_image = stripslashes($user['profile_image']);
						      $image = stripslashes($user['image_name']);
						      
						      
						      if($profile_image != '' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."siteuser/thumb/".$profile_image))
						      {
							     $profile_image_path = FILE_UPLOAD_URL."siteuser/thumb/".$profile_image;  
						      }
						      else
						      {
							       $profile_image_path = FRONTEND_URL."images/no_image_man.gif";
						      }
						      if($image != '' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."home_user/location/".$image))
						      {
							     $image_path = FILE_UPLOAD_URL."home_user/location/".$image;  
						      }
						      else
						      {
							       $image_path = FRONTEND_URL."images/no_image_310x180.gif";
						      }
						      
					     
				   ?>
					<div class="tipsBox">
						<div class="tipsBoxTop">
							<div class="tipsBoxTopImg"><img src="<?php echo $profile_image_path;?>" alt=""></div>
							<div class="tipsBoxTopText">
								<h3><?php echo $user_name;?> </h3>
								<p>Read the success story</p>
								<a href="#" title="30 followers"><span>30</span> followers</a>
							</div>
							<br class="spacer">
						</div>
						<div class="tipsBoxBottom">
							<img src="<?php echo $image_path;?>" alt="">
						</div>
					</div>
					<?php
					
					 }
				    }
				    ?>		
						
				</div>
				
			</div>
		</div>
	</div>

<input type="hidden" id="deal_flyer_id" value="">
<input type="hidden" id="deal_flyer_type" value="">
	
<div class="check_user_login" style="display: none;">
		
		<span>You have to login first as a user to add bucket.</span>
		<input type="button" class="closeBtn" value="close">
		
</div>

<div class="already_added" style="display: none;">
		
		<span>You have already added this Offer/Flyer.</span>
		<input type="button" class="closeBtn" value="close">
		
</div>

<div class="flyer_popup_outer" style="display: none;" >
<div class="flyer_popup">
	<h1>Flyer or Deal Title Goes Here</h1>
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
	<input type="button" value="submit" class="submit" id="submit_review">
		
</div>
</div>

<div id="success_review" style="display: none;">
	<h2>Your review is successfully submitted</h2>
	<input type="button" class="closeBtn" value="close">
</div>
<div id="failure_review" style="display: none;">
	<h2>Your review is not submitted</h2>
	<input type="button" class="closeBtn" value="close">
</div>


<script>
		
$(document).ready(function(){
		
		$('#tabs li').click(function(event){
			var i = $(this).index();
			$('#tabs li').removeClass('active');
			$(this).addClass('active');
			$('#tab_content .tab_details').removeClass('active');
			$('#tab_content .tab_details:eq('+i+')').addClass('active');
		});
		
		$('.addToBucket').click(function(){
			
			var deal_flyer_id = $(this).attr('item');
			var type = $(this).attr('data-item');
			var user_id = $('#user_id').val();
			
			if (user_id == '') {
			   //$('.check_user_login').show();				
			   swal({
			       title: "Error!",
			       text: "You have to login first as a user to add to bucket!<br><a href=\"<?php echo FRONTEND_URL;?>login\">Click Here</a> to login",
			       type: "error",
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
								$('#deal_flyer_id').val(deal_flyer_id);
								$('#deal_flyer_type').val(type);
								$('.flyer_popup_outer').show();
						    }
						    
						}
				});				
			}
		});
		
		$('.closeBtn').click(function(){
				$(this).parent().hide();
		});
		
		
		$('#submit_review').click(function(){
				var experince_tips = $('#experince_tips').val();
				var tell_other_members = $('#tell_other_members').val();
				var review_rating = $('#review_rating').val();
				var deal_flyer_id = $('#deal_flyer_id').val();
				var deal_flyer_type = $('#deal_flyer_type').val();
				
				
				$.ajax({
						
					type: "POST",
						url: "<?php echo FRONTEND_URL; ?>" + "home/add_review/",
						data: { 'experince_tips': experince_tips,'tell_other_members': tell_other_members,'rating':review_rating,'id':deal_flyer_id,'type':deal_flyer_type},
						success: function(msg){
						    if(msg >0)
						    {
								
								$('#submit_review').parent().parent().hide();
								//$('#success_review').show();
								
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

				
		});
		
		
});	

		
</script>
	
	<!-- End : Main Container -->

