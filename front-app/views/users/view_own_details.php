<?php //pr($own_details); ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    
	 
	 <tr class="odd-row">
		  <td width="50%"><strong class="detailsTitle"> Title : </strong> <?php if(isset($own_details->flyer_title) && $own_details->flyer_title!=''){echo stripslashes($own_details->flyer_title);}else{ echo 'N/A';}?></td>
		  <td width="50%"><strong class="detailsTitle">Created By : </strong> <?php echo stripslashes($this->nsession->userdata("user_name")).' '.stripslashes($this->nsession->userdata("last_name"));?></td>
	 </tr>
	 <tr class="even-row">
		  <td colspan="2"><strong class="detailsTitle">Address : </strong><?php if(isset($own_details->address) && $own_details->address != ''){echo stripslashes($own_details->address);}else{ echo 'N/A';}?></td>
		  
	 </tr>
	 <tr class="odd-row">
                  <td width="50%"><strong class="detailsTitle">Country :</strong> <?php if(isset($own_details->country_name) && $own_details->country_name != ''){echo stripslashes($own_details->country_name);}else{ echo 'N/A';}?></td>
		  <td width="50%"><strong class="detailsTitle">State : </strong> <?php if(isset($own_details->state) && $own_details->state != ''){echo stripslashes($own_details->state);}else{ echo 'N/A';}?></td>
	 </tr>
         
         <tr class="even-row">
                  
		  <td width="50%"><strong class="detailsTitle">City : </strong><?php if(isset($own_details->city) && $own_details->city != ''){echo stripslashes($own_details->city);}else{ echo 'N/A';}?></td>
		  <td width="50%"><strong class="detailsTitle">Zip : </strong> <?php if(isset($own_details->zip) && $own_details->zip != ''){echo stripslashes($own_details->zip);}else{ echo 'N/A';}?></td>
	 </tr>
         <tr class="odd-row">
		  <td colspan="2"><strong class="detailsTitle">Description : </strong><?php if(isset($own_details->description) && $own_details->description != ''){echo stripslashes($own_details->description);}else{ echo 'N/A';}?></td>
		  
	 </tr>
</table>
<!--<script>
	 $(document).ready(function() {
	  $('.own-flyer').click(function(){
		var own_id = $(this).attr('data-element');
		
		$('#own-flyer').attr("id","own-flyer"+own_id);
		$.ajax({			
			type: "POST",
			url: FRONT_URL + "dashboard/own_flyer/",
			data: { 'own_id': own_id },
			success: function(msg){
				 $('#own_details').html(msg);
				 
				 $("#own-flyer"+own_id).attr("id","own-flyer");
			}
		});
	});
	 });
</script>-->