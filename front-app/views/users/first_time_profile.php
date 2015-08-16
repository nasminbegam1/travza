<!-- jQuery Form Validation code -->
  <script>

  $(function() {
  
    // Setup form validation on the #register-form element
    $("#firstTimeProfile").validate({
   

        // Specify the validation rules
        rules: {
          
          //'apply_to[]': {
          //    required: true,
          //    minlength: 1
          //},
           born_year: "required",
	   traveler_type: "required",
	   //received_updates: "required",
	  
        },
        
        // Specify the validation error messages
        messages: {
          
	    born_year:    "Please enter your born year",
	    
//	    'apply_to[]': {
//              required: 'Please select at least one!'  ,
//              minlength: 'Please select at least one!'
//          },
	    
	    traveler_type:  "Please select travel type",
	    //received_updates:  "Select Domestic or International",
	   
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
</script>
  
  <!-- Start : Main Container --> 
  <!--<div class="main-container">-->
  	<div class="content">
    	<div class="page-title">
    		<h1>tell  us <span>About yourself</span></h1>
        </div>
        <div class="textCenter">
        	<p>Before we go to the dashboard, let's get a little more information so we can provide you with the best activities, restaurants and events possible, 
and so that your friends can find you.</p>
		
				<?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
					   <?php if(isset($succmsg) && $succmsg != ""){?>
                                            <div align="center">
                                                <div class="nNote nSuccess" style="width: 600px;color:green;">
                                                    <p><?php echo stripslashes($succmsg);?></p>
                                                </div>
                                            </div>
                                        <?php }
					if(isset($errmsg) && $errmsg != "")
					{
				        ?>
					<div align="center">
                                                <div class="nNote nSuccess" style="width: 600px;color:red;">
                                                    <p><?php echo stripslashes($errmsg);?></p>
                                                </div>
                                            </div>
				       <?php
					}
					?>
		
        </div>
        <div class="visitForm">
	  <h2>To get started we need a little information:</h2><br/>
        	<form method="post" enctype="multipart/form-data" name="firstTimeProfile" id="firstTimeProfile" class="form-validate"  novalidate="novalidate">
		  <input type="hidden" name="action" value="Process">
            	<ul class="form-list">
                	<li>
                    	<div class="field">
                        	<label for="Upload your Profile Image">Upload your Profile Image</label>
                            <div class="input-box">
                            	<div class="upload_button_outer clearfix"> 
    								<div class="filename">Choose a file...</div>
    									<div class="uploadbtn">
      									<div class="upload">&nbsp;</div>
      										<input type="file" id="profile_img" name="profile_img"/>
    									</div>
  								</div>	
                            </div>
                        </div>
                    </li>
                    <li>
                    	<div class="field">
                        	<label for="What year were you born?">What year were you born?</label>
                            <div class="input-box">
                            	<select name="born_year" id="born_year">
                                	<option value="">Select</option>
			                  <?php
					  for($x = date("Y"); $x >= 1950; $x--)
					  {
					  ?>
					  <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
					  <?php
					  }
					  ?>			
					  
	                          </select>
					    
                            </div>
                        </div>
                    </li>
                    <li>
                    	<div class="field">
                        	<label for="Which of the following applies to you?">Which of the following applies to you?</label>
                            <div class="input-box">
			      <?php
			      if(is_array($profession_type) && count($profession_type) > 0)
				    {
					foreach($profession_type as $profession){
				    ?>
				    <div class="chk"><input type="checkbox" name="apply_to[]" id="apply_to" value="<?php echo $profession['id'];?>"/><?php echo stripslashes($profession['profession_name']);?></div>
				    <?php
					}
				    }
			       ?>
			      
                            	
                            </div>
                        </div>
                    </li>
                    <li>
                    	<div class="field">
                        	<label for="What Kind of Traveler are you?">What Kind of Traveler are you?</label>
                            <div class="input-box">
                            	
                                    <?php
				    if(is_array($travel_type) && count($travel_type) > 0)
				    {
					foreach($travel_type as $travel){
				    ?>
				     
				     <div class="chk"><input type="checkbox" name="traveler_type[]" id="traveler_type" value="<?php echo $travel['id'];?>"/><?php echo stripslashes($travel['type_name']);?></div>
				    <?php
					}
				    }
				    ?>
                               
                            </div>
                        </div>
                    </li>
                    <li>
                    	<div class="field">
                            <div class="input-box">
                            	<div class="chk"><input type="checkbox" name="received_updates" id="received_updates" value="Yes"/>Receive updates from the vendors on your bucket list?</div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="formButtons">
                	<input name="name" title="Continue" value="Continue" class="blueBtn" type="submit" />
                </div>
            </form>
        </div>
    </div>
  <!--</div>-->
<!-- End : Main Container -->

<script type="text/javascript">
$(document).ready(function() {
$('#profile_img').change(function(){
	$('.filename').html($(this).val());
});
});
</script>