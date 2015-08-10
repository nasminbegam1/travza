    <form action="<?php echo BACKEND_URL.'login/do_login/' ?>" class="form form-validate-signin" method="post">
       
        <div class="header-content">
		<div style="text-align: center; border-bottom: 1px solid #ccc; padding-bottom: 10px;"><img src="<?php echo FRONTEND_URL.'images/logo.png'; ?>" title="" /></div>
		<!--<h1>Log In</h1>-->
	</div>
        <div class="body-content">
	    <?php if(!empty($msg)){?>
                  
                         <div class="nNote nFailure" align="center" style="color:red;"><p><?php echo $msg;?></p></div>
                   
             <?php } ?>
            <div class="form-group">
                <div class="input-icon right"><i class="fa fa-user"></i>
			<input type="email" placeholder="Email" name="email" class="form-control required email" value="">
		</div>
            </div>
            <div class="form-group">
                <div class="input-icon right"><i class="fa fa-key"></i><input type="password" placeholder="Password" name="password" class="form-control required password" value=""></div>
            </div>
            <div class="form-group pull-left">
               <!-- <div class="checkbox-list"><label><input type="checkbox">&nbsp;
                    Keep me signed in</label></div>-->
            </div>
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-success">Log In
                    &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
            </div>
            <div class="clearfix"></div>
	    <hr>
            <div class="forget-password"><h4>Forgotten your Password?</h4>

                <p>no worries, click <a href="<?php echo BACKEND_URL.'login/forgotpassword' ?>" class='btn-forgot-pwd'>here</a> to retrieve your password.</p>
	    </div>            
	</div>
    </form>