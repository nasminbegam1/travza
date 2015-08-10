<!DOCTYPE html>
<html lang="en">
<head><title>Travza Website Admin Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <!--Loading bootstrap css-->
    <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/bootstrap/css/bootstrap.min.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>vendors/iCheck/skins/all.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/themes/style1/pink-blue.css" class="default-style">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/themes/style1/pink-blue.css" id="theme-change" class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="<?php echo BACKEND_URL; ?>css/style-responsive.css">
    <!--<link rel="shortcut icon" href="<?php echo BACKEND_URL; ?>images/favicon.ico">-->
</head>
<body id="signin-page">
<div class="page-form">
    <?=isset($content_for_layout_middle)?$content_for_layout_middle:'';?> 
</div>
<script src="<?php echo BACKEND_URL; ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/jquery-ui.js"></script>
<!--loading bootstrap js-->
<script src="<?php echo BACKEND_URL; ?>vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/html5shiv.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/respond.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/iCheck/icheck.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>vendors/iCheck/custom.min.js"></script>
<script>//BEGIN CHECKBOX & RADIO
$('input[type="checkbox"]').iCheck({
    checkboxClass: 'icheckbox_minimal-grey',
    increaseArea: '20%' // optional
});
$('input[type="radio"]').iCheck({
    radioClass: 'iradio_minimal-grey',
    increaseArea: '20%' // optional
});
//END CHECKBOX & RADIO</script>
<script src="<?php echo BACKEND_URL; ?>vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php echo BACKEND_URL; ?>js/form-validation.js"></script>
</body>
</html>