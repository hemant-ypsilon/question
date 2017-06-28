    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
           <?php 
                  $class = $this->router->fetch_class();
                  $method = $this->router->fetch_method();
                  $activeClass = getActiveClass($class,$method);
           ?>
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url('admin_assets/'); ?>img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Admin<b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?php echo site_url('change-password'); ?>">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo site_url('admin/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        Question App
                    </div>
                </li>

                <li <?php if($activeClass == 'dashboard') { echo 'class="active"'; } ?>>
                    <a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                </li>

                <li <?php if($activeClass == 'users') { echo 'class="active"'; }  ?>>
                    <a href="<?php echo site_url('all-user'); ?>"><i class="fa fa-users"></i> <span class="nav-label">User</span></a>
                </li>

                <li <?php if($activeClass == 'question') { echo 'class="active"'; }  ?> >
                    <a href="#"><i class="fa fa-question"></i> <span class="nav-label">Question</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true" style="">
                        <li><a href="<?php echo site_url('all-template'); ?>">All Question</a></li>
                        <li><a href="<?php echo site_url('add-question'); ?>">Add Question</a></li>
                    </ul>
                </li>

                <!-- <li <?php if($activeClass == 'store') { echo 'class="active"'; }  ?> >
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Store</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse" aria-expanded="true" style="">
                        <li><a href="<?php echo site_url('all-store'); ?>">All Store</a></li>
                        <li><a href="<?php echo site_url('add-store'); ?>">Add Store</a></li>
                    </ul>
                </li>


                 <li <?php if($activeClass == 'transaction') { echo 'class="active"'; }  ?>>
                    <a href="<?php echo site_url('transaction'); ?>"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Transaction</span></a>
                </li>

                 <li <?php if($activeClass == 'merchant') { echo 'class="active"'; }  ?>>
                    <a href="<?php echo site_url('merchant'); ?>"><i class="fa fa-users"></i> <span class="nav-label">Merchant</span></a>
                </li>

                 <li <?php if($activeClass == 'setting') { echo 'class="active"'; }  ?>>
                    <a href="<?php echo site_url('setting'); ?>"><i class="fa fa-cog"></i> <span class="nav-label">Setting</span></a>
                </li> -->

            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <!-- <form role="search" class="navbar-form-custom" method="post" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form> -->
        </div>
            <ul class="nav navbar-top-links navbar-right">
               <!--  <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to LOYALITY.</span>
                </li> -->

               <!--  <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('admin_assets/'); ?>img/a7.jpg">
                                </a>
                                <div>
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('admin_assets/'); ?>img/a4.jpg">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('admin_assets/'); ?>img/profile.jpg">
                                </a>
                                <div>
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->


                <li>
                    <a href="<?php echo site_url('admin/logout'); ?>">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>