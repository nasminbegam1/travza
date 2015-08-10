 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Edit Email Template</div>
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
                                        
                                        <div class="panel panel-yellow portlet box portlet-violet">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Edit Email Template</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        <div class="form-group"><label for="template_title" class="col-md-3 control-label">Template Title <span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                                <input name="template_title" type="text" placeholder="Template Title" class="form-control required template_title" id="template_title" value="<?php echo stripslashes($arr_template['template_name']);?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="form-group"><label for="responce_email" class="col-md-3 control-label"> Email From<span class='require'> * </span></label>

                                                            <div class="col-md-4">
                                                                <input name="responce_email" type="text" placeholder="Email From" class="form-control required email responce_email" id="responce_email" value="<?php echo stripslashes($arr_template['responce_email']);?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                         
                                                        <div class="form-group"><label for="email_subject" class="col-md-3 control-label">Email Subject<span class='require'> * </span></label>

                                                            <div class="col-md-4">
                                                                <input name="email_subject" type="text" placeholder="Email Subject" class="form-control required email_subject" id="email_subject" value="<?php echo stripslashes($arr_template['email_subject']);?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                         
                                                        <div class="form-group"><label for="email_content" class="col-md-3 control-label">Email Content <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                
                                                                    <textarea  name="email_content"  class="ckeditor form-control"><?php echo stripslashes($arr_template['email_content']);?></textarea>
                                    
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="template_status" class="col-md-3 control-label">Template Status</label>

                                                            <div class="col-md-9">
                                                                <select name="template_status" class="form-control">
                                                                    <option value="1" <?php echo ($arr_template['template_status']==1) ? 'selected' : '' ;?> >Active</option>
                                                                    <option value="0" <?php echo ($arr_template['template_status']==0) ? 'selected' : '' ;?> >Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Edit Template</button>
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


<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->