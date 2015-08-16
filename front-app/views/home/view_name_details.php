<?php //pr($name_details);?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
    <?php
    $friend=array();
    $pendingFriend=array();
    $declinefriend=array();
    $requestfriend=array();
    //$data['request_friends_details']
    if($user_id>0){
	$frndCount=count($friends_details);
	for($i=0;$i<$frndCount;$i++){
	    $friend[$i]=$friends_details[$i]['user_id'];
	}
	$pendingfrndCount=count($pending_friends_details);
	for($i=0;$i<$pendingfrndCount;$i++){
	    $pendingfriend[$i]=$pending_friends_details[$i]['user_id'];
	}
	$declinefrndCount=count($decline_friends_details);
	for($i=0;$i<$declinefrndCount;$i++){
	    $declinefriend[$i]=$decline_friends_details[$i]['user_id'];
	}
	$requestfrndCount=count($request_friends_details);
	for($i=0;$i<$requestfrndCount;$i++){
	    $requestfriend[$i]=$request_friends_details[$i]['user_id'];
	}
    }
    
    
    if(is_array($name_details) && count($name_details) > 0)
    {
      foreach($name_details AS $namedetails)
      //print_r($namedetails);
      {
	if(isset($namedetails['first_name']) && $namedetails['first_name']!=''){
        ?>
        <tr class="odd-row">
		  <td  width="30%"><?php echo stripslashes($namedetails['first_name']).' '.stripslashes($namedetails['last_name']);?></td>
                  <?php if($user_id>0){?>
		  <td width="30%" friendRow<?php echo $namedetails['user_id'];?>><?php //echo $namedetails['user_id'];?>
		  <?php if(!in_array($namedetails['user_id'], $friend)
			   && $namedetails['user_id']!=$this->nsession->userdata('user_id')){
			if(in_array($namedetails['user_id'], $pendingfriend)){ echo 'Request Already Sent'; }
			else if(in_array($namedetails['user_id'], $declinefriend)){ echo 'Request Declined'; }
			else if(in_array($namedetails['user_id'], $requestfriend)){ echo 'Request pending'; }
			else{
		    ?>
		  		    <a href="javascript:void(0);" onclick='addFriend("<?php echo $namedetails['user_id']; ?>");'>
			Add Friend
		    </a>
		    <?php } }?> </td>
		  <td width="40%" id="responseRow<?php echo $namedetails['user_id'];?>"></td>
		  <?php } ?>
		  
	 </tr>
        <?php
      } }
    }else{
	echo '<tr> <td  width="70%">No Public Bucket List Entry for this Item</td></tr>';
    }
    ?>
	 

</table>
<script type="text/javascript">
    function addFriend(friendId){
	var id = friendId;
	$.ajax({	    
	    type: "POST",
	    url: FRONT_URL + "register/friend_req_send/",
	    data: { 'id': id },
	    success: function(msg){
		if(msg != '')
		{
		    //alert(msg);
		    jQuery('#friendRow'+friendId+'').html("Pending..");
		    jQuery('#responseRow'+friendId+'').html('<span style="color:green;">Freiend Request Sent!</span>');
		}
			
	    }
	});	
    }
</script>