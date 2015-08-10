 
        <form action="<?php echo BACKEND_URL; ?>login/do_forgotpassword/" method="post" id="register_form" class="form form-validate-signin">
	<div style="text-align: center; border-bottom: 1px solid #ccc;  padding-top:10px;">
            <img src="<?php echo FRONTEND_URL.'images/logo3.png'; ?>" title="" />
        </div>
        <div class="body-content">
            
            <?php if(!empty($msg)){?>
                  <!-- <div class="login_head">-->
                         <div class="nNote nFailure" align="center" style="color:red;"><p><?php echo $msg;?></p></div>
                    <!--</div>-->
             <?php } ?>
            
				<div class="form-group">
                                    <div class="input-icon right"><i class="fa fa-user"></i>
                                            <input type="email" placeholder="Email" name="email" class="form-control required email" value="">
                                    </div>
                                </div>
				<div class="form-group pull-right">
                                    <button type="submit" class="btn btn-success">Get Password
                                        &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
                                </div>
				<div class="text-center">
					<p><small>Never mind, <a href="<?php echo BACKEND_URL.'login' ?>" class='btn-forgot-pwd'>send me back to the sign-in screen</a></small></p>
				</div>
			
		</div>
	</form>