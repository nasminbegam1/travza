	<?php //pr($this->data);?>
	<div class="content">
    	<div class="page-title">
    		<h1>Sign In</h1>
        </div>
        <div class="textCenter">
        	<p></p>
        </div>
	
      <?php if(isset($succmsg) && $succmsg != '' ){ ?>
	    <div class="alert alert-success display-show success-msg" align="center">
	      <p><?php echo stripslashes($succmsg);?></p>
	    </div>			    
      <?php } ?>
	  
      <?php if(isset($errmsg) && $errmsg != ""){ ?>
	<div class="alert alert-danger err-msg" align="center">
	  <?php for($i=0; $i<count($errmsg); $i++){?>
	  <p><?php echo stripslashes($errmsg[$i]);?></p>
	  <?php }?>
	</div>
      <?php } ?>
			
        <div class="joinForm">
        	<h2>Account Login:</h2>
        	<form action="" method="post" id="form1">
		<input type="hidden" name="prev_link" value="<?php echo (!empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '')?>" />
            	<ul class="form-list">
                    <li>
                    	<div class="field">
                        	<label for="Last Name">Email</label>
                            <div class="input-box">
                            	<input name="email" id="email" value="<?php echo $email;?>" autocomplete="off" class="input-text required email" type="text" />
                            </div>
                        </div>
                    </li>
                    <li>
                    	<div class="field">
                        	<label for="Email Address">Password</label>
                            <div class="input-box">
                            	<input name="password" id="password" title="Please enter Password" class="input-text required" type="password" value="<?php echo $password;?>" />
                            </div>
                        </div>
                    </li>
		    <li>
                    	<div class="field">
                            <div class="input-box">
                            	<input name="remember_me" id="remember_me" type="checkbox" <?php if(isset($_COOKIE['remember_me'])){?> checked <?php } ?>/>
				<label for="Remember Me">Remember Me</label>
                            </div>
			    
                        </div>
                    </li>
		    <li>
                    	<div class="field">
                        	<label><a href="<?php echo FRONTEND_URL.'login/forgotpassword' ?>">Forgot your password? </a></label>
                        </div>
                    </li>
                </ul>
                <div class="formButtons">
		        <input type="hidden" name="action" value="Process"/>
                	<input type="submit" title="CONTINUE" value="Sign In" class="blueBtn"/>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">
 $(function () {
    $("#form1").validate({
//        rules: {
//            password: { minlength: 6 },
//                    },
	messages: {
	    "email": {
                required : 'Please enter your Email Address',
	    },            
	},
        //errorPlacement: function(error, element)
        //{
        //    error.insertAfter(element);
        //}
    });

    
 });
</script>