 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add New Banner</div>
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
                                                    <div class="caption">Add New Banner</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
						<input type="hidden" name="action" value="Process">
                                                    <div class="form-body">
                                                        
                                                        <div class="form-group"><label for="banner_image" class="col-md-3 control-label">Banner Image<span class='require'>*</span></label>

                                                            <div class="col-md-4">
                                                               <input type="file" name="banner_image" required name="banner_image" id="banner_image" />&nbsp;<strong>[image size maximum 1680x733 | extension must be .jpg or .jpeg or .gif or .png]</strong>
                                                            </div>
                                                        </div>

                                                        
                                                        
                                                        <div class="form-group"><label for="banner_title" class="col-md-3 control-label">Alt Tag <span class='require'>*</span></label>

                                                            <div class="col-md-9">
                                                                <input name="banner_title" type="text" placeholder="" class="form-control required" id="banner_title" value="<?php echo set_value('banner_title'); ?>"/>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <!--<div class="form-group"><label for="inputcmstitle" class="col-md-3 control-label">Banner Link </label>

                                                            <div class="col-md-9">
                                                                <input name="banner_link" type="text" placeholder=" " class="form-control" id="banner_link" value="<?php echo set_value('banner_link'); ?>"/>
                                                                
                                                            </div>
                                                        </div>-->

                                                        
                                                        
                                                        
                                                        
                                                       <!-- <div class="form-group"><label for="banner_desc" class="col-md-3 control-label">Banner Content </label>

                                                            <div class="col-md-9">
                                                                
                                                                    <textarea  name="banner_desc"   class="ckeditor form-control"><?php echo set_value('banner_desc');?></textarea>
                                    
                                                            </div>
                                                        </div>-->
                                                        <div class="form-group"><label for="banner_order" class="col-md-3 control-label">Banner Order</label>

                                                            <div class="col-md-9">
                                                                <input type="number" min="<?php echo ($lastOrderLimit[0]['lastOrderLimit']+1);?>" class="form-control" name="banner_order" id="banner_order" value="">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group"><label for="banner_status" class="col-md-3 control-label">Banner Status</label>

                                                            <div class="col-md-9">
                                                                <select name="banner_status" class="form-control">
                                                                    <option value="active">Active</option>
                                                                    <option value="inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="submit" class="btn btn-primary">Add Banner</button>
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
    $(document).ready(function(){
	$('#meta_title').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    $('#countexact').text(len);
	    if(len>68){
		$(this).val(value.substring(0,69));
	    }
	});
	
	$('#meta_description').keydown(function(){
	    var value = $(this).val();
	    var len = parseInt(value.length); 
	    $('#countexact1').text(len);
	    if(len>154){
		$(this).val(value.substring(0,155));
	    }
	});
    });
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->