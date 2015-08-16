  	<?php //SESSION_START(); ?>
	<div class="content">
    	<div class="page-title">
    		<h1>email <span>confirmation</span></h1>
        </div>
        <div class="textCenter">
        	<p>Thanks for your registration!  We want to make sure we have your email address correct. </p>
            <p> Please check your email and click on the email confirmation link. </p>
        </div>
	<div class="textCenter">
            <p style="color:red;"> if <?php echo $this->nsession->userdata('confirm_user_email'); ?> is not your correct email, click <a href="<?php echo FRONTEND_URL?>register/chng_mail/">here</a> to correct it. </p>
        </div>
    </div>
