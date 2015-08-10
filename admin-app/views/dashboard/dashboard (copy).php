 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">DashBoard</div>
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
            <div class="panel panel-blue portlet box portlet-blue">
                    <div class="portlet-header">
                      <div class="caption">Welcome to traveldotz</div>
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    
                    <div style="background: #F4F4F4;" class="box portlet-body panel-body pan">
                        <div class="col-lg-12">
			  <br class="spacer">
			                                           <div class="col-md-12">
                                            <div class="panel income db mbm">
                                              <div class="panel-body">
						<div class="col-md-12">
                                                <h4>Dashboard will be updated as the project progresses</h4>
                                                
						</div>
						
                                              </div>
                                            </div>
                                          </div>
                              
                            <div style="clear: both"></div>
                            <br class="spacer">
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
$(function(){
$(".input-daterange #startdate").datepicker();
$(".input-daterange #enddate").datepicker({
defaultDate:$(".input-daterange #startdate").val()
});
});
</script>