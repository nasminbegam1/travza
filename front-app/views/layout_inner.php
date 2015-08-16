<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome to Traveldotz</title>

<link type="text/css" rel="stylesheet" href="<?php echo FRONTEND_URL?>css/jquery.bxslider.css">
<link type="text/css" rel="stylesheet" href="<?php echo FRONTEND_URL?>css/style.css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel='stylesheet' type="text/css">
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<script src="<?php echo FRONTEND_URL?>js/jquery-1.10.2.js"></script>
<script src="<?php echo FRONTEND_URL?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo FRONTEND_URL?>js/jquery.tinyscrollbar.js"></script>
<link rel="stylesheet" href="<?php echo FRONTEND_URL?>css/jquery-ui.css">
<script src="<?php echo FRONTEND_URL?>js/jquery-ui.js"></script>
<script src="<?php echo FRONTEND_URL?>js/custom_functions.js"></script>
<script type="text/javascript" src="<?php echo FRONTEND_URL?>js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo FRONTEND_URL?>js/bootstrap.min.js"></script>
<!--<script src="<?php //echo FRONTEND_URL?>js/jquery.validate.js"></script> -->
<link type="text/css" rel="stylesheet" href="<?php echo FRONTEND_URL?>css/sweetalert.css">

<script src="<?php echo FRONTEND_URL?>js/new_timepicker/moment.js"></script>
<script src="<?php echo FRONTEND_URL?>js/new_timepicker/bootstrap-datetimepicker.min.js"></script>

</head>

<body>
<div class="wrapper">
    
    <!--Start header section-->
    
    <?=isset($content_for_layout_header)?$content_for_layout_header:'';?>
    <!--End header section-->
    
    <div class="main-container">
    <!-- Start : Content -->
    <?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?>
    <!-- End : Content -->
    </div>
 
     <!--Start footer section-->
    <?=isset($content_for_layout_footer)?$content_for_layout_footer:'';?>
    <!--End footer section-->   
    
</div>
</body>
</html>