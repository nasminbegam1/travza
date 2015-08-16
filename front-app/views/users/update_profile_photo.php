   <script type="text/javascript">
 
      function fileSelected() {
 
        var count = document.getElementById('fileToUpload').files.length;
 
              document.getElementById('details').innerHTML = "";
 
              for (var index = 0; index < count; index ++)
 
              {
 
                     var file = document.getElementById('fileToUpload').files[index];
 
                     var fileSize = 0;
 
                     if (file.size > 1024 * 1024)
 
                            fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
 
                     else
 
                            fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
 
                     document.getElementById('details').innerHTML += 'Name: ' + file.name + '<br>Size: ' + fileSize + '<br>Type: ' + file.type;
 
                     document.getElementById('details').innerHTML += '<p>';
 
              }
	      
 
      }
 
      function uploadFile() {
 
        var fd = new FormData();
 
              var count = document.getElementById('fileToUpload').files.length;
 
              for (var index = 0; index < count; index ++)
 
              {
 
                     var file = document.getElementById('fileToUpload').files[index];
 
                     fd.append('myFile', file);
 
              }
 
        var xhr = new XMLHttpRequest();
 
        xhr.upload.addEventListener("progress", uploadProgress, false);
 
        xhr.addEventListener("load", uploadComplete, false);
 
        xhr.addEventListener("error", uploadFailed, false);
 
        xhr.addEventListener("abort", uploadCanceled, false);
 
        xhr.open("POST", "<?php echo FRONTEND_URL;?>register/savecamimg");
 
        xhr.send(fd);
	
	
 
      }
 
      function uploadProgress(evt) {
 
        if (evt.lengthComputable) {
 
          var percentComplete = Math.round(evt.loaded * 100 / evt.total);
 
          document.getElementById('progress').innerHTML = percentComplete.toString() + '%';
 
        }
 
        else {
 
          document.getElementById('progress').innerHTML = 'unable to compute';
 
        }
 
      }
 
      function uploadComplete(evt) {
 
        /* This event is raised when the server send back a response */
 
		//alert(evt.target.responseText);
		/*if (evt.target.responseText=='1') {
			//alert("Success");
			$( "#form1" ).submit();
			
		}else{
			//alert("Error Uploading File!");
			$( "#form1" ).submit();
		}*/
		//if (evt.target.responseText!='') {
			//alert("Success");
			$( "#form1" ).submit();
			
		/*}else{
			alert("Error in Updating Profile!");
		}*/
		
 
      }
 
      function uploadFailed(evt) {
 
        alert("There was an error attempting to upload the file.");
 
      }
 
      function uploadCanceled(evt) {
 
        alert("The upload has been canceled by the user or the browser dropped the connection.");
 
      }
 
    </script>
   
  	<div class="content">
    	<div class="page-title">
    		<h1>Edit <span> User </span> Profile</h1>
        </div>
        <div class="textCenter">
        	<p>Thanks for your interest in TravelDotz, a free service where you can keep track of your bucket list, compare it with your friends,
 and take advantage of great offers from attractions, restaurants and events that interest you!</p>
        </div>
	
      <?php if(isset($succmsg) && $succmsg != '' ){ ?>
	    <div class="alert success-msg display-show" align="center">
	      <p><?php echo stripslashes($succmsg);?></p>
	    </div>			    
      <?php } ?>
	  
      <?php if(isset($errmsg) && $errmsg != ""){ ?>
	<div class="alert err-msg" align="center">
	  <?php for($i=0; $i<count($errmsg); $i++){?>
	  <p><?php echo stripslashes($errmsg[$i]);?></p>
	  <?php }?>
	</div>
      <?php }
      //echo $user_profile[0]['age_range'];
      
      ?>
			
        <div class="joinForm">
        	<!--<h2>To get started we need a little information:</h2>-->
        	<form action="" method="post" id="form1" enctype="multipart/form-data">
            	<ul class="form-list">
                	<li style="display: none">
                    	<div class="field">
                        	<label for="First Name">First Name</label>
                            <div class="input-box">
                            	<input name="first_name" id="first_name" value="<?php echo stripslashes($user_profile[0]['first_name']);?>" class="input-text required" type="text" />
                            </div>
                        </div>
                    </li>
			
                    <li style="display: none">
                    	<div class="field">
                        	<label for="Last Name">Last Name</label>
                            <div class="input-box">
                            	<input name="last_name" id="last_name" value="<?php echo stripslashes($user_profile[0]['last_name']);?>" class="input-text required" type="text" />
                            </div>
                        </div>
                    </li>
		    
		    <li style="display: none">
                    	<div class="field">
                        	<label for="Password">Password</label>
                            <div class="input-box">
                            	<input name="password" id="password" value="" class="input-text" type="password" placeholder="Please leave it blank if you don't want to change password"/>
                            </div>
                        </div>
                    </li>
                   <li style="display: none">
                    	<div class="field">
                        	<label for="Gender">Gender</label>
                            <div >
                            	<input name="gender" id="gender" value="M" class="input-text required" type="radio" <?php if(stripslashes($user_profile[0]['gender'])=='M'){echo "checked='checked'";}?>/> Male
				<input name="gender" id="gender" value="F" class="input-text required" type="radio" <?php if(stripslashes($user_profile[0]['gender'])=='F'){echo "checked='checked'";}?>/> Female
                            </div>
                        </div>
                    </li>
		    <li class="fields" style="display: none">
                    	<div class="field">
                        	<label for="Country">Address</label>
                            <div class="input-box">
				<textarea name="address" id="address"><?php echo stripslashes($user_profile[0]['address']);?></textarea>
			    </div>
                        </div>
		    </li>
		    
		    <li class="fieldsTwo" style="display: none">
                    	<div class="field">
                        	<label for="Country">Country</label>
                            <div class="input-box">
			        <select name="country" id="country" class="required" onChange="country_chk(this.value)">
				    <option value="">Select Country</option>
				    <?php foreach($countries as $country){?>
				    <option value="<?php echo $country['id']?>" <?php if($country['id'] == $user_profile[0]['country']){echo "selected='selected'"; }?>><?php echo $country['country_name']?></option>
				    <?php }?>
				</select>
                            </div>
                        </div>
                        <div class="field" style="display: none">
                        	<label for="City">City</label>
                            <div class="input-box">
                            	<input name="city" id="city" value="<?php echo stripslashes($user_profile[0]['city']);?>" class="input-text required" type="text" />
                            </div>
                        </div>
                    </li>
                    <li class="fieldsTwo" style="display: none">
                    	<div class="field stateList">
                        	<label for="State">State</label>
                            <div class="input-box">
				<?php
				 if(is_array($states) && count($states) > 0)
				 {
				    ?>
				  <select name="state" id="state" class="required">
				 <?php
				    foreach($states as $state_list){
					  ?>
				    <option value="<?php echo $state_list['default_name'];?>" <?php if(isset($user_profile[0]['state'])){if(stripslashes($user_profile[0]['state']) == $state_list['default_name']){echo "selected='selected'";}}?>><?php echo $state_list['default_name']?></option>
				    <?php }?>
                            	</select>
				  <?php
				 }
				 else
				 {
				    ?>
				
				<input name="state" id="state" value="<?php echo stripslashes($user_profile[0]['state']);?>" class="input-text required" type="text" />
				 <?php
				 }
				 ?>
                            	
                            </div>
                        </div>
                        <div class="field">
                        	<label for="Zip">Zip</label>
                            <div class="input-box">
                            	<input name="zip" id="zip" value="<?php echo stripslashes($user_profile[0]['zip']);?>" class="input-text required" type="text" />
                            </div>
                        </div>
                    </li>
		    <li class="fields" style="display: none">
                    	<div class="field">
                        	<label for="Country">Age Range</label>
                            <div class="input-box">
				<select name="age" id="age" class="required">
				    <option value="">Select Age Range</option>	
				<?php
				 if(is_array($age_range) && count($age_range) > 0)
				    foreach($age_range as $age_range_list){?>
				    <option value="<?php echo $age_range_list['id']?>" <?php if(isset($user_profile[0]['age_range'])){if(stripslashes($user_profile[0]['age_range']) == $age_range_list['id']){echo "selected='selected'";}}?> ><?php echo $age_range_list['label_value']?></option>
				<?php }?>
				    
				</select>
			    </div>
                        </div>
		    </li>
		    <li style="display: none">
                    	<div class="field">
                        	<label for="What Kind of Traveler are you?">What Kind of Traveler are you?</label>
                            <div class="input-box">
                            	
                                    <?php
				    
				     $app = array();
				     $type = explode(",",$user_profile[0]['traveler_type']);
				    
				     for($i=0; $i<count($type);$i++)
				      {
				       array_push($app,$type[$i]);
				      }
				  
				    if(is_array($travel_type) && count($travel_type) > 0)
				    {
					foreach($travel_type as $travel){
				    ?>
				     
				     <div class="chk"><input type="checkbox" name="traveler_type[]" id="traveler_type" value="<?php echo $travel['id'];?>" <?php if(isset($type) && in_array($travel['id'],$app)){echo 'checked="checked"';}?>/><?php echo stripslashes($travel['type_name']);?></div>
				    <?php
					}
				    }
				    ?>
                               
                            </div>
                        </div>
                    </li>
		    <li>
                    	<div class="field">
                            <label for="Profile Image">Profile Image</label>
                            <div class="input-box">
				<label for="fileToUpload">Upload your photo</label><br />
 
				<!--<input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected(); previewImage(this,'.prevImg','110','110');" accept="image/*" capture="camera" />-->
                            	<input name="profile_image" id="profile_image" class="input-text" type="file">
				 <br>
				    <div class="imgNote">Image must be in between 600px X 400px or 200px X 140px
				    </div>
                            </div>
			    <br>
				<div id="details"></div>
				<br/>
				 <div id="progress"></div>
				 
				 
				 <?php
				if(isset($user_profile[0]['profile_image']) && file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'siteuser/thumb/'.$user_profile[0]['profile_image']) && $user_profile[0]['profile_image'] !='')
				{
				    $profile_image = IMAGE_UPLOAD_URL."siteuser/thumb/".$user_profile[0]['profile_image'];
				}
				else
				{
				    $profile_image = IMAGE_UPLOAD_URL."no_img.png";
				}
				?>
				 
				 <div class="profileImg">
				    <span id="dashboardProfileImg">
				       <img alt="User Image" src="<?php echo $profile_image?>">
				    </span>
				     
				 </div>
			</div>
                    </li>
                </ul>
                <div class="formButtons">
		        <input type="hidden" name="action" value="Process"/>
                	<!--<input type="button" onclick="uploadFile()" title="CONTINUE" value="CONTINUE" class="blueBtn"/>-->
			<input type="submit" title="Save" value="Save" class="blueBtn" id="continue" />
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">
 $(function () {
    $("#form1").validate({
	messages: {
	    "first_name": {required: "Please enter your first name" },
	    "last_name": {required: "Please enter your last name" },
	    "country": {required: "Please select country"},
	    "city": {required: "City should not be blank"},
	    "state": {required: "State should not be blank"},
	    "zip": {required: "Zip should not be blank"},		    
	},
    });
 });
</script>
  <script type="text/javascript">
      function country_chk(str)
	{
		var country_id = str;
			$.ajax({
			       type: "POST",
			       url: '<?php echo FRONTEND_URL."state/chkstateExists";?>',
			       data: {country_id: country_id},
			       success:function(data) {
					if (data!= '') {
						$('.stateList').html(data);
					}
			       }	
				});
	
	}
	
	var _URL = window.URL || window.webkitURL;
	
	$("#profile_image").change(function(e) {
	 var file, img;


	 if ((file = this.files[0])) {
	    img = new Image();
	    img.onload = function() {
	       if (this.width < 200)
	       {
		  alert('Image width must be greater than 140px');
		  $('#continue').attr('disabled',true);
	       }
	       else if (this.height < 140)
	       {
		  alert('Image height must be greater than 120px');
		  $('#continue').attr('disabled',true);
	       }
	//       if (this.width > 600)
	//       {
	//	  alert('Image width must not be greater than 600px');
	//	  $('#continue').attr('disabled',true);
	//       }
	//       else if (this.height > 400)
	//       {
	//	  alert('Image height must not be greater than 400px');
	//	  $('#continue').attr('disabled',true);
	//       }
	       else
	       {
		  $('#continue').attr('disabled',false);
	       }
	    };
	    img.onerror = function() {
		alert( "not a valid file: " + file.type);
	    };
	    img.src = _URL.createObjectURL(file);
	 }

});
  </script>