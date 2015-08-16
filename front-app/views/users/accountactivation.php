  	<div class="content">
    	<div class="page-title">
    		<h1>Update Password</h1>
        </div>
        <div class="textCenter">
        	<p>Thanks for your interest in TravelDotz, a free service where you can keep track of your bucket list, compare it with your friends,
 and take advantage of great offers from attractions, restaurants and events that interest you!</p>
        </div>
	
      <?php if(isset($succmsg) && $succmsg != '' ){ ?>
	    <div class="alert alert-success display-show" align="center">
	      <p><?php echo stripslashes($succmsg);?></p>
	    </div>			    
      <?php } ?>
	  
      <?php if(isset($errmsg) && $errmsg != ""){ ?>
	<div class="alert alert-danger" align="center">
	  <?php for($i=0; $i<count($errmsg); $i++){?>
	  <p><?php echo stripslashes($errmsg[$i]);?></p>
	  <?php }?>
	</div>
      <?php } ?>
			
        <div class="joinForm">
        	<h2>To activate your account, please update your password:</h2>
        	<form action="" method="post" id="form1">
            	<ul class="form-list">
                    <li>
                    	<div class="field">
                        	<label for="Last Name">Password</label>
                            <div class="input-box">
                            	<input name="password" id="password" value="" class="input-text required" type="password" />
                            </div>
                        </div>
                    </li>
                    <li>
                    	<div class="field">
                        	<label for="Email Address">Confirm Password</label>
                            <div class="input-box">
                            	<input name="confirm_password" id="confirm_password" value="" class="input-text" type="password" />
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="formButtons">
		        <input type="hidden" name="action" value="Process"/>
                        <input type="hidden" name="activationcode" value="<?php echo $activation_code?>"/>
                	<input type="submit" title="CONTINUE" value="Update" class="blueBtn"/>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">
 $(function () {
    $("#form1").validate({
        rules: {
            password: { minlength: 6 },
            
	    confirm_password: {
                blankcheck: true,
                passwordCheck: true
                },
        },
	messages: {
	    "password": {
                required : 'Please insert your password',
		minlength: "Password should be at least {0} characters",
	    },
	},
        //errorPlacement: function(error, element)
        //{
        //    error.insertAfter(element);
        //}
    });
//    $( "#tradin_desk" ).rules( "add", {
//	rolecheck: true
//    });

    $.validator.addMethod("blankcheck",function (value,element){
          if($("#password").val()!='' && value==''){
            return 0;
          }else{
            return 1;
          }
    }, 'Please enter Confirm Password');

    $.validator.addMethod("passwordCheck",function (value,element){
          return value==$("#password").val(); 

    }, 'Password and Confirm Password should be same');
    
 });
</script>