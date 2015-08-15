 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Event Home Users Listing</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
  </ol>  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->

            <div class="page-content">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                                
                                    <!-- Start : main content loads from here -->   
    
                                <div class="row">
                                    <div class="col-lg-12"><h4 class="box-heading">Event Home Users Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>event_home_user/">
                                            <div class="row mbl">
                                                <div class="col-lg-6">
                                                    <div class="input-group input-group-sm mbs">
                                                    
                                                    <input type="text" id="search_keyword" name="search_keyword" placeholder="Enter here..." class="form-control" value="<?php echo $search_keyword; ?>" />
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-success" onclick=" return searchValidation();">Search</button>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                   
                                                    <button class="btn btn-sm btn-primary" name="btn_show_all" id="btn_show_all"><i class="fa "></i>&nbsp;
                                                            Show All
                                                    </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    View
                                                        &nbsp;<select name="per_page" id="per_page" class="form-control input-xsmall input-sm input-inline">
                                                           
                                                            <option value="1"   <?php if($per_page == "1")   { echo ' selected="selected"'; } ?>>1</option>
                                                            <option value="2"   <?php if($per_page == "2")   { echo ' selected="selected"'; } ?>>2</option>
                                                            <option value="5"   <?php if($per_page == "5")   { echo ' selected="selected"'; } ?>>5</option>
                                                            <option value="10"  <?php if($per_page == "10")  { echo ' selected="selected"'; } ?>>10</option>
                                                            <option value="20"  <?php if($per_page == "20")  { echo ' selected="selected"'; } ?>>20</option>
                                                            <option value="50"  <?php if($per_page == "50")  { echo ' selected="selected"'; } ?>>50</option>
                                                            <option value="100" <?php if($per_page == "100") { echo ' selected="selected"'; } ?>>100</option>
                                                            <option value="500" <?php if($per_page == "500") { echo ' selected="selected"'; } ?>>500</option>
                                                            
                                                            
                                                            
                                                        </select>&nbsp;
                                                        records 
                                                </div>
                                                
                                            </div>
                                            </form>
                                            
                                            <?php
                                            $show_to_record 	= $startRecord + $per_page;
                                            $to_record		= $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                            ?>
                                           
                                            <div class="row mbm">
                                                <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                        <!--Page
                                                        &nbsp;
                                                        <a href="#" class="btn btn-sm btn-default btn-prev">
                                                        <i class="fa fa-angle-left"></i>
                                                        </a>&nbsp;
                                                      <input type="text" maxlenght="5" value="<?php echo $startRecord+1; ?>" class="pagination-panel-input form-control input-mini input-inline input-sm text-center"/>
                                                        &nbsp;
                                                        <a href="#" class="btn btn-sm btn-default btn-prev">
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>&nbsp;
                                                       
                                                        of <?php //echo $to_record; ?> | -->
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                 </div>
                                                    
                                                </div>
                                                <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $pagination;?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
        <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."event_home_user/event_batch/0/".$page;?>" method="post" enctype="multipart/form-data">
                                            
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <!--<th width="3%"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>-->
                                                   
                                                    
                                                    <th width="20%">Name</th>
                                                    <th>Show in Event Home Page</th>
						    <th>Image File</th>
						    
                                                </tr>
                                                <tbody>
                                                <?php
                                                 $session_user_role  = $this->nsession->userdata('role');
                                                 $session_user_id    = $this->nsession->userdata('admin_id');
                                                 
                                                if(is_array($siteuserList) && count($siteuserList) > 0)
                                                {
						    for($i=0; $i<count($siteuserList); $i++)
						    {
							$user_name = stripslashes($siteuserList[$i]['first_name'].' '.$siteuserList[$i]['last_name']);
							$class 		= '';
							$display	= 'block';
							$image_name	= stripslashes($siteuserList[$i]['image_name']);
							if($siteuserList[$i]['image_name'] == '')
							{
							   $class 	= 'disabled';
							   $display	= 'none';
							}
                                                
                                              
                                                ?>  
                                                <tr>
                                                    
                                                    
                                                    <td><?php echo $user_name;?></td>
                                                    <td>
							
							<select name="event[]" id="event_dd_<?php echo $i;?>" class="event_dd">
							    <option value="No" <?php if($image_name == '') { ?>selected<?php } ?>>No</option>
							    <option value="Yes" <?php if($image_name != '') { ?>selected<?php } ?>>Yes</option>
							</select>
							<input type="hidden" name="user_id[]" value="<?php echo $siteuserList[$i]['id'];?>">
							<input type="hidden" id="image_name_<?php echo $i;?>" value="<?php echo $image_name;?>">
						    </td>
						    
						    <td>
							<span id="span_file_<?php echo $i;?>" style="display:<?php echo $display;?>;">
							<input type="file" name="event_image_name[]" id="event_image_<?php echo $i;?>" class="event_image_class" onchange="javascript:imagecheck(this,<?php echo $i;?>)">
							<span><i>image width must be 310px and height must be 180px</i></span>
							<?php if($image_name != '') { ?>
							<br>
							<img src="<?php echo IMAGE_UPLOAD_URL;?>home_user/event/<?php echo $image_name;?>" width="40" height="40">
							<?php } ?>
							
							<br>
							<span style="color:#FF0000" id="validation_<?php echo $i;?>"></span>
							
							</span>
						    </td>
						    
						    
						    
                                                       
                                                    </td>
                                                </tr>
                                                <?php } } else {  ?>
                            <tr><td colspan="7" align="center">..::..No records found..::..</td></tr>
                            
                        <?php } ?>
                                                </tbody>
                                                </thead></table>
                                
                                                <div class="row mbl">
                                                
                                                <div class="col-lg-6">
                                                    <div class="tb-group-actions">
							<input type="submit" value="Submit" name="submit" id="submit">
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                                <div class="row mbm">
                                                <div class="col-lg-6">
                                                    <div class="pagination-panel">
                                                       <!-- Page
                                                        &nbsp;<a href="#" class="btn btn-sm btn-default btn-prev"><i class="fa fa-angle-left"></i></a>&nbsp;<input type="text" maxlenght="5" value="<?php echo $startRecord+1; ?>" class="pagination-panel-input form-control input-mini input-inline input-sm text-center"/>&nbsp;<a href="#" class="btn btn-sm btn-default btn-prev"><i class="fa fa-angle-right"></i></a>&nbsp;
                                                        of <?php //echo $to_record; ?> | -->
                                                        
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $pagination;?>
                                                        
                                                    </div>
                                                </div>
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
  
  function searchValidation()
  {
    if ( $("#search_keyword").val() == '')
    {
       alert("Search Field Must Contain Name Or Email");
       $("#search_keyword").css('border-color','red');
       $("#search_keyword").focus();
       return false;
    }
    return true;    
  }
  
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
	
	$('.event_dd').change(function(){
	    
	    var ddValue = $(this).val();
	    var event_id = $(this).attr('id').split('_');
	    var eventImageId = $(this).attr('id').replace('event_dd_', 'travel_image_');
	    var spanFileId = $(this).attr('id').replace('event_dd_', 'span_file_');
	    if (ddValue == 'Yes')
	    {
		$('#' + eventImageId).prop('disabled', false);
		$('#' + spanFileId).show();
	    }
	    else
	    {
		$('#' + eventImageId).prop('disabled', true);
		$('#' + spanFileId).hide();
		$('#validation_'+event_id[2]).html();
	    }
	})
    });
    
    $(document).on('submit','#frmPages',function(){
	var travel_list	=	[];
	var img_list	=	[];
	
	$(".event_dd").each(function () {
		travel_list.push($(this).val());
	});
	$(".event_image_class").each(function () {
		img_list.push($(this).val());
	});
	var submitData = true;
	for(var i=0;i< travel_list.length;i++)
	{
	    var img = $('#image_name_'+i).val();
	    if (travel_list[i] == 'Yes' && img == '')
	    {
		if(img_list[i]	== '')
		{
		    submitData = false;
		    $('#validation_'+i).html('Please select file to upload');
		}
	    }
	}
	return submitData;
	
   });
    
    function imagecheck(element,id){
        var myfiles = element;
	var files = myfiles.files;
	var readImg = new FileReader();
	var file=files[0];
	if(file.type.match('image.*')){
	    readImg.onload = (function(file) {
		return function(e) {
		    if (e.target.result != '') {
			 $('#validation_'+id).text('');
		    }
		};
	    })(file);
	    readImg.readAsDataURL(file);
	}else{
	    alert('the file '+file.name+' is not an image');
	    $('.filename').html('');
	}
    }
</script>