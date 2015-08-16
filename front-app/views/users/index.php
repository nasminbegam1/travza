  	<div class="content">
	    <div class="breadCamp">
	            <span class="stepOf">
		       Step 1 of 1
		    </span>
	      <div class="breadCampBar">
	         <span class="active"></span>
	         <span class="active"></span>
	      </div>
            </div>
	    
    	<div class="page-title">
	  <h1>user <span>join</span> now</h1>
        </div>
        <div class="textCenter">
        	<p>Thanks for your interest in TravelDotz, a free service where you can keep track of your bucket list, compare it with your friends,
 and take advantage of great offers from attractions, restaurants and events that interest you!</p>
        </div>
	
      <?php if(isset($succmsg) && $succmsg != '' ){ ?>
	    <div class="success-msg display-show" align="center">
	      <p><?php echo stripslashes($succmsg);?></p>
	    </div>			    
      <?php }
       if(isset($errmsg) && $errmsg != ""){ 
      ?>
       <div class="err-msg display-show" align="center">
	      <p><?php echo stripslashes($errmsg);?></p>
	    </div>
	<?php
       }?>
	  <?php if(validation_errors() != FALSE)
	  {	
	?>
	<div class="err-msg" align="center">
		<?php echo validation_errors('<p>', '</p>'); ?>
	</div>
	<?php
	  }
	  ?>
	  
     
			
        <div class="joinForm">
        	<h2>To get started we need a little information:</h2>
        	<form action="" method="post" id="form1">
            	<ul class="form-list">
                	<li>
                    	<div class="field">
                        	<label for="First Name">First Name</label>
                            <div class="input-box">
                            	<input name="first_name" id="first_name" value="<?php echo set_value('first_name');?>" class="input-text required" type="text" />
                            </div>
                        </div>
                    </li>
                    <li>
                    	<div class="field">
                        	<label for="Last Name">Last Name</label>
                            <div class="input-box">
                            	<input name="last_name" id="last_name" value="<?php echo set_value('last_name');?>" class="input-text required" type="text" />
                            </div>
                        </div>
                    </li>
                    <li>
                    	<div class="field">
                        	<label for="Email Address">Email Address</label>
                            <div class="input-box">
                            	<input name="email" id="email"  value="<?php echo set_value('email');?>" class="input-text required email" type="email" />
				<label id="email_msg" class="error" style="display: none;"></label>
                            </div>
                        </div>
                    </li>
		    <li>
                    	<div class="field">
                        	<label for="Password">Password</label>
                            <div class="input-box">
                            	<input name="password" id="password" value="" class="input-text required" type="password" />
                            </div>
                        </div>
                    </li>
		    <li>
                    	<div class="field">
                        	<label for="Gender">Gender</label>
                            <div >
                            	<input name="gender" id="gender" value="M" class="input-text required" type="radio" checked="checked"/> Male
				<input name="gender" id="gender" value="F" class="input-text required" type="radio" /> Female
                            </div>
                        </div>
                    </li>
		    
		    
		    
		    
		    <li class="fields">
                    	<div class="field">
                        	<label for="Country">Address</label>
                            <div class="input-box">
				<textarea name="address" id="address"></textarea>
			    </div>
                        </div>
		    </li>
		    
			
                    <li class="fieldsTwo">
                    	<div class="field">
                        	<label for="Country">Country</label>
                            <div class="input-box">
			        <select name="country" id="country" class="required" onChange="country_chk(this.value)">
				    <option value="">Select Country</option>
				    <?php
				    foreach($countries as $country){?>
				    <option value="<?php echo $country['id']?>" <?php if($country['id'] == '1'){ ?> selected="selected"<?php } ?>><?php echo $country['country_name']?></option>
				    <?php }?>
				</select>
                            </div>
                        </div>
                        <div class="field">
                        	<label for="City">City</label>
                            <div class="input-box">
                            	<input name="city" id="city" value="<?php echo set_value('city');?>" class="input-text required" type="text" />
                            </div>
                        </div>
                    </li>
                    <li class="fieldsTwo">
                    	<div class="field stateList">
                        	<label for="State">State</label>
                            <div class="input-box"> 
				<select name="state" id="state" class="required">
				 <?php
				 if(is_array($states) && count($states) > 0)
				    foreach($states as $state_list){?>
				    <option value="<?php echo $state_list['default_name']?>" ><?php echo $state_list['default_name']?></option>
				    <?php }?>
                            	</select>
                           </div>
                        </div>
                        <div class="field">
                        	<label for="Zip">Zip</label>
                            <div class="input-box">
                            	<input name="zip" id="zip" value="<?php echo set_value('zip');?>" class="input-text required" type="text" />
                            </div>
                        </div>
			
		        
			
                    </li>
		    <li class="fields">
                    	<div class="field">
                        	<label for="Country">Age Range</label>
                            <div class="input-box">
				<select name="age" id="age" class="required">
				 <option value="">Select Age Range</option>	
				<?php
				 if(is_array($age_range) && count($age_range) > 0)
				    foreach($age_range as $age_range_list){?>
				    <option value="<?php echo $age_range_list['id']?>" ><?php echo $age_range_list['label_value']?></option>
				<?php }?>
				    
				</select>
			    </div>
                        </div>
		    </li>
		                        <li>
                    	<div class="field">
                        	<label for="What Kind of Traveler are you?">What Kind of Traveler are you?</label>
                            <div class="input-box newCheck">
                            	
                                    <?php
				    if(is_array($travel_type) && count($travel_type) > 0)
				    {
					foreach($travel_type as $travel){
				    ?>
				    <div class="chk">
					<input type="checkbox" class="required"
					       name="traveler_type[]" id="traveler_type" value="<?php echo $travel['id'];?>"/> <?php echo stripslashes($travel['type_name']);?></div>
				    <?php
					}
				    }
				    ?>
                               
                            </div>
                        </div>
                    </li>

                </ul>
                <div class="formButtons regButton">
		        <input type="hidden" name="action" value="Process"/>
			
			<li>
			    By signing up, you agree to the
			    <a class="masterTooltip" href="javascriptvoid:(0)" title="Terms of Service">Terms of Service</a>
			    and <a class="masterTooltip" href="javacsriptvoid:(0)" title="Privacy Policy">Privacy Policy</a>
			</li>
			<br/>
                	<input type="submit" title="CONTINUE" value="CONTINUE" class="blueBtn"/>
                </div>
            </form>
        </div>
    </div>
    
