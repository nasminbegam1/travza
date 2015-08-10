 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add New FAQ</div>
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
                                            <!--<div class="nNote nFailure" style="width: 600px;color:red;">-->
					    <div class="alert alert-danger">
                                                <?php echo validation_errors('<p>', '</p>'); ?>
                                            
                                            </div>
                                        </div>
                                        <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-grey">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add New FAQ</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        

                                                        
                                                        
                                                        <div class="form-group"><label for="faq_question" class="col-md-3 control-label">FAQ Question <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="faq_question" type="text" placeholder="" class="form-control required" id="faq_question" value="<?php echo set_value('faq_question'); ?>"/>
                                                                
                                                            </div>
                                                        </div>

                                                        
                                                        <div class="form-group"><label for="faq_answer" class="col-md-3 control-label">FAQ Answer <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                
                                                                    <textarea  name="faq_answer" class="ckeditor form-control required"></textarea>
                                    
                                                            </div>
                                                        </div>
							
							
				                        <div class="form-group"><label for="faq_type" class="col-md-3 control-label">FAQ Type</label>

                                                            <div class="col-md-9">
                                                                <select name="faq_type" class="form-control">
                                                                    <option value="User">User</option>
                                                                    <option value="Vendor">Vendor</option>
                                                                </select>
                                                            </div>
                                                        </div>
							
							
                                                         <div class="form-group"><label for="faq_status" class="col-md-3 control-label">FAQ Status</label>

                                                            <div class="col-md-9">
                                                                <select name="faq_status" class="form-control">
                                                                    <option value="active">Active</option>
                                                                    <option value="inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                       
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add FAQ</button>
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