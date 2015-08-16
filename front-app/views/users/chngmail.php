   <?php if(isset($succmsg) && $succmsg != '' ){ ?>
	    <div class="success-msg display-show" align="center">
	      <p><?php echo stripslashes($succmsg);?></p>
	    </div>			    
      <?php }
       $errmsg=$this->nsession->userdata('errmsg');
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
          <div class="content">
    	<div class="page-title">
    		<h1>email<span>confirmation</span></h1>
        </div>
        <div class="joinForm">
        	<form action="<?php echo FRONTEND_URL?>register/chng_mail/" method="post" id="form1">
                    <ul class="form-list">
                        <li>
                    	<div class="field">
                        	<label for="Email Address">Email Address</label>
                            <div class="input-box">
                            	<input name="email" id="email"  value="<?php echo set_value('email');?>" class="input-text required email" type="email" />
				<label id="email_msg" class="error" style="display: none;"></label>
                            </div>
                        </div>
                        </li>
                    </ul>
                        <div class="formButtons regButton">
		            <input type="hidden" name="action" value="Process"/>
                	    <input type="submit" title="CONTINUE" value="CONTINUE" class="blueBtn"/>
                        </div>
                </form>       
        </div>
    </div>
          
    <script type="text/javascript">
	
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
        //rules: {
	    //province: { required: true },
	    //tradin_desk: { rolecheck: true },
        //},
	messages: {
	    
	    "email": {
		required: "Please enter your email address",
		
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
    
 });
</script>      