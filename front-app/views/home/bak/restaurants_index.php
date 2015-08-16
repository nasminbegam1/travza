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
						<img src="<?php echo FRONTEND_URL;?>images/top-img-1.png" alt="">
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
						<img src="<?php echo FRONTEND_URL;?>images/top-img-2.png" alt="">
					</div>
					<br class="spacer">
					<div class="leftOne">
						<img src="<?php echo FRONTEND_URL;?>images/top-img-3.png" alt="">
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
		
		if(isset($deal_list) && is_array($deal_list) && count($deal_list) > 0)
		{
				$i = 0;
			foreach($deal_list as $deal)
			{
				$i++;
				$deal_image = "";
				$days = (strtotime($deal['exp_date_of_deal']) - strtotime(date('Y-m-d'))) / (60 * 60 * 24);
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
							<span class="savingsBox">Savings <span>$45</span></span>
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
		else
		{
		  echo "No Offers Found";
		}
		?>
						<br class="spacer">						
						
					</div>
			 <div class="tab_details">
						<div class="dealsBox">
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
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						
						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-2.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						
						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-3.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						<br class="spacer">
						
						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-4.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						
						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-5.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						
						<br class="spacer">
						
					</div>
			 <div class="tab_details">
						<div class="dealsBox">
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
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						
						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-2.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						
						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-3.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						<br class="spacer">
						
						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-4.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						
						<div class="dealsBox">
							<div class="freeBox"></div>
							<div class="dealsBoxTop">
								<img src="images/img-5.jpg" alt="">
							</div>
							<div class="dealsBoxBottom">
							<h3>Deal and Flyer offer</h3>
							<ul>
								<li><strong class="location"></strong><span>London</span></li>
								<li><strong class="bucket"></strong><span><span>20</span> bucket list</span></li>
								<li><strong class="days"></strong><span><span>30</span> days left</span> <div class="share"></div></li>
							</ul>
							<a href="#" title="Add to bucket" class="addToBucket">Add to bucket</a>
							<span class="savingsBox">Savings <span>$45</span></span>
							<br class="spacer">
							</div>
						</div>
						
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
		else
		{
		  echo "No Flyer Found";
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
				
				<div class="tipsCont">
					<div class="tipsBox">
						<div class="tipsBoxTop">
							<div class="tipsBoxTopImg"><img src="<?php echo FRONTEND_URL;?>images/img-10.jpg" alt=""></div>
							<div class="tipsBoxTopText">
								<h3>jasonlindstrom </h3>
								<p>Read the success story</p>
								<a href="#" title="30 followers"><span>30</span> followers</a>
							</div>
							<br class="spacer">
						</div>
						<div class="tipsBoxBottom">
							<img src="<?php echo FRONTEND_URL;?>images/tip-img-1.jpg" alt="">
						</div>
					</div>
					<div class="tipsBox">
						<div class="tipsBoxTop">
							<div class="tipsBoxTopImg"><img src="<?php echo FRONTEND_URL;?>images/img-10.jpg" alt=""></div>
							<div class="tipsBoxTopText">
								<h3>jasonlindstrom</h3>
								<p>Read the success story</p>
								<a href="#" title="30 followers"><span>30</span> followers</a>
							</div>
							<br class="spacer">
						</div>
						<div class="tipsBoxBottom">
							<img src="<?php echo FRONTEND_URL;?>images/tip-img-2.jpg" alt="">
						</div>
					</div>
					<div class="tipsBox">
						<div class="tipsBoxTop">
							<div class="tipsBoxTopImg"><img src="<?php echo FRONTEND_URL;?>images/img-10.jpg" alt=""></div>
							<div class="tipsBoxTopText">
								<h3>jasonlindstrom </h3>
								<p>Read the success story</p>
								<a href="#" title="30 followers"><span>30</span> followers</a>
							</div>
							<br class="spacer">
						</div>
						<div class="tipsBoxBottom">
							<img src="<?php echo FRONTEND_URL;?>images/tip-img-3.jpg" alt="">
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- End : Main Container -->

