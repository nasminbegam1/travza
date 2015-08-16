  	<div class="content">

        <?php
        if($isexists>0){
        ?>    
    	<div class="page-title">
    		<h1>email confirmed</h1>
        </div>
        <div class="textCenter">
        	<p>Congratulations <?php echo ucfirst(stripslashes($user_info['first_name']))." ".ucfirst(stripslashes($user_info['last_name']));?> your email is confirmed! </p>
            <p>  Visit your personalized dashboard now to start your <a href="<?php echo FRONTEND_URL.'dashboard/'; ?>">bucket list</a> and view offers and flyers that will save you money.</p> <br/>
	    <p><a href="<?php echo FRONTEND_URL.'login/'; ?>" class="blueBtn">SIGN IN</a></p>
	    </p>
        </div>
        <?php } else {?>
        <div class="page-title">
        <h2>Your activation code is Expired!</h2>
        </div>
        <?php }?>
    </div>
