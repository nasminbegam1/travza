<?php if($flyer_details){?>
			<div class="modal-body">
<table cellpadding="0" cellspacing="0" border="0" style="text-align: left">
    
	 <tr class="even-row img-offer">
		  <td colspan="2">
		  <?php 
                 
		  if(isset($flyer_details->profile_image) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'flyer/'.$flyer_details->profile_image) && $flyer_details->profile_image !=''){
			$flyer_image = IMAGE_UPLOAD_URL."flyer/".$flyer_details->profile_image;
		  ?>
		  <img src="<?php echo $flyer_image?>" alt="<?php echo $flyer_details->profile_image;?>">
		  <?php
		  }else{
			$flyer_image = IMAGE_UPLOAD_URL."no_img.png";
		  ?>
		  <img src="<?php echo $flyer_image?>" alt="no_img.png">
		  <?php
		  }
		  ?>
		  </td>
	 </tr>
	 <!--<tr class="odd-row">
		  <td width="50%" colspan="2"><strong class="detailsTitle">Flyer Title :</strong> <?php //if($flyer_details->flyer_title != '' && isset($flyer_details->flyer_title)){echo stripslashes($flyer_details->flyer_title);}else{ echo 'N/A';}?></td>
		  
	 </tr>-->
	 <tr class="even-row">
		  
		  <td colspan="2"><strong class="detailsTitle">Description :</strong> <?php if($flyer_details->description != '' && isset($flyer_details->description)){echo stripslashes($flyer_details->description);}else{ echo 'N/A';}?></td>
	 </tr>
	 <tr class="odd-row">
		  
		  <td width="50%" colspan="2"><strong class="detailsTitle">Company Name :</strong> <?php if($flyer_details->company_name != '' && isset($flyer_details->company_name)){echo stripslashes($flyer_details->company_name);}else{ echo 'N/A';}?></td>
	 </tr>
	 <!--<tr class="even-row">
		  <td><strong class="detailsTitle">Address :</strong><?php //if($flyer_details->address != ''){echo stripslashes($flyer_details->address);}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">Country :</strong> <?php //if($flyer_details->country_name != ''){echo stripslashes($flyer_details->country_name);}else{ echo 'N/A';}?></td>
	 </tr>
	 <tr class="odd-row">
		  <td><strong class="detailsTitle">City :</strong> <?php //if($flyer_details->city != ''){echo stripslashes($flyer_details->city);}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">State :</strong> <?php //if($flyer_details->state != ''){echo stripslashes($flyer_details->state);}else{ echo 'N/A';}?></td>
	 </tr>
	 <tr class="even-row">
		  <td><strong class="detailsTitle">Zip :</strong> <?php //if($flyer_details->zip != ''){echo stripslashes($flyer_details->zip);}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">Phone :</strong> <?php //if($flyer_details->phone != ''){echo stripslashes($flyer_details->phone);}else{ echo 'N/A';}?></td>
	 </tr>-->
	 <tr class="even-row">
		  
		  
		  <td  colspan="2">
		  <?php if($flyer_details->days != '' && isset($flyer_details->days))
		  {        $fullDays = array('M'=>'Monday', 'T'=>'Tuesday', 'W'=>'Wednesday', 'TH'=>'Thursday', 'F'=>'Friday', 'Sat'=>'Saturday', 'Sun'=>'Sunday');
			   $days = explode(',',stripslashes($flyer_details->days));
			   if(isset($flyer_details->start_hour))
			   {
				 $start_arr = explode(',',$flyer_details->start_hour);
			   }
			   if(isset($flyer_details->end_hour))
			   {
				 $end_arr = explode(',',$flyer_details->end_hour);
			   }
			   $f = 0;
		  ?>
		  <table cellpadding="0" cellspacing="0" border="0" style="text-align: left" class="dayshours">
			   <tr>
				    <td width="50%"><strong class="detailsTitle">Days</strong></td>
				    <td width="50%"><strong class="detailsTitle">Hours Of Operation</strong></td>
			   </tr>
			   <?php
			  
			   foreach($days as $k=>$day){
			   if(isset($start_arr[$k])){ $start_hour[$day]= $start_arr[$k];}
			   if(isset($end_arr[$k])){$end_hour[$day] = $end_arr[$k];}
			    if($day!='0'){?>
			   <tr>
				    <td><?php echo $fullDays[$day]?></td>
				    <td>
				    <?php
				     
				    if(isset($start_hour[$day]))
				    {
					     echo date('h:i a',strtotime($start_arr[$k]));
				    }
				    else
				    {
					     echo 'N/A';
				    }
				    ?>
				    -
				    <?php
				if(isset($end_hour[$day]))
				    {
					     echo date('h:i a',strtotime($end_arr[$k]));
				    }
				    else
				    {
					     echo 'N/A';
			            }
				    ?>
				    </td>
			   </tr>			   
			   <?php $f++;}}?>
			   <?php if($f==0){?>
			   <tr>
				    <td>N/A</td>
				    <td>N/A</td>
			   </tr>			   
			   <?php }?>
		  </table>
		 <?php }
		  else
		  {?>
		  <table cellpadding="0" cellspacing="0" border="0" style="text-align: left" class="dayshours">
			   <tr>
				    <td width="50%"><strong class="detailsTitle">Days</strong></td>
				    <td width="50%"><strong class="detailsTitle">Hours Of Operation</strong></td>
			   </tr>
			   <tr>
				    <td>N/A</td>
				    <td>N/A</td>
			   </tr>			   
		  </table>			   

		 <?php }?>
		  </td>

	 </tr>
	 <tr class="even-row video_row">
		  <td colspan="2">
		  <?php if($flyer_details->you_tube_link!='' && isset($flyer_details->you_tube_link)){ ?>
		  <iframe width="100%" height="358" src="<?php echo stripslashes($flyer_details->you_tube_link);?>"></iframe>
		  <?php } ?>
		  </td>
	 </tr>
	 <tr class="odd-row">
		  <td><strong class="detailsTitle">Start Date :</strong> <?php if($flyer_details->start_date_time != '' && $flyer_details->start_date_time>0){echo date('m-d-Y', strtotime($flyer_details->end_date_time));}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">End Date :</strong> <?php if($flyer_details->end_date_time != '' && $flyer_details->end_date_time>0){echo date('m-d-Y', strtotime($flyer_details->end_date_time));}else{ echo 'N/A';}?></td>
	 </tr>
	 <!--<tr class="even-row">
		  <td><strong class="detailsTitle">Start Hours Of Operation :</strong> <?php //if($flyer_details->start_hour != ''){echo date('h:i a',strtotime($flyer_details->start_hour.':00'));}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">End Hours Of Operation :</strong> <?php //if($flyer_details->end_hour != ''){echo date('h:i a',strtotime($flyer_details->end_hour));}else{ echo 'N/A';}?></td>
	 </tr>-->
	 <tr class="even-row">
		  <td><strong class="detailsTitle">Price :</strong>
			   
		  <?php
			   if($flyer_details->discount_price != '' && isset($flyer_details->discount_price))
			   {
				   echo '$'.stripslashes($flyer_details->discount_price); 
			   }
			   elseif($flyer_details->price != '' && isset($flyer_details->price))
			   {
				    echo '$'.stripslashes($flyer_details->price);
			   }
			   else
			   {
				    echo 'N/A';
			   }?></td>
		  <td><strong class="detailsTitle">Restrictions :</strong> <?php if($flyer_details->fine_print != '' && isset($flyer_details->fine_print)){echo stripslashes($flyer_details->fine_print);}else{ echo 'N/A';}?></td>
		  
	 </tr>
	 <!--<tr class="even-row">
		  <td><strong class="detailsTitle">Expire Date of Flyer :</strong> <?php //if($flyer_details->exp_date_flyer != '' && $flyer_details->exp_date_flyer>0){echo date('m-d-Y', strtotime($flyer_details->exp_date_flyer));}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">Expire Date Of Flyer On Bucket :</strong> <?php //if($flyer_details->exp_date_bucket_list != '' && $flyer_details->exp_date_bucket_list>0){echo date('m-d-Y', strtotime($flyer_details->exp_date_bucket_list));}else{ echo 'N/A';}?></td>
	 </tr>-->
	 <!--<tr class="even-row">-->
		  <!--<td colspan="2"><strong class="detailsTitle">Fine Print :</strong> <?php //if($flyer_details->fine_print != ''){echo stripslashes($flyer_details->fine_print);}else{ echo 'N/A';}?></td>-->
		  <!--<td><strong class="detailsTitle">Handicap Accessible :</strong> <?php //if($flyer_details->handicap_accessible != ''){echo stripslashes($flyer_details->handicap_accessible);}else{ echo 'N/A';}?></td>-->
	 <!--</tr>-->
	 <!--<tr class="even-row">
		  <td><strong class="detailsTitle">Free Service :</strong> <?php //if($flyer_details->free_service != ''){echo stripslashes($flyer_details->free_service);}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">Preferred Listing :</strong> <?php //if($flyer_details->upgrade != ''){echo stripslashes($flyer_details->upgrade);}else{ echo 'N/A';}?></td>
	 </tr>-->
</table>
			 </div>
<?php }?>

<script>
$('.website_count_views').click(function(){
		  var id = $(this).attr('id');
		  $.ajax({			
			   type: "POST",
			   url: FRONT_URL + "home/website_count_views/",
			   data: { 'id': id },
			   success: function(msg){
			   }
		   });	
	});
</script>