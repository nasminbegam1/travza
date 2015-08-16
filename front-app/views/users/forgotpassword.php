  	<div class="content">
    	<div class="page-title">
    		<h1>Forgot Password</h1>
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
	 
	  <p><?php echo stripslashes($errmsg);?></p>
	 
	</div>
      <?php } ?>
			
        <div class="joinForm">
        	<h2>Enter your Email to Get Password:</h2>
        	<form action="" method="post" id="form1">
            	<ul class="form-list">
                    <li>
                    	<div class="field">
                        	<!--<label for="Last Name">Email</label>-->
                            <div class="input-box">
                            	<input name="email" id="email" value="" autocomplete="off" class="input-text required email" type="text" />
                            </div>
                        </div>
                    </li>
          
                </ul>
                <div class="formButtons">
		        <input type="hidden" name="action" value="Process"/>
                	<input type="submit" title="Get Password" value="Get Password" class="blueBtn"/>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">
 $(function () {
    $("#form1").validate({
	messages: {
	    "email": {
                required : 'Please enter your Email Address',
	    },            
	},
    });

    
 });
</script>