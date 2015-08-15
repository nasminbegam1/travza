 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Site User</div>
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
                                            <!--<div class="panel-heading">Admin User Edit Form</div>-->
					    <div class="portlet-header">
                                                    <div class="caption">Site User Edit Form</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pa">
                                                	
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated" enctype="multipart/form-data" id="edit_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="inputFirstName" class="col-md-3 control-label">First Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input name="first_name" type="text" placeholder="First Name" class="form-control required first_name" id="first_name" value="<?php echo stripslashes($siteuser_info[0]['first_name']);?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputLastName" class="col-md-3 control-label">Last Name <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                
                                                                    <input name="last_name" type="text" placeholder="Last Name" class="form-control required last_name" id="last_name" value="<?php echo stripslashes($siteuser_info[0]['last_name']);?>"/>
                                    
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label">Email <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon"><i class="fa fa-envelope"></i>
                                                                    <input type="text" readonly="readonly" id="email_address" name="email_address"  placeholder="Email Address" class="form-control required email_address" data-type="email" value="<?php echo stripslashes($siteuser_info[0]['email']);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputAddress" class="col-md-3 control-label">Address <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon">
                                                                    <textarea id="address" name="address"  placeholder="Address" class="form-control required"><?php echo stripslashes($siteuser_info[0]['address']);?></textarea> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label">Country <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon">
								    <select class="form-control required" id="country" name="country">
								    
                                                                    <option value="">--Select Country--</option>
								    <?php
								    if(is_array($country_list) && count($country_list) > 0)
								    {
									foreach($country_list as $cl){
								    ?>
								     <option <?php if((isset($siteuser_info[0]['country'])) &&  ($siteuser_info[0]['country']==$cl['id'])) echo  'selected="selected"'; ?> value="<?php echo $cl['id'];?>"><?php echo stripslashes($cl['country_name']);?></option>
								    <?php
									}
								    }
								    ?>
                                                                        
                                                                        
                                                                </select>
                                                                    <!--<input type="text" id="country" name="country"  placeholder="Country" class="form-control required country"  value="<?php //echo stripslashes($siteuser_info[0]['country_name']);?>"/>-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label">State <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon">
                                                                    <input type="text" id="state" name="state"  placeholder="State" class="form-control required state"  value="<?php echo stripslashes($siteuser_info[0]['state']);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label">City <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon">
                                                                    <input type="text" id="city" name="city"  placeholder="city" class="form-control required city"  value="<?php echo stripslashes($siteuser_info[0]['city']);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="inputEmail" class="col-md-3 control-label">Zip <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <div class="input-icon">
                                                                    <input type="text" id="zip" name="zip"  placeholder="Zip" class="form-control required zip"  value="<?php echo stripslashes($siteuser_info[0]['zip']);?>"/>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Site User</button>
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