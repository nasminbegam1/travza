<script src="<?php echo FRONTEND_URL?>js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="<?php echo FRONTEND_URL?>css/jquery.Jcrop.css" type="text/css" />



<div class="content">
   <div class="page-title">
	 <h1>Click on Image to <span>Crop</span></h1>
   </div>
   
<div class="cropingImgPanle">
   <div class="cropingImg">
   <img src="<?php echo $uploaded_image;?>" id="cropbox" />
   </div>
   <div class="cropingBtns">
   <form action="" method="post" onsubmit="return checkCoords();">
       <input type="hidden" id="x" name="x" />
       <input type="hidden" id="y" name="y" />
       <input type="hidden" id="w" name="w" />
       <input type="hidden" id="h" name="h" />
       <input type="hidden" name="action" value="Process"/>
       <input type="submit" value="Crop Image" class="blueBtn btn btn-large btn-inverse" />
       <input type="button" value="Skip" class="blueBtnDk btn btn-large btn-inverse" id="skip_crop" />
   </form>
   </div>
</div>
</div>
<script type="text/javascript">

  $(function(){

    $('#cropbox').Jcrop({
      aspectRatio:1,
      onSelect: updateCoords,
      allowResize: true,
      minSize: [120,120],
      maxSize: [250,250]
    });

  });

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };
  
  $("#skip_crop").click(function(){
   window.location = '<?php echo FRONTEND_URL;?>dashboard/';
  });

</script>