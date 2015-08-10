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
                      <div class="caption">Welcome to travza</div>
                      <div class="tools"> <i class="fa fa-chevron-up"></i> </div>
                    </div>
                    
		    
		    
                    <div style="background: #F4F4F4;" class="box portlet-body panel-body pan">
                        <div class="col-lg-12">
			  <br class="spacer">
			    
			    <div id="sum_box" class="row mbl">
				

				    <div class="col-sm-6 col-md-4">
				    <div class="panel visit db mbm">
					<div class="panel-body"><p class="icon"><i class="icon fa fa-group"></i></p><h4 class="value"><span>14</span></h4>
	
					    <p class="description">Active Users</p>
	
					    <div class="progress progress-sm mbn">
						<div class="progress-bar progress-bar-warning" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"><span class="sr-only">70% Complete (success)</span></div>
					    </div>
					</div>
				    </div>
				    </div>
				    
				    <div class="col-sm-6 col-md-4">
				    <div class="panel visit db mbm">
					<div class="panel-body"><p class="icon"><i class="icon fa fa-group" style="color: #6AF7A9;"></i></p><h4 class="value"><span>8</span></h4>
	
					    <p class="description">Active Vendors</p>
	
					    <div class="progress progress-sm mbn">
						<div class="progress-bar progress-bar-info" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"><span class="sr-only">70% Complete (success)</span></div>
					    </div>
					</div>
				    </div>
				    </div>
				    
				    
				    <div class="col-sm-6 col-md-4">
				    <div class="panel visit db mbm">
					<div class="panel-body"><p class="icon"><i class="icon fa fa-facebook" ></i></p><h4 class="value"><span>38</span></h4>
	
					    <p class="description">Published Flyer</p>
	
					    <div class="progress progress-sm mbn">
						<div class="progress-bar progress-bar-info" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"><span class="sr-only">70% Complete (success)</span></div>
					    </div>
					</div>
				    </div>
				    </div>
				    
				    <div class="col-sm-6 col-md-4">
				    <div class="panel visit db mbm">
					<div class="panel-body"><p class="icon"><i class="icon fa fa-facebook" ></i></p><h4 class="value"><span>34</span></h4>
	
					    <p class="description">Unpublished Flyer</p>
	
					    <div class="progress progress-sm mbn">
						<div class="progress-bar progress-bar-danger" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"><span class="sr-only">70% Complete (success)</span></div>
					    </div>
					</div>
				    </div>
				    </div>
				    
				    <div class="col-sm-6 col-md-4">
				    <div class="panel visit db mbm">
					<div class="panel-body"><p class="icon"><i class="icon fa fa-strikethrough" style="color: #6AF7A9;"></i></p><h4 class="value"><span>67</span></h4>
	
					    <p class="description">Published Offer</p>
	
					    <div class="progress progress-sm mbn">
						<div class="progress-bar progress-bar-info" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"><span class="sr-only">60% Complete (success)</span></div>
					    </div>
					</div>
				    </div>
				    </div>
				    
				    <div class="col-sm-6 col-md-4">
				    <div class="panel visit db mbm">
					<div class="panel-body"><p class="icon"><i class="icon fa fa-strikethrough" style="color: #d9534f;"></i></p><h4 class="value"><span>6</span></h4>
	
					    <p class="description">Unpublished Offer</p> 
	
					    <div class="progress progress-sm mbn">
						<div class="progress-bar progress-bar-danger" style="width: 70%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="70" role="progressbar"><span class="sr-only">30% Complete (success)</span></div>
					    </div>
					</div>
				    </div>
				    </div>
				    
				    
				    <div class="col-sm-6 col-md-4">
				    <div class="panel task db mbm">
					<div class="panel-body"><p class="icon"><i class="icon fa fa-shopping-cart"></i></p><h4 class="value">5<span></span></h4>
	
					    <p class="description">In Bucket</p>
	
					    <div class="progress progress-sm mbn">
						<div class="progress-bar progress-bar-info" style="width: 50%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar"><span class="sr-only">50% Complete (success)</span></div>
					    </div>
					</div>
				    </div>
				    </div>
				    
				    <div class="col-sm-6 col-md-4">
				    <div class="panel task db mbm">
					<div class="panel-body"><p class="icon"><i class="icon fa fa-stack-exchange"></i></p><h4 class="value"><span>66</span></h4>
	
					    <p class="description">User's Reviews</p>
	
					    <div class="progress progress-sm mbn">
						<div class="progress-bar progress-bar-info" style="width: 50%;" aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" role="progressbar"><span class="sr-only">50% Complete (success)</span></div>
					    </div>
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