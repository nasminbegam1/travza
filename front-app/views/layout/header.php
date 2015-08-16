	<!-- Start : Header -->
	<header class="header">
	<!-- Start : Header Top -->
		<div class="headerTop">
			<div class="headerTopInn">
				<div class="headerTopLeft">
					<ul>
						<!--<li class="one"><a href="#" title=""></a></li>
						<li class="two"><a href="#" title=""></a></li>
						<li class="three"><a href="#" title=""></a></li>
						<li class="four"><a href="#" title=""></a></li>-->
						
						<li class="one"><a href="<?php echo $settings['facebook_link']; ?>" target="_blank" title="facebook"></a></li>
						<li class="two"><a href="<?php echo $settings['twitter_link']; ?>" target="_blank"  title="twitter "></a></li>
						<li class="three"><a href="<?php echo $settings['linkedin_link']; ?>" target="_blank"  title="linkdin"></a></li>
						<li class="four"><a href="<?php echo $settings['google_plus']; ?>" target="_blank" title="google plus"></a></li>
						<li class="mail"><a href="mailto:<?php echo $settings['TravelDotz Webmaster'];?>" title="mail"></a></li>
						
						
					</ul>
				</div>
				<div class="headerTopRight">
					<ul>
					
					<?php
					//pr($_SESSION);
					if($this->nsession->userdata('user_id')>0)
					{					
					?>
						<li>Hi <?php echo $this->nsession->userdata('user_name'); ?></li>
						<!--<li><a href="<?php //echo FRONTEND_URL?>bucket/" title="Cart">Cart</a></li>-->
						<!--<li><a href="<?php //echo FRONTEND_URL."flyer/offer_flyer_list";?>" title="OFFERS and FLYERS">Offers and Flyers</a></li>-->
						<li><a href="<?php echo FRONTEND_URL?>help/" title="Help">Help</a></li>
						<!--<li><a href="<?php //echo FRONTEND_URL?>vendor/" title="Vendor">Vendor</a></li>-->
						<li><a href="<?php echo FRONTEND_URL?>login/logout" title="Logout">Logout</a></li>
						
					<?php } else {?>
						<?php if($this->nsession->userdata('vendor_id') == ''){?>
							<li><a href="<?php echo FRONTEND_URL?>login/" title="Sign In">Member Sign In</a></li>
							<li><a href="<?php echo FRONTEND_URL?>register/" title="Sign Up">Sign Up</a></li>
							<?php }?>
					<li><a href="<?php echo FRONTEND_URL?>vendor/" title="Vendor">Vendor Center</a></li>
					<!--<li><a href="<?php //echo FRONTEND_URL."flyer/offer_flyer_list";?>" title="OFFERS and FLYERS">Offers and Flyers</a></li>-->
					<!--<li><a href="<?php //echo FRONTEND_URL."bucket/index";?>" title="OFFERS and FLYERS">Offers and Flyers</a></li>-->
					<li><a href="<?php echo FRONTEND_URL?>help/" title="Help">Help</a></li>
					<?php if($this->nsession->userdata('vendor_id') != ''){?>
					<li><a href="<?php echo FRONTEND_URL?>login/vendor_logout" title="Logout">Logout</a></li>
					<?php } ?>
					<?php }?>
					
					</ul>
				</div>
			</div>
			
		</div>
	<!-- Start : Header Bottom -->
		<div class="headerbottom">
			<div class="headerbottomInn">
				<div class="logo"><a href="<?php echo FRONTEND_URL?>" title=""><img src="<?php echo FRONTEND_URL?>images/logo.png" alt=""></a></div>
				<div class="headerbottomRight">
					<div class="headerbottomRightTop">
						<div class="watchVideoBtn"><a href="#" data-toggle="modal" data-target="#compose-modal" title="Watch Our Video to Learn More"><span></span>Watch Our Video to Learn More</a></div>
						<div class="headSearchBox">
							<form method="get" action="<?php echo FRONTEND_URL?>search" method="post">
								<!--<input type="hidden" name="pageAction" value="Search"/>
								<input type="text" name="search" name="Search">
								<input name="search_submit" type="submit" value="" class="SearchBtn">-->
								<input type="text" name="sval" placeholder="Search">
								<input name="submit" type="submit" value="y" class="SearchBtn">
							</form>
						</div>
					</div>
					<div class="headerbottomRightBot">
						<ul>
							<li><a href="<?php echo FRONTEND_URL;?>" title="Home">Home</a></li>
							<?php if($this->nsession->userdata('vendor_id')>0) { ?>
							<li><a href="<?php echo FRONTEND_URL;?>vendor_dashboard" title="DASHBOARD">DASHBOARD</a></li>
							<li><a href="<?php echo FRONTEND_URL?>change_plan" title="PRICE">PRICE</a></li>
							<li><a href="<?php echo FRONTEND_URL."vendor_profile/vendor_contactinfo";?>" title="MY PROFILE">MY PROFILE</a></li>
							<?php }else{ ?>
							
							<li><a href="<?php echo FRONTEND_URL?>dashboard/" title="MY DOTZ BUCKET LIST">MY DOTZ BUCKET LIST</a></li>
							<li><a href="<?php echo FRONTEND_URL."flyer/offer_flyer_list";?>" title="OFFERS AND FLYERS">Offers AND Flyers</a></li>
							<li><a href="<?php echo FRONTEND_URL."register/updateProfile/";?>" title="MY PROFILE">MY PROFILE</a></li>							
							<? }?>
							<li><a href="<?php echo FRONTEND_URL."shop";?>" title="Shop">Shop</a></li>
							
							<!--<li><a href="<?php //echo FRONTEND_URL."flyer/offer_flyer_list";?>" title="OFFERS and FLYERS">OFFERS and FLYERS</a></li>-->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Start : Header -->
	<?php if($videoLinks['video_link'] != ''){?>
	<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
			<div class="modal-header">
				<h2>Watch Our Video to Learn More</h2>
                                <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
			</div>
                        <div class="modal-body">
                           <!-- <iframe width="100%" height="500" src="<?php //echo stripslashes($videoLinks['video_link']);?>"></iframe>-->
			    <iframe width="100%" height="500" src="http://www.ccv.adobe.com/v1/player/TuvHe7NPveb/embed"></iframe>
                        </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal ---->
	<?php } ?>