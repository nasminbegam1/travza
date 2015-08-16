<div class="content">
  <div class="page-title">
    <h1>On My Dotz bucket</h1>
  </div>
  <div class="listSear">
    <ul class="form-list">
      <li>
        <div class="field">
          <label for="Last Name">Friends</label>
          <div class="input-box">
            <input name="text" id="text" class="input-text required email valid" type="text" placeholder="Find friends...." />
            <!--<input type="submit" value="search" id="search" class="blueBtn" />-->
	    <br/><br/>
          </div>
        </div>
      </li>
    </ul>
  </div>
  <div id="searchFriend">
  	
  </div>
  <?php
  if(isset($friend_request) && is_array($friend_request) && count($friend_request) > 0 )
  {
  ?>
  <div class="friendList" id="friend_request">
  	<h2>Friend Request Sent to Me</h2>
    <ul class="ul_friend_req">
      <?php
      foreach($friend_request as $friend_request_list)
      {
      ?>
        <li id="friend_req_<?php echo $friend_request_list['id'];?>">
        	<div class="frImg">
		<a href="#"><?php
				if(isset($friend_request_list['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$friend_request_list['profile_image']) && $friend_request_list['profile_image'] !=''){
				      $profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$friend_request_list['profile_image'];
				?>
				<img src="<?php echo $profile_image?>" alt="<?php echo $friend_request_list['profile_image'];?>">
				<?php
				}else{
				      $profile_image = IMAGE_UPLOAD_URL."no_img.png";
				?>
				<img src="<?php echo $profile_image?>" alt="no_img.png">
				<?php
				}
			      ?>
		</a> </div>
            <div class="frNm"> <h2><a href="#"><?php echo stripcslashes($friend_request_list['first_name'])." ".stripcslashes($friend_request_list['last_name']);?></a></h2> </div>
	    <input type="button" class="blueBtn friend_accept" name="friend_accept" id="<?php echo $friend_request_list['id'];?>" value="Accept">
	     <input type="button" class="blueBtn friend_req_delete" name="friend_req_delete" id="<?php echo $friend_request_list['id'];?>" value="Decline">
        </li>
      <?php
      }
      ?>
    	
    </ul>
    <br class="spacer" />
  </div>
  <?php
  }
  ?>
  <?php
  if(isset($pending_request) && is_array($pending_request) && count($pending_request) > 0 )
  {
  ?>
  <div class="friendList" id="pending_req" >
  	<h2>Friend Request Sent by Me</h2>
    <ul id="pending" class="ul_pending_req">
      <?php
      foreach($pending_request as $pending_friend_list)
      {
      ?>
        <li id="pending_<?php echo $pending_friend_list['id'];?>">
        	<div class="frImg">
		<a href="#"><?php
				if(isset($pending_friend_list['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$pending_friend_list['profile_image']) && $pending_friend_list['profile_image'] !=''){
				      $profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$pending_friend_list['profile_image'];
				?>
				<img src="<?php echo $profile_image?>" alt="<?php echo $pending_friend_list['profile_image'];?>">
				<?php
				}else{
				      $profile_image = IMAGE_UPLOAD_URL."no_img.png";
				?>
				<img src="<?php echo $profile_image?>" alt="no_img.png">
				<?php
				}
			      ?>
		</a> </div>
            <div class="frNm"> <h2><a href="#"><?php echo stripcslashes($pending_friend_list['first_name'])." ".stripcslashes($pending_friend_list['last_name']);?></a></h2> </div>
	     <input type="button" class="blueBtn friend_decline" name="friend_decline" id="<?php echo $pending_friend_list['id'];?>" value="Cancel">
        </li>
      <?php
      }
      ?>
    	
    </ul>
    <br class="spacer" />
  </div>
  <?php
  }
  ?>
  <?php
  if(isset($friend) && is_array($friend) && count($friend) > 0 )
  {
  ?>
  <div class="friendList" id="friend_list">
  	<h2> My Friend List </h2>
    <ul id="friend" class="ul_friend">
      <?php
      foreach($friend as $friend_list)
      {
      ?>
        <li id="friend_<?php echo $friend_list['id'];?>">
        	<div class="frImg">
		<a href="<?php echo FRONTEND_URL.'friend-bucketlist/'.$friend_list['user_id'];?>.'/'"><?php
				if(isset($friend_list['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$friend_list['profile_image']) && $friend_list['profile_image'] !=''){
				      $profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$friend_list['profile_image'];
				?>
				<img src="<?php echo $profile_image?>" alt="<?php echo $friend_list['profile_image'];?>">
				<?php
				}else{
				      $profile_image = IMAGE_UPLOAD_URL."no_img.png";
				?>
				<img src="<?php echo $profile_image?>" alt="no_img.png">
				<?php
				}
			      ?>
		</a> </div>
            <div class="frNm"> <h2><a href="<?php echo FRONTEND_URL.'friend-bucketlist/'.$friend_list['user_id'].'/';?>"><?php echo stripcslashes($friend_list['first_name'])." ".stripcslashes($friend_list['last_name']);?></a></h2> </div>
	    <input type="button" class="blueBtn friend_delete" name="friend_delete" id="<?php echo $friend_list['id'];?>" value="Delete">
        </li>
      <?php
      }
      ?>
    	
    </ul>
    <br class="spacer" />
  </div>
  <?php
  }
  ?>
<!--------------------Display All Users------------------------->
<?php
  if(isset($get_all_users) && is_array($get_all_users) && count($get_all_users) > 0 )
  {
  ?>
  <div class="friendList" id="friendList" style="max-height: 400px;overflow-y: auto;">
  	<h2> All User List </h2>
    <ul id="friend" class="ul_friend">
      <?php
      foreach($get_all_users as $get_all_users)
      {
      ?>
        <li id="user_<?php echo $get_all_users['id'];?>">
        	<div class="frImg">
		<?php
				if(isset($get_all_users['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$get_all_users['profile_image']) && $get_all_users['profile_image'] !=''){
				      $profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$get_all_users['profile_image'];
				?>
				<img src="<?php echo $profile_image?>" alt="<?php echo $get_all_users['profile_image'];?>">
				<?php
				}else{
				      $profile_image = IMAGE_UPLOAD_URL."no_img.png";
				?>
				<img src="<?php echo $profile_image?>" alt="no_img.png">
				<?php
				}
			      ?>
		 </div>
            
	  <div class="frNm"> <h2><a href="#"><?php echo stripcslashes($get_all_users['first_name'])." ".stripcslashes($get_all_users['last_name']);?></a></h2> </div>  
	  <div><input type="button" class="blueBtn friend_req_send" name="friend_req_send" id="<?php echo $get_all_users['id'];?>" value="Add Friend"></div>
	</li>
      <?php
      }
      ?>
    	
    </ul>
    <br class="spacer" />
  </div>
  
	   
  <?php
  }
  ?>
<!-------------------------------------------------------------->
</div>
<script>
  $('.friend_delete').click(function(){
			
			var id = $(this).attr('id');
			var friend_req_length = ($('.ul_friend li').length);
				$.ajax({
						
					type: "POST",
						url: "<?php echo FRONTEND_URL; ?>" + "register/friend_delete/",
						data: { 'id': id },
						success: function(msg){
						    if(msg == "success")
						    {
						      if (friend_req_length == 1) {
							$('#friend_list').hide();
						      }
						      $('#friend_'+id).remove();
						    }
						    
						}
				});				
			
		});
  
$(document).on('click', '.friend_decline', function(){			
			var id = $(this).attr('id');
			var friend_req_length = ($('.ul_pending_req li').length);
				$.ajax({
						
					type: "POST",
						url: "<?php echo FRONTEND_URL; ?>" + "register/friend_delete/",
						data: { 'id': id },
						success: function(msg){
						    if(msg == "success")
						    {
						      if (friend_req_length == 1) {
							$('#pending_req').hide();
						      }
						      $('#pending_'+id).remove();
						    }
						    
						}
				});				
			
		});
    $('.friend_req_delete').click(function(){
			
			var id = $(this).attr('id');
			var friend_req_length = ($('.ul_friend_req li').length);
				$.ajax({
						
					type: "POST",
						url: "<?php echo FRONTEND_URL; ?>" + "register/friend_delete/",
						data: { 'id': id },
						success: function(msg){
						    if(msg == "success")
						    {
						      if (friend_req_length == 1) {
							$('#friend_request').hide();
						      }
						      $('#friend_req_'+id).remove();
						    }
						    
						}
				});				
			
		});
        $('.friend_accept').click(function(){
			
			var id = $(this).attr('id');
			var friend_req_length = ($('.ul_friend_req li').length);
			
				$.ajax({
						
					type: "POST",
						url: "<?php echo FRONTEND_URL; ?>" + "register/friend_accept/",
						data: { 'id': id },
						success: function(msg){
						    if(msg != '')
						    {
						      if (friend_req_length == 1) {
							$('#friend_request').hide();
						      }
						      $('#friend_req_'+id).remove();
						      //alert($('#friend').length);
						      if ($('#friend').length == 0 || $('#friend').length == 1)
						      {
							location.reload(); 
						      }
						      else
						      {
						      $('#friend li:last').after(msg);
						      }
						    }
						    
						}
				});				
			
		});
	$(document).on('click', '.friend_req_send', function(){
	  var id = $(this).attr('id');
	  //alert(id);
	  var friend_req_length = ($('.ul_friend_req_send li').length);
				$.ajax({
						
					type: "POST",
						url: "<?php echo FRONTEND_URL; ?>" + "register/friend_req_send/",
						data: { 'id': id },
						success: function(msg){
						    if(msg != '')
						    {
						      if (friend_req_length == 1) {
							$('#searchFriend').hide();
						      }
						      $('#friend_req_send_'+id).remove();
						      
						      if ($('#pending').length == 0 || $('#pending').length == 1) {
							location.reload(); 
						      }
						      else
						      {
						      $('#pending li:last').after(msg);
						      }
						    }
						    
						}
				});	
	  });
	
	$('#text').keyup(function(){
		$('#searchFriend').html('');
		var search_val = $('#text').val().trim();
		if(search_val == '')
		{
		 $('#searchFriend').removeClass('friendList');
		}
		
		if (search_val.length>1) {
				$.ajax({
						
					type: "POST",
						url: "<?php echo FRONTEND_URL; ?>" + "register/friend_search/",
						data: { 'search_val': search_val },
						success: function(msg){
						    if(msg != '' )
						    {
						     $('#searchFriend').addClass('friendList');
						     
						     $('#searchFriend').html(msg);
						    }
						    
						}
				});		  
		}
	  
	})
	
	//$('#search').click(function(){
	//		$('#searchFriend').html('');
	//		var search_val = $('#text').val().trim();
	//		if(search_val == '')
	//		{
	//		 $('#searchFriend').removeClass('friendList');
	//		}
	//			$.ajax({
	//					
	//				type: "POST",
	//					url: "<?php echo FRONTEND_URL; ?>" + "register/friend_search/",
	//					data: { 'search_val': search_val },
	//					success: function(msg){
	//					    if(msg != '' )
	//					    {
	//					     $('#searchFriend').addClass('friendList');
	//					     
	//					     $('#searchFriend').html(msg);
	//					    }
	//					    
	//					}
	//			});				
	//		
	//	});
		
</script>