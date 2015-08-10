<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                      
                    <?php
                    
                    $page		= $this->uri->segment(5);
                    ?>
                       
                    <li class="user-panel">
                        
                        <div class="thumb">
                                    
                                    <?php if($user_image!='')
                                                {
                                                    if(file_exists(FILE_UPLOAD_ABSOLUTE_PATH.'admin/'.$user_image) && $user_image != "")
                                                    {
                                                        $user_image1 = IMAGE_UPLOAD_URL."admin/".$user_image;
                                                    ?>
                                                        <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                         $user_image1 =FRONTEND_URL.'images/user-icon-n.jpg';
                                                    ?>
                                                    
                                                        <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                                                    <?php
                                                    }
                                                }
                                                else
                                                {
                                               
                                                    $user_image1 =FRONTEND_URL.'images/user-icon-n.jpg';
                                                ?>
                                                    <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" width="140" height="140" src="<?php echo $user_image1 ;?>">
                                                
                                                <?php
                                                }
                                                ?>  
                                    <!--<img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" alt="" class="img-circle"/>-->
                        </div>
                        
                        <div class="info"><p><?php echo stripslashes($user_first_name).' '.stripslashes($user_last_name);?></p>
                            <ul class="list-inline list-unstyled">
                                <li><a href="<?php echo BACKEND_URL.'profile/index/'; ?>" data-hover="tooltip" title="Profile"><i class="fa fa-user"></i></a></li>

                                <li><a href="<?php echo BACKEND_URL.'dashboard/logout/'; ?>" data-hover="tooltip" title="Logout"><i class="fa fa-sign-out"></i></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                   
                    <li class="<?php if(currentClass()=='dashboard' || currentClass()=='profile' ) echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'dashboard/'; ?>">
                                    <i class="fa fa-tachometer fa-fw">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    
                    <li class='<?php if((currentClass()=='site_setting') ) echo 'active'; ?>'>
                          <a href="<?php echo BACKEND_URL.'site_setting/'?>"><i class="fa fa-cogs"></i>
                          <span class="submenu-title">Sitesettings</span></a>
                    </li>

                    
                   
                    
                    
       
            
              <li class='<?php if(currentClass()=='cms' || currentClass()=='banner' || currentClass()=='faq' ) echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'cms/index/'?>">
                            <i class="fa fa-file">
                            <div class="icon-bg bg-pink"></div>
                            </i>
                            <span class="menu-title">CMS</span>
                            <span class="fa arrow"></span>
                            <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                   
                    <li class="<?php if(currentClass()=='cms' && (currentMethod()=='index' || currentMethod()=='add_cms' || currentMethod()=='edit_cms'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'cms/index/'?>"><i class="fa fa-file"></i>
                            <span class="submenu-title">CMS Pages</span></a>
                    </li>
                    
                    <li class="<?php if(currentClass()=='banner' && (currentMethod()=='index' || currentMethod()=='add_banner' || currentMethod()=='edit_banner'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'banner/index/'?>"><i class="fa fa-picture-o"></i>
                            <span class="submenu-title">Banner</span></a>
                    </li>

                    
                    <li class="<?php if(currentClass()=='faq' && (currentMethod()=='index' || currentMethod()=='add_faq_master' || currentMethod()=='edit_faq_master'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'faq/index'?>"><i class="fa fa-question"></i>
                            <span class="submenu-title">FAQ</span></a>
                    </li>
                   
                </ul>
            </li>
            
                       

            <li class="<?php if(currentClass()=='email_template') echo 'active'; ?>" >
                        <a href="<?php echo BACKEND_URL.'email_template/'; ?>">
                                    <i class="fa fa-envelope-o">
                                    <div class="icon-bg bg-orange"></div>
                                    </i>
                                    <span class="menu-title">Email Template</span>
                        </a>
            </li>
            s    
            </ul>
            </div>
        </nav>