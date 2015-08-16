  <!-- Start : Footer Container -->
  <div class="footerPan">
    <div class="footerInn">
      			<div class="latestEvent">
			  <h2>Latest events</h2>
				<h4>Check out all of the cool events that are happening.</h4>
				<?php
				//pr($event_home_list);
				
				  if(is_array($event_home_list))
				  {
				    $class = '';
				    if(count($event_home_list) == 3)
				    {
				      $class= '';
				    }
				    else if(count($event_home_list) == 2)
				    {
				      $class= 'eventClassTwo';
				    }
				    else
				    {
				      $class= 'eventClassOne';
				    }
				  ?>
				  <div class="<?php echo $class;?>">
				    <?php
				  foreach($event_home_list as $event_list)
				  {
				    //pr($event_list,0);
				    $title 		= stripslashes($event_list['Title']);
				    $desc 		= stripslashes($event_list['Description']);
				    $image 		= stripslashes($event_list['Image']);
				    $type 		= $event_list['Type'];
				    $discount 		= $event_list['discount'];
				    $discount_type 	= $event_list['dtype'];
				    
				    
				    if($type == 'deal') {$folder = 'offer';$class_type = 'view-offer';}
				    if($type == 'flyer') {$folder = 'flyer';$class_type = 'view-flyer';}
				    
				    if($image != '' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.$folder."/thumb/".$image))
				    {
				      $image_path = FILE_UPLOAD_URL.$folder."/".$image;
				    }
				    else
				    {
				      $image_path = FRONTEND_URL."images/no_image_310x180.gif";
				    }


				    
				  ?>
				
				<a href="javascript:void(0);" title="" class="latestEventBox <?php echo $class_type;?>" data-toggle="modal" data-element="<?php echo $event_list['ID'];?>" data-target="#<?php echo $class_type.$event_list['ID'];?>">
					<span class="latestHov">
					  
						<span class="latestTextTop"> <?php if($type == 'deal'){?>Up to <strong>
						<?php
						if($discount_type == '$'){echo '$';}
						echo $discount;
						if($discount_type == '%'){echo '%';}
						?></strong> Off<?php }?>
						</span>
					  
						<span class="latestTextBottom" ><?php echo $title;?></span>
					</span>
					<img src="<?php echo $image_path;?>" alt="" height="198" width="307">
					<strong class="shadow"></strong>
				</a>
				<?php } ?>
				</div>
				<?php } ?>
				
				
			</div>

      <div class="footerCont">
        <div class="footerContBox">
          <h3>Company</h3>
          <ul>
            <li><a href="<?php echo FRONTEND_URL?>about-us/" title="About TravelDotz">About TravelDotz</a></li>
            <li><a href="<?php echo FRONTEND_URL?>jobs/" title="Jobs ">Jobs </a></li>
            <li><a href="<?php echo FRONTEND_URL?>blog/" title="Blog">Blog</a></li>
            <li><a href="<?php echo FRONTEND_URL?>press/" title="Press">Press</a></li>
            <li><a href="<?php echo FRONTEND_URL?>investor-relations/" title="Investor Relations">Investor Relations</a></li>
          </ul>
        </div>
        <div class="footerContBox">
          <h3>Quick links</h3>
          <ul>
            <!--<li><a href="#" title="Careers">Careers</a></li>-->
            <li><a href="<?php echo FRONTEND_URL?>faq/" title="FAQ">FAQ</a></li>
            <!--<li><a href="javascript:void(0);" title="Blog">Blog</a></li>-->
            <li><a href="<?php echo FRONTEND_URL?>leadership-team/" title="Leadership Team">Leadership Team</a></li>
            <li><a href="<?php echo FRONTEND_URL?>contact-us/" title="Contact Us">Contact Us</a></li>
            <li><a href="<?php echo FRONTEND_URL?>partners/" title="Partners">Partners</a></li>
            <li><a href="<?php echo FRONTEND_URL?>terms-of-use/" title="Terms of Use">Terms of Use</a></li>
          </ul>
        </div>
        <div class="footerContBox">
          <h3>Work with TravelDotz</h3>
          <ul>
            <li><a href="<?php echo FRONTEND_URL?>offer/create_offer" title="Run a TravelDotz Offer">Run a TravelDotz Offer</a></li>
            <li><a href="<?php echo FRONTEND_URL?>flyer/flyer_create/" title="Run a TravelDotz Flyer">Run a TravelDotz Flyer</a></li>
          </ul>
        </div>
        <div class="footerContBox">
          <h3>Get social</h3>
          <ul class="social">
            <li class="facebook"><a href="<?php echo $settings['facebook_link']; ?>" target="_blank" title="facebook"></a></li>
            <li class="twitter"><a href="<?php echo $settings['twitter_link']; ?>" target="_blank"  title="twitter "></a></li>
            <li class="linkdin"><a href="<?php echo $settings['linkedin_link']; ?>" target="_blank"  title="linkdin"></a></li>
            <li class="googleplus"><a href="<?php echo $settings['google_plus']; ?>" target="_blank" title="google plus"></a></li>
            <li class="mail"><a href="mailto:<?php echo $settings['TravelDotz Webmaster'];?>" title="mail"></a></li>
          </ul>
        </div>
      </div>
      <div class="footerBottom">&copy; 2015 TravelDotz. All Rights Reserved</div>
    </div>
  </div>
  <!-- End : Footer Container --> 