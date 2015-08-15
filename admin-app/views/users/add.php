 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Admin User</div>
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
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Admin User Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">First Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input name="first_name" type="text" placeholder="First Name" class="form-control required first_name" id="first_name" value="<?php echo set_value('first_name'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Last Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input name="last_name" type="text" placeholder="Last Name" class="form-control required last_name" id="last_name" value="<?php echo set_value('last_name'); ?>"/>
                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label">Email <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon"><i class="fa fa-envelope"></i>
                                                                    <input type="text" id="email_address" name="email_address"  placeholder="Email Address" class="form-control required" data-type="email" value="<?php echo set_value('email_address'); ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_password" class="col-md-3 control-label">Password <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="password" name="password" id="password" class="form-control required password"  placeholder="Password" value="<?php echo set_value('password'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_password_repeat" class="col-md-3 control-label">Repeat Password <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input type="password" name="conf_password" id="conf_password"  class="form-control required conf_password"  data-equalto="#password" placeholder="Repeat Password" value="<?php echo set_value('conf_password'); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="reg_pictute" class="col-md-3 control-label">Upload Picture</label>

                                                            <div class="col-md-4">
                                                               <input type="file" name="user_image" id="user_image" />&nbsp;<strong>[image size maximum 1200x800 | extension must be .jpg or .jpeg or .gif or .png]</strong>
                                                            </div>
                                                        </div>
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Admin User</button>
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