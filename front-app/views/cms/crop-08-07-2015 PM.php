
<?php 
//pr($flyer_offer_details);
?>

<script src="<?php echo FRONTEND_URL?>js/jquery.Jcrop.js"></script>
<link rel="stylesheet" href="<?php echo FRONTEND_URL?>css/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" href="<?php echo FRONTEND_URL?>css/demos.css" type="text/css" />
<link rel="stylesheet" href="<?php echo FRONTEND_URL?>css/main.css" type="text/css" />
<script type="text/javascript">

  $(function(){
    
    $('.skip').click(function(){	
	window.location.href = "<?php echo $flyer_offer_details['skip_url'];?>";
    });
    
    $('#cropbox').Jcrop({
      aspectRatio:2,
      onSelect: updateCoords,
      allowResize: true,
      minSize: [500,92],
      maxSize: [500,250]
    });
    
    //$('#cropbox').Jcrop({
    //  aspectRatio:2,
    //  onSelect: updateCoords,
    //  allowResize: false,
    //  minSize: [600,192],
    //  maxSize: [600,192]
    //},function(){
    //    jcrop_api = this;
    //    jcrop_api.animateTo([0,59,600,300]);
    //  });

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

</script>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="jc-demo-box">
				<div class="page-header">
				<h1></h1>
				</div>
				<img src="<?php echo $flyer_offer_details['image_name'];?>" id="cropbox"/>
				<!--onsubmit="return checkCoords();"-->
				<form action="" method="post"  enctype="multipart/form-data">
					<input type="hidden" value="<?php echo $flyer_offer_details['abs_image_name'];?>" name="image_path"/>
					<input type="hidden" value="process" name="action"/>
					<input type="hidden" id="flyer_offer_type" name="flyer_offer_type" value="<?php echo $flyer_offer_details['flyer_offer_type'];?>" />
					<input type="hidden" id="only_image" name="only_image" value="<?php echo $flyer_offer_details['only_image'];?>" />
					<input type="hidden" id="skip_url" name="skip_url" value="<?php echo $flyer_offer_details['skip_url'];?>" />
					<input type="hidden" id="page_info" name="page_info" value="<?php echo $flyer_offer_details['page_info'];?>" />
					<input type="hidden" id="x" name="x" value="0"/>
					<input type="hidden" id="y" name="y" value="59"/>
					<input type="hidden" id="w" name="w" value="600" />
					<input type="hidden" id="h" name="h" value="300"/>
					<input type="submit" value="Crop Image" class="btn btn-large btn-inverse" />
					<input type="button" value="Skip" class="btn btn-large btn-inverse skip" />
				</form>
			</div>
		</div>
	</div>
</div>
