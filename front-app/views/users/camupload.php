    <script type="text/javascript">
 
      function fileSelected() {
 
        var count = document.getElementById('fileToUpload').files.length;
 
              document.getElementById('details').innerHTML = "";
 
              for (var index = 0; index < count; index ++)
 
              {
 
                     var file = document.getElementById('fileToUpload').files[index];
 
                     var fileSize = 0;
 
                     if (file.size > 1024 * 1024)
 
                            fileSize = (Math.round(file.size * 100 / (1024 * 1024)) / 100).toString() + 'MB';
 
                     else
 
                            fileSize = (Math.round(file.size * 100 / 1024) / 100).toString() + 'KB';
 
                     document.getElementById('details').innerHTML += 'Name: ' + file.name + '<br>Size: ' + fileSize + '<br>Type: ' + file.type;
 
                     document.getElementById('details').innerHTML += '<p>';
 
              }
 
      }
 
      function uploadFile() {
 
        var fd = new FormData();
 
              var count = document.getElementById('fileToUpload').files.length;
 
              for (var index = 0; index < count; index ++)
 
              {
 
                     var file = document.getElementById('fileToUpload').files[index];
 
                     fd.append('myFile', file);
 
              }
 
        var xhr = new XMLHttpRequest();
 
        xhr.upload.addEventListener("progress", uploadProgress, false);
 
        xhr.addEventListener("load", uploadComplete, false);
 
        xhr.addEventListener("error", uploadFailed, false);
 
        xhr.addEventListener("abort", uploadCanceled, false);
 
        xhr.open("POST", "<?php echo FRONTEND_URL;?>dashboard/savecamimg");
 
        xhr.send(fd);
 
      }
 
      function uploadProgress(evt) {
 
        if (evt.lengthComputable) {
 
          var percentComplete = Math.round(evt.loaded * 100 / evt.total);
 
          document.getElementById('progress').innerHTML = percentComplete.toString() + '%';
 
        }
 
        else {
 
          document.getElementById('progress').innerHTML = 'unable to compute';
 
        }
 
      }
 
      function uploadComplete(evt) {
 
        /* This event is raised when the server send back a response */
 
        alert(evt.target.responseText);
 
      }
 
      function uploadFailed(evt) {
 
        alert("There was an error attempting to upload the file.");
 
      }
 
      function uploadCanceled(evt) {
 
        alert("The upload has been canceled by the user or the browser dropped the connection.");
 
      }
 
    </script>

<!-- Start : Main Container --> 
  <div class="main-container">
  	<div class="content">
    	<div class="page-title">
    		<h1><span>Upload Image With Camera</span></h1>
        </div>
        <div class="textCenter">
        	<!--p>Before we go to the dashboard, let's get a little more information so we can provide you with the best activities, restaurants and events possible, 
and so that your friends can find you.</p-->
		
				<?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
					   <?php if(isset($succmsg) && $succmsg != ""){?>
                                            <div align="center">
                                                <div class="nNote nSuccess" style="width: 600px;color:green;">
                                                    <p><?php echo stripslashes($succmsg);?></p>
                                                </div>
                                            </div>
                                        <?php }
					if(isset($errmsg) && $errmsg != "")
					{
				        ?>
					<div align="center">
                                                <div class="nNote nSuccess" style="width: 600px;color:red;">
                                                    <p><?php echo stripslashes($errmsg);?></p>
                                                </div>
                                            </div>
				       <?php
					}
					?>
		
        </div>
        <div class="visitForm">
        	<form method="post" enctype="multipart/form-data" name="firstTimeProfile" id="firstTimeProfile" class="form-validate"  novalidate="novalidate">
		  <input type="hidden" name="action" value="Process">
            	<ul class="form-list">
                	<li>
                    	<div class="field">
                        	<label for="Upload your Profile Image">Upload your Profile Image</label>
                            <div class="input-box">
                            	<div class="upload_button_outer clearfix"> 
				    <div class="filename">Choose a file...</div>
						          
					      <label for="fileToUpload">Take or select photo(s)</label><br />
 
					      <input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected();" accept="image/*" capture="camera" />

                            </div>
                        </div>
                    </li>
		    <li>
		      <div id="details"></div>
		    </li>
		    <li>
		      <div id="progress"></div>
		    </li>
                </ul>
		
                <div class="formButtons">
                	<!--input name="name" title="Submit" value="Submit" class="blueBtn" type="submit" /-->
			 <input type="button" onclick="uploadFile()" value="Upload" />
                </div>
            </form>
        </div>
    </div>
  </div>
<!-- End : Main Container -->

<script type="text/javascript">
$(document).ready(function() {
$('#profile_img').change(function(){
	$('.filename').html($(this).val());
});
});
</script>