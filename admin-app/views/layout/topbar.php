<!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
<!--END BACK TO TOP-->
<?php
        $user_image      = '';
        $user_first_name ='';
        $user_last_name  = '';
        $user_details   = $this->nsession->userdata('user_detail');
        if(is_array($user_details)){
        $user_image     = $user_details['image'];
        $user_first_name = $user_details['first_name'];
        $user_last_name = $user_details['last_name'];
        }
?>
<div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0; z-index: 2;" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                </button>
                <a id="logo" href="<?php echo BACKEND_URL.'dashboard/'; ?>" class="navbar-brand">
                      
                        <span class="logo-text">
                                <img style="width:62%;" src="<?php echo FRONTEND_URL; ?>images/logo.png" alt="admin-logo" />
                        </span>
                        <span style="display: none" class="logo-text-icon">
                                <!--<i class="fa fa-h-square" style="color: #FFF; font-size:20px;"></i>-->
                                <i class="fa fa-tumblr-square" style="color: #FFF; font-size:20px;"></i>
                        <!--        <img src="<?php echo BACKEND_IMAGE_PATH; ?>favicon.ico" />-->
                        </span>
                </a>
            </div>
            
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
               
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                   
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle">
                        <?php
                        if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.$user_image) && $user_image != "")
                        {
                            $user_image1 = IMAGE_UPLOAD_URL."admin/".$user_image;
                        ?>
                            <img class="img-responsive img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                        <?php
                        }
                        else
                        {
                            $user_image1 = IMAGE_UPLOAD_URL."admin/userLogin2.png";
                        ?>
                        
                            <img class="img-responsive img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                        <?php
                        }
                        ?>  
                    
                    
                   
                        <span class="hidden-xs"><?php echo stripslashes($user_first_name).' '.stripslashes($user_last_name);?></span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="<?php echo BACKEND_URL.'profile/index/'; ?>"><i class="fa fa-user"></i>My Profile</a></li>
                            <li><a href="<?php echo BACKEND_URL.'dashboard/logout/'; ?>"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown hidden-xs">
                      <a class="btn-fullscreen" title="FullScreen" href="javascript:void(0)"><i class="fa fa-arrows"></i><span class="submenu-title"></span></a>
                    </li>
                   
                </ul>
            </div>
        </nav>
    </div>