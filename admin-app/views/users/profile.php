 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Admin Profile</div>
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
                <div id="page-user-profile" class="row">
                    <div class="col-md-12">
                        <!--<script>
                            $('document').ready(function(){   
                                    $('#account').click(function(){
                                       
                                         $('#tab-account-setting').show();
                                     
                                 });
                            });
                            </script>-->
                  
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                     <?php
					    $image          = $user_info[0]['image'];
                                           
				    ?>
                                    <div class="text-center mbl">
                                       <?php if($image!='')
                                                {
                                                    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.$image) && $image != "")
                                                    {
                                                        $user_image = IMAGE_UPLOAD_URL."admin/".$image;
                                                    ?>
                                                        <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image ;?>">
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                        $user_image =FRONTEND_URL.'images/user-icon-n.jpg';
                                                    ?>
                                                    
                                                        <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image ;?>">
                                                    <?php
                                                    }
                                                }
                                                else
                                                {
                                               
                                                    $user_image =FRONTEND_URL.'images/user-icon-n.jpg';
						?>
                                                    <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image ;?>">
                                                
                                                <?php
                                                }
                                                ?>  
                                        
                                    </div>
                                </div>
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td>User Name</td>
                                        <td><?php echo stripslashes($user_info[0]['first_name']).' '.stripslashes($user_info[0]['last_name']);?></td>
                                    </tr>
                                    <tr>
                                        <td width="50%">Email</td>
                                        <td><?php echo stripslashes($user_info[0]['email_id']);?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="50%">Status</td>
                                        <td>
                                            <?php
                                                if($user_info[0]['status']=='active')
                                                {
                                                ?>
                                                    <span class="label label-success">Active</span>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                    <span class="label label-danger">Inactive</span>
                                                <?php
                                                }
                                            ?>
                                            
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="50%">Join Since</td>
                                        <?php
                                        
                                        $join_date=$user_info[0]['added_on'];
                                        $join_date1=explode(' ',$join_date);
                                        $join_date2=$join_date1[0];
                                        $join_date3=$join_date1[1];
                                        
                                        ?>
                                        <td><?php 
                                      
                                        $month=date("M",strtotime($join_date2));
                                        $day=date("d",strtotime($join_date2));
                                        $year=date("Y",strtotime($join_date2));
                                        echo $month.'  '.$day.' , '.$year;
                                        ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-9">
                                <ul class="nav nav-tabs ul-edit responsive">
                                    
                                    <li class="active"><a href="#tab-edit" data-toggle="tab"><i class="fa fa-edit"></i>&nbsp;
                                        Edit Profile</a></li>
                                    
                                </ul>
				<?php
					    $profile_type = $this->uri->segment(3);
				?>
                                <div id="generalTabContent" class="tab-content">

                                  <div id="tab-edit" class="tab-pane fade in active">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="tab-content">
                                                    <div id="tab-profile-setting" class="tab-pane fade <?php if(!isset($profile_type) || $profile_type == '' ) echo 'active in'; ?>">
                                                        <form action="" class="form-validate1 form-horizontal" method="post" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">First Name</label>
                                                                    <input type="hidden" name="profile" value="editprofile" />
                                                                <div class="col-sm-9 controls">
                                                                    <input type="text" name="first_name" id="first_name" placeholder="first name" class="form-control required first_name" value="<?php echo stripslashes($user_info[0]['first_name']);?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Last Name</label>

                                                                <div class="col-sm-9 controls">
                                                                    <input type="text" name="last_name" placeholder="last name" class="form-control required last_name"id="last_name" value="<?php echo stripslashes($user_info[0]['last_name']);?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="reg_pictute" class="col-md-3 control-label">Upload Picture</label>

                                                            <div class="col-sm-9 controls">
                                                               <input type="file" name="user_image" id="user_image" />&nbsp;<br /><strong>[image size maximum 1200x800 | extension must be .jpg or .jpeg or .gif or .png]</strong>
                                                            </div>
                                                           
                                                            <?php if($image!=''){ ?>
                                                            <center>
								
                                                                <img class="img-circle" src="<?php echo IMAGE_UPLOAD_URL;?>admin/<?php echo $image;?>"style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140">
                                                            </center>
                                                             <?php } ?>
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group mbn">
                                                                <label class="col-sm-3 control-label"></label>

                                                                <div class="col-sm-9 controls">
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;
                                                                        Save
                                                                    </button>
                                                                    &nbsp; &nbsp;<a href="<?php echo $base_url; ?>" class="btn btn-default">Cancel</a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div id="tab-account-setting" class="tab-pane fade account <?php if(isset($profile_type) && $profile_type == 'account' ) echo 'active in'; ?>">
                                                        <form action="" class="form-validate form-horizontal" method="post">
                                                            <div class="form-body">
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Email</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <input type="hidden" name="account" value="editaccount" />
                                                                        <input type="email" name="email_address" placeholder="email@yourcompany.com" class="form-control required email_address" id="email_address" value="<?php echo stripslashes($user_info[0]['email_id']);?>"/>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Password</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <input type="password" id="password" name="password" placeholder="" class="form-control required password" value="<?php echo stripslashes($user_info[0]['password']);?>"/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Confirm Password</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <input type="password" name="conf_password" id="conf_password" placeholder="" class="form-control required conf_password" value="<?php echo stripslashes($user_info[0]['password']);?>"/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mbn">
                                                                    <label class="col-sm-3 control-label"></label>

                                                                    <div class="col-sm-9 controls">
                                                                        <button type="submit" id="account" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;
                                                                            Save
                                                                        </button>
                                                                        &nbsp; &nbsp;<a href="<?php echo $base_url; ?>" class="btn btn-default">Cancel</a></div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
					    
                                            <div class="col-md-3">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="<?php if(!isset($profile_type) || $profile_type == '' ) echo 'active'; ?>">
							<a href="#tab-profile-setting" data-toggle="tab"><i class="fa fa-folder-open"></i>&nbsp;
                                                        Profile Setting</a>
						    </li>
                                                    <li class="<?php if(isset($profile_type) && $profile_type == 'account' ) echo 'active'; ?>">
							<a href="#tab-account-setting" data-toggle="tab"><i class="fa fa-cogs"></i>&nbsp;
                                                        Account Setting</a>
						    </li>
                                                </ul>
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