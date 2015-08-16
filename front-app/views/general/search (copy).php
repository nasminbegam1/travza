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
           <div id="tabs">
	    <ul>
	      <li><a href="#tabs-1">User</a></li>
	      <li><a href="#tabs-2">Flyer</a></li>
	      <li><a href="#tabs-3">Offer</a></li>
	    </ul>
	    <div id="tabs-1">
		  <table>
	      <?php
	      if(is_array($resultUser) && $resultUser!=""){
		  foreach($resultUser as $val){?>
			<tr>
			      <td><img src="<?php if($val['profile_image']!=""){
				    echo FILE_UPLOAD_URL.'siteuser/thumb/'.$val['profile_image'];}
				    else{ echo FILE_UPLOAD_URL.'no_img.png';}?>"  alt="no-img"/>
			      </td>
			      <td><?php echo $val['first_name'];?></td>
			      <td><?php echo $val['last_name'];?></td>
			</tr>
		  <?php
		  }
	      }else{
		  echo 'No Result Found';
	      }
	      ?>
		  </table>
	    </div>
	    <div id="tabs-2">
		  <table>
			<?php
			if(is_array($resultFlyer) && $resultFlyer!=""){
			      foreach($resultFlyer as $val){
				    //print_r($val);fl_id
				    ?>
			      <tr>
				    <td><img src="<?php if($val['profile_image']!=""){
				    echo FILE_UPLOAD_URL.'flyer/thumb/'.$val['profile_image'];}
				    else{ echo FILE_UPLOAD_URL.'no_img.png';}?>"  alt="no-img"/>
				    </td>
				    <td><?php echo $val['flyer_title'];?></td>
				    <td><?php echo $val['address'].','.$val['city'].','.$val['state'];?></td>
			      </tr>		    
			      <?php
			      }
			}else{
			      echo 'No Result Found';
			}
			?>
		  </table>
	    </div>
	    <div id="tabs-3">
		  <!--table>
			<?php
			if(is_array($resultOffer) && $resultOffer!=""){
			    foreach($resultOffer as $val){
				  //print_r($val);deal_id
				  ?>
			      <tr>
				    <td><img src="<?php if($val['deal_image']!=""){
				    echo FILE_UPLOAD_URL.'offer/thumb/'.$val['deal_image'];}
				    else{ echo FILE_UPLOAD_URL.'no_img.png';}?>"  alt="no-img"/>
				    </td>
				    <td><?php echo $val['deal_title'];?></td>
				    <td><?php echo $val['deal_address'].','.$val['city'].','.$val['state'];?></td>
			      </tr>	  
			      <?php
			      }
			}else{
			      echo 'No Result Found';
			}
			?>
		  </table-->
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
		    $deal_image = FILE_UPLOAD_URL."offer/".$deal['deal_image']; ?>
		    <img src="<?php echo $deal_image;?>" alt="<?php echo $deal['deal_image'];?>">
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
                    echo 'No record found';
                }
		?>
		  <!---------------- deallist----------------------->
          
		  <div class="tab_details  active" id="deal_section">
		    Loading....
		  </div>
		  <div class="modal fade" id="view-offer" tabindex="-1" role="dialog" aria-hidden="true">
		      <div class="modal-dialog">
			  <div class="modal-content">
				  <div class="modal-header">
					     <h2>Offer Details</h2>
					     <button class="close" aria-hidden="true" data-dismiss="modal" type="button">&times;</button>
				  </div>
				  <div class="modal-body">
				      <div id="offer_details"></div> 
				  </div>
			  </div><!-- /.modal-content -->
		      </div><!-- /.modal-dialog -->
		  </div><!-- /.modal ---->
		  <!----------------------------------------->
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
	    </div>
	  </div>

	   <!----------------Deal End---------------------->
        </div>
    </div>
  </div>
    <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  $(document).ready(function(){
  
		search_result();
		
		
		$('.type').click(function(){
		  
		 var id =  $(this).attr('id');
		 $('.type').parent().removeClass('active');
		 
		 $(this).parent().addClass('active');
		 
		 if (id == 'flyer') {
		  $('#flyer_section').show();
		  $('#deal_section').hide();
		 }
		 
		 if (id == 'deals') {
		  $('#deal_section').show();
		  $('#flyer_section').hide();
		 }
		 
		 
		 $('#fl_type').val(id);
		var type_val = $(".active >  .type").attr('id');
                       if (type_val == 'flyer') {
                        
                          $('#discount_type').hide();
                        }
                        else if(type_val == 'deals')
                        {
                          $('#discount_type').show();
                        }
                        
		 
		 search_result();
		});

                 
                 


});
  </script>