<!-----------------Tooltip------------------------->
<script type="text/javascript">
$(document).ready(function() {
        // Tooltip only Text
        $('.masterTooltip').hover(function(){
                // Hover over code
                var title = $(this).attr('title');
                $(this).data('tipText', title).removeAttr('title');
                $('<p class="tooltip"></p>')
                .text(title)
                .appendTo('body')
                .fadeIn('slow');
        }, function() {
                // Hover out code
                $(this).attr('title', $(this).data('tipText'));
                $('.tooltip').remove();
        }).mousemove(function(e) {
                var mousex = e.pageX + 20; //Get X coordinates
                var mousey = e.pageY + 10; //Get Y coordinates
                $('.tooltip')
                .css({ top: mousey, left: mousex })
        });
});
</script>
<!------------------------------------------------->
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
$('#email').blur(function(){
	var email = $('#email').val();
	$.ajax({
	       type: 'post',
	       url: '<?php echo FRONTEND_URL."register/chkEmailExists";?>',
	       data: {email: email},
	       success: function(msg){
		if (msg == 1) {
			$('#email_msg').show();
			$('#email_msg').html('Email already exists');
			$('.blueBtn').attr('type','button');
		}
		else
		{
			$('#email_msg').hide();
			$('.blueBtn').attr('type','submit');
		}
		
		//alert(msg);
		
	       }
	       
	});
	
	
	});	
	
	
 $(function () {
    $("#form1").validate({

	messages: {
	    "first_name": {
		required: "Please enter your first name",
		
	    },
	    "last_name": {
		required: "Please enter your last name",
		
	    },
	    "email": {
		required: "Please enter your email address",
		
	    },
	    "country": {
		required: "Please select country",
		
	    },
	    "city": {
		required: "City should not be blank",
		
	    },
	    "state": {
		required: "State should not be blank",
		
	    },
	    "zip": {
		required: "Zip should not be blank",
		
	    },
	    "address":
	    {
		required: "Please enter adress"
	    },
	    "traveler_type":
	    {
		
		required:"Please select travel type",
		
	    }, 
	},
 
    });
 });
</script>