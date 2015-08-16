<?php
//pr ($offer_details);
if($offer_details){?>
			 <div class="modal-body">
<table cellpadding="0" cellspacing="0" border="0" style="text-align: left">
	 <tr class="img-offer">
		  <td colspan="2">
		  <?php
		  if(isset($offer_details->deal_image) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'offer/'.$offer_details->deal_image) && $offer_details->deal_image !=''){
			$offer_image = IMAGE_UPLOAD_URL."offer/".$offer_details->deal_image;
		  ?>
		  <img src="<?php echo $offer_image?>" alt="<?php echo $offer_details->deal_image;?>">
		  <?php
		  }else{
			$offer_image = IMAGE_UPLOAD_URL."no_img.png";
		  ?>
		  <img src="<?php echo $offer_image?>" alt="no_img.png">
		  <?php
		  }
		  ?>
		  </td>
	 </tr>
	 <!--<tr class="odd-row">
		  <td  width="50%" colspan="2"><strong class="detailsTitle">Offer Title :</strong> <?php //if($offer_details->deal_title != '' && isset($offer_details->deal_title)){echo stripslashes($offer_details->deal_title);}else{ echo 'N/A';}?></td>
		  
	 </tr>-->
	 <tr class="even-row">
		  
		  <td colspan="2"><strong class="detailsTitle">Description :</strong> <?php if($offer_details->offer_description != '' && isset($offer_details->offer_description)){echo stripslashes($offer_details->offer_description);}else{ echo 'N/A';}?></td>
	 </tr>
	 <tr class="odd-row">
		  
		  <td  width="50%" colspan="2"><strong class="detailsTitle">Company Name :</strong> <?php echo stripslashes($offer_details->company_name);?></td>
	 </tr>
	 <!--<tr class="even-row">
		  <td><strong class="detailsTitle">Address :</strong> <?php //if($offer_details->deal_address != ''){echo stripslashes($offer_details->deal_address);}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">Country :</strong> <?php //if($offer_details->country_name != ''){echo stripslashes($offer_details->country_name);}else{ echo 'N/A';}?></td>
	 </tr>
	 <tr class="odd-row">
		  <td><strong class="detailsTitle">City :</strong> <?php //if($offer_details->city != ''){echo stripslashes($offer_details->city);}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">State :</strong> <?php //if($offer_details->state != ''){echo stripslashes($offer_details->state);}else{ echo 'N/A';}?></td>
	 </tr>
	 <tr class="even-row">
		  <td><strong class="detailsTitle">Zip :</strong> <?php //if($offer_details->zip != ''){echo stripslashes($offer_details->zip);}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">Phone :</strong> <?php //if($offer_details->phone != ''){echo stripslashes($offer_details->phone);}else{ echo 'N/A';}?></td>
	 </tr>-->
	 <tr class="even-row">
		  <td  colspan="2">
		  <?php if($offer_details->days != '' && isset($offer_details->days))
		  {        $fullDays = array('M'=>'Monday', 'T'=>'Tuesday', 'W'=>'Wednesday', 'TH'=>'Thursday', 'F'=>'Friday', 'Sat'=>'Saturday', 'Sun'=>'Sunday');
			   $days = explode(',',stripslashes($offer_details->days));
			   if(isset($offer_details->start_hours_of_operation))
			   {
				 $start_arr = explode(',',$offer_details->start_hours_of_operation);
			   }
			   if(isset($offer_details->end_hours_of_operation))
			   {
				 $end_arr = explode(',',$offer_details->end_hours_of_operation);
			   }
			   $f = 0;

		  ?>
		  <table cellpadding="0" cellspacing="0" border="0" style="text-align: left" class="dayshours">
			   <tr>
				    <td width="50%"><strong class="detailsTitle">Days</strong></td>
				    <td width="50%"><strong class="detailsTitle">Hours Of Operation</strong></td>
			   </tr>
			   <?php
			   //pr($days,0);pr($start_arr,0);pr($end_arr,0);
			   foreach($days as $k=>$day){
			   if(isset($start_arr[$k])){ $start_hour[$day]= $start_arr[$k];}
			   if(isset($end_arr[$k])){$end_hour[$day] = $end_arr[$k];}
			   if($day!='0'){?>
			   <tr>
				    <td><?php echo $fullDays[$day]?></td>
				    <td>
				    <?php
				   // pr($start_hour,0);
				   //echo $day;exit;
				    if(isset($start_hour[$day]))
				    {
					     echo date('h:i a',strtotime($start_arr[$k]));
				    }
				    else
				    {
					     echo 'N/A';
				    }?>
				    -
				    <?php if(isset($end_hour[$day]))
				    {
					     echo date('h:i a',strtotime($end_arr[$k]));
				    }
				    else
				    {
					     echo 'N/A';
				    }?>
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

		  
<!--		  <td><strong class="detailsTitle">Days :</strong> <?php if($offer_details->days != '' && isset($offer_details->days))
		  {
			  $days = explode(',', stripslashes($offer_details->days));
			  foreach($days as $d)
			  {
			     echo $d.'<br/>';
			  }
		  }
		  else
		  {
			   echo 'N/A';
		  }?></td>
		  <td><strong class="detailsTitle">Hours Of Operation :</strong>
		  
		  </td>-->
	 </tr>
	 <tr class="video_row">
		  <td colspan="2">
		  <?php if($offer_details->link_to_video!=''){ ?>
		  <iframe width="100%" height="358" src="<?php echo stripslashes($offer_details->link_to_video);?>"></iframe>
		  <?php } ?>
		  </td>
	 </tr>
	 <tr class="odd-row">
		  <td><strong class="detailsTitle">Start Date :</strong> <?php if($offer_details->start_date != '' && $offer_details->start_date>0){echo date('m-d-Y', strtotime($offer_details->start_date));}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">End Date :</strong> <?php if($offer_details->end_date != '' && $offer_details->end_date>0){echo date('m-d-Y', strtotime($offer_details->end_date));}else{ echo 'N/A';}?></td>
	 </tr>
	 <!--<tr class="even-row">
		  <td colspan="2"><strong class="detailsTitle">Hours of operations :</strong> <?php //echo date('h:i a',strtotime($offer_details->start_hours_of_operation)).' - '.date('h:i a',strtotime($offer_details->end_hours_of_operation))?></td>
	 </tr>-->
	 <!--<tr class="odd-row">
		  <td><strong class="detailsTitle">Closed Holidays :</strong> <?php //if($offer_details->closed_holidays != ''){echo stripslashes($offer_details->closed_holidays);}else{ echo 'N/A';}?></td>
		  <td colspan="2"><strong class="detailsTitle">Offer Description :</strong> <?php if($offer_details->offer_description != ''){echo stripslashes($offer_details->offer_description);}else{ echo 'N/A';}?></td>
	 </tr>-->
	 <tr class="even-row">
		  <td><strong class="detailsTitle">Discount :</strong>
		  <?php
		  if($offer_details->custom_discount_amount != ''){
			   if($offer_details->custom_discount_type == '$'){echo '$';}
			   echo stripslashes($offer_details->custom_discount_amount);
			   if($offer_details->custom_discount_type == '%'){echo '%';}
		  }else{
			   echo 'N/A';
		  }?></td>
		  <td>
		  <?php
		  if($offer_details->discount_amount != ''){
			   $discount_amount = explode(',',$offer_details->discount_amount);
			   $discount_type = explode(',',$offer_details->discount_type);
		  }
		  
		  if(is_array($offer_details->discount_details)){
			  for($i = 0;$i<count($offer_details->discount_details);$i++){
			   echo stripslashes($offer_details->discount_details[$i]['type_name']).' : ';
			   if($discount_type[$i] == '$'){echo '$';}
			   echo stripslashes($discount_amount[$i]);
			   if($discount_type[$i] == '%'){echo '%';}
			   echo '<br>';
			  }
		  }
		  ?>
		  </td>
	 </tr>
	<!--<tr class="odd-row">
		  <td><strong class="detailsTitle">Expire Date of Offer :</strong> <?php //if($offer_details->exp_date_of_deal != '' && $offer_details->exp_date_of_deal>0){echo date('m-d-Y', strtotime($offer_details->exp_date_of_deal));}else{ echo 'N/A';}?></td>
		  <td><strong class="detailsTitle">Expire Date Of Offer On Bucket :</strong> <?php //if($offer_details->exp_date_of_deal_on_bucket != '' && $offer_details->exp_date_of_deal_on_bucket>0){echo date('m-d-Y', strtotime($offer_details->exp_date_of_deal_on_bucket));}else{ echo 'N/A';}?></td>
	 </tr>-->
	 <tr class="odd-row">
		  <td colspan="2"><strong class="detailsTitle">Restrictions :</strong> <?php if($offer_details->fine_print != ''){echo stripslashes($offer_details->fine_print);}else{ echo 'N/A';}?></td>
		  <!--<td><strong class="detailsTitle">Handicap Accessible :</strong> <?php //if($offer_details->handicap_accessible != ''){echo stripslashes($offer_details->handicap_accessible);}else{ echo 'N/A';}?></td>-->
	 </tr>
	 <!--<tr class="odd-row">
		  <td><strong class="detailsTitle">Senior Citizen Age :</strong> <?php //if($offer_details->senior_citizen_age != 0){if($offer_details->senior_citizen_age <= 50){echo stripslashes($offer_details->senior_citizen_age);}else{echo '50+';}}else{ echo 'X';}?></td>
		  <td><strong class="detailsTitle">Preferred Listing :</strong> <?php //if($offer_details->preferred_listing != ''){echo stripslashes($offer_details->preferred_listing);}else{ echo 'N/A';}?></td>
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