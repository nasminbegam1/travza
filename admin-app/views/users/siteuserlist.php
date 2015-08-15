 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Site Users Listing</div>
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
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                                
                                    <!-- Start : main content loads from here -->   
    
                                <div class="row">
                                    <div class="col-lg-12"><h4 class="box-heading">Site User Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>user/siteuser/">
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
                                                    
                                                    <!--<div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php //echo $add_link;?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add Admin User</a>&nbsp;
                                                    </div>
                                                    </div>-->
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."user/batch_action/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <!--<th width="3%"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>-->
                                                   
                                                    
                                                    <th width="10%">Name</th>
                                                    <th width="5%">Email</th>
                                                    <th width="5%">Country</th>
                                                    <th width="7%">State</th>
                                                    <th width="5%">City</th>
						    <th width="20%">Actions</th>
                                                </tr>
                                                <tbody>
                                                <?php
                                                 $session_user_role  = $this->nsession->userdata('role');
                                                 $session_user_id    = $this->nsession->userdata('admin_id');
                                                 
                                                if(is_array($siteuserList) && count($siteuserList) > 0)
                                                {
						    for($i=0; $i<count($siteuserList); $i++)
						    {
						
						     $manageLink = str_replace("{{ID}}",$siteuserList[$i]['id'],$edit_link);	
						     $editLink = str_replace("{{ID}}",$siteuserList[$i]['id'],$edit_link);
						     $deleteLink = str_replace("{{ID}}",$siteuserList[$i]['id'],$delete_link);
						     
						     $user_name = stripslashes($siteuserList[$i]['first_name'].' '.$siteuserList[$i]['last_name']);
                                                
                                              
                                                ?>  
                                                <tr>
                                                    
                                                    
                                                    <td><?php echo $user_name;?></td>
                                                    <td><?php echo stripslashes($siteuserList[$i]['email']);?></td>
						    <td><?php echo stripslashes($siteuserList[$i]['country_name']);?></td>
                                                    <td><?php echo stripslashes($siteuserList[$i]['state']);?></td>
                                                    <td><?php echo stripslashes($siteuserList[$i]['city']);?></td>
						    
						    <td>
							
							<!--<a href="<?php //echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Manage User for Home Pages">
                                                        <button type="button" class="btn btn-info"><i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
						    &nbsp;-->
							<a href="<?php echo $editLink;?>" class="tablectrl_small bDefault tipS" title="Edit">
                                                        <button type="button" class="btn btn-info"><i class="fa fa-edit"></i>
                                                        </button>
                                                    </a>
                                                         &nbsp;
                                                   
                                                        <a href="<?php echo $deleteLink;?>" class="tablectrl_small bDefault tipS" title="Remove" onclick="return confirm('Are you sure?');">
                                                        <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i>
                                                        </button>
                                                        </a>
                                                       
                                                    </td>
                                                </tr>
                                                <?php } } else {  ?>
                            <tr><td colspan="7" align="center">..::..No records found..::..</td></tr>
                            
                        <?php } ?>
                                                </tbody>
                                                </thead></table>
                                
<!--                                                <div class="row mbl">
                                                
                                                <div class="col-lg-6">
                                                    <div class="tb-group-actions"><span>Apply Action:</span>
                                                    <select class="table-group-action-input form-control input-inline input-small input-sm mlm" name="apply_action" id="apply_action">
                                                        <option value="">Select...</option>
                                                      
                                                        <option value="Activate">Activate</option>
                                                        <option value="Inactivate">Inactivate</option>
                                                    </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>-->
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
    });
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->