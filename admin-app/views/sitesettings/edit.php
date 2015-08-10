 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Site Settings</div>
    </div>
<!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
	<?php if($tot != $k+1)
	    echo "&nbsp;>&nbsp;";
	?>
      </li>
    <?php }}?>
  </ol>  
  <!--For breadcrump end-->
  
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                                            <?php if(validation_errors() != FALSE){?>
                                        <div align="center">
                                            <div class="nNote nFailure" style="width: 600px;color:red;">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            </div>
                                        </div>
                                            <?php } ?>
                                        
                                        
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Edit Site Settings</div>-->
					    <div class="portlet-header">
                                                    <div class="caption">Edit Site Settings</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated" enctype="multipart/form-data" id="edit_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">Setting Label</label>

                                                            <div class="col-md-4">
                                                                <input name="first_name" type="text" placeholder="First Name" class="form-control required first_name" id="first_name" value="<?php echo $sitesettings_lebel;?>" disabled="disabled"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Setting Value <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                <?php
									$valDataType = $sitesettings_type;
									
									switch ($valDataType):
										case 'CHECKBOX':   
											
										    break;
										case 'COMBO':   
											
											break;
										case 'TEXTAREA':									
											echo '<textarea id="sitesettings_value" class="form-control" data-minlength="40" data-required="true" rows="4" cols="30" name="sitesettings_value">'.trim(stripslashes($sitesettings_value)).'</textarea>';
											break;
										    case 'SELECT':									
											echo '<select id="sitesettings_value" class="form-control" data-minlength="40" data-required="true" rows="4" cols="30" name="sitesettings_value"><option value = "Demo"'.((trim(stripslashes($sitesettings_value))=="Demo")? ' selected="selected"' : '').'>Demo - Sandbox</option><option value = "Live"'.((trim(stripslashes($sitesettings_value))=="Live")? ' selected="selected"' : '').'>Live</option></select>';
											break;
										default:
											echo '<input type="text" class="form-control" data-required="true" name="sitesettings_value" id="sitesettings_value" value="'.trim(stripslashes($sitesettings_value)).'" />';
										endswitch;
									
								?>
                                    
                                    
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Settings</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo $base_url; ?>'">Return</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
        </div>
        </div>
        </div>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
<script>
  

  
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });
</script>