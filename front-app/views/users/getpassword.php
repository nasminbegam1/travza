  	<div class="content">
    	<div class="page-title">
    		<h1>Recover Password</h1>
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
        	<h2>Reset your password by typing a new one below:</h2>
        	<form action="" method="post" id="form1">
            	<ul class="form-list">
                    <li>
                    	<div class="field">
                        	<label for="password">Password</label>
                            <div class="input-box">
                            	<input type="password" name="pwd" id="pwd" class="input-text required" placeholder="Enter Password" />
                            </div>
                        </div>
                    </li>
		    <li>
                    	<div class="field">
                        	<label for="confirm password">Confirm Password</label>
                            <div class="input-box">
                            	<input type="password" name="cnfpwd" id="cnfpwd" class="input-text required" placeholder="Enter Password Again" />
                            </div>
                        </div>
                    </li>
          
                </ul>
                <div class="formButtons">
		        <input type="hidden" name="action" value="Process"/>
                	<input type="submit" title="CONTINUE" value="Change Password" class="blueBtn"/>
                </div>
            </form>
        </div>
    </div>

<script type="text/javascript">
 $(function () {
    $("#form1").validate({

 rules: {
          
	  pwd: {
		required: true,
		
		},
	  cnfpwd: {
		equalTo: "#pwd"
		},
	  
        },
	messages: {
	    pwd :     "Enter Password",
	    cnfpwd :  "Passwords do not match ",     
	},
        
    });

    
 });
</script>