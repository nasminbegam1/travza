  	<div class="content">
    	<div class="page-title">
    		<h1>user <span>Image</span> update</h1>
        </div>
        <div class="textCenter">
        	<p>Thanks for your interest in TravelDotz, a free service where you can keep track of your bucket list, compare it with your friends,
 and take advantage of great offers from attractions, restaurants and events that interest you!</p>
        </div>
	
      <?php if(isset($succmsg) && $succmsg != '' ){ ?>
	    <div class="alert success-msg display-show" align="center">
	      <p><?php echo stripslashes($succmsg);?></p>
	    </div>			    
      <?php } ?>
	  
      <?php if(isset($errmsg) && $errmsg != ""){ ?>
	<div class="alert err-msg" align="center">
	  <?php for($i=0; $i<count($errmsg); $i++){?>
	  <p><?php echo stripslashes($errmsg[$i]);?></p>
	  <?php }?>
	</div>
      <?php } ?>
			
        <div class="joinForm">
        	<h2>Update Image From Camera:</h2>
        	
            	<ul class="form-list">
			<video id="video" width="500" height="390" autoplay controls="true" src='' type='video/mp4'></video>
			<button id="snap" class="snap">Snap Photo</button>
			<div id="msgDisplayDiv" class="msgDisplay"></div>
			<canvas id="canvas" width="500" height="390"></canvas>	
                </ul>
                <div class="formButtons">
		        <input type="hidden" name="action" value="Process"/>
                	<!--input type="submit" title="CONTINUE" value="CONTINUE" class="blueBtn"/-->
                </div>
            
        </div>
    </div>

<script type="text/javascript">

    // Put event listeners into place
window.addEventListener("DOMContentLoaded", function() {
	// Grab elements, create settings, etc.
	var canvas = document.getElementById("canvas"),
		context = canvas.getContext("2d"),
		video = document.getElementById("video"),
		videoObj = { "video": true },
		errBack = function(error) {
			console.log("Video capture error: ", error.code); 
		};

	// Put video listeners into place
	if(navigator.getUserMedia) { // Standard
		navigator.getUserMedia(videoObj, function(stream) {
			video.src = stream;
			video.play();
		}, errBack);
	} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
		navigator.webkitGetUserMedia(videoObj, function(stream){
			video.src = window.webkitURL.createObjectURL(stream);
			video.play();
		}, errBack);
	}
	else if(navigator.mozGetUserMedia) { // Firefox-prefixed
		navigator.mozGetUserMedia(videoObj, function(stream){
			video.src = window.URL.createObjectURL(stream);
			video.play();
		}, errBack);
	}
        // Trigger photo take
        document.getElementById("snap").addEventListener("click", function() {
                context.drawImage(video, 0, 0, 500, 390);
                var dataURL = canvas.toDataURL();
                //alert(dataURL);
                /**************************/
                $.ajax({
                    type: "POST",
                    url: "<?php echo FRONTEND_URL."register/changeImg";?>",
                    data: { 
                    imgBase64: dataURL
                    },
		    success:function(data) {
			if (data!= '') {
				//alert(data);
				if (data=='1'){
					
					jQuery("#msgDisplayDiv").html("<span style='color:green;'>Profile Image Updated Successfully!</span>");
				}else{
					
					jQuery("#msgDisplayDiv").html("<span style='color:red;'>Profile Image Updated Successfully!</span>");
				}
				window.location.href = "<?php echo FRONTEND_URL?>register/cropAfterClick";
			}
		    }
                })//.done(function(o) {
                    //console.log('saved'); 
                // If you want the file to be visible in the browser 
                // - please modify the callback in javascript. All you
                // need is to return the url to the file, you just saved 
                // and than put the image in your browser.
                //});
                /*************************/
                
        });
}, false);

</script>
 