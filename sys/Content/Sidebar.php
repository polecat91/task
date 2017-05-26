<div class="col-md-3 left_col sidebar">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?=$ADM['base_url']?>" class="site_title"><i class="glyphicon glyphicon-wrench"></i> <span>Admin</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="<?php print $ADM['images'] . 'profile-avatar.jpg'?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                <?php
                    print "{$_SESSION['admin_user']['first_name']} {$_SESSION['admin_user']['last_name']}";
                ?>
                </h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
                <ul class="nav side-menu">
                <?php
                    foreach($objMenu->getTtblMenu() AS $tblModule) {
                        print "
                        <li>
                            <a data-href='{$tblModule['url']}'>
                                <i class=\"fa fa-{$tblModule['glyphicon']}\"></i>
                                <span class=\"sidebar-module\">{$tblModule['name']}</span>
                                <span class=\"fa fa-chevron-down\"></span>
                            </a>
                        ";

                        if($tblModule['chield']) {
                            print "<ul class=\"nav child_menu\">";
                            foreach($tblModule['chield'] AS $rowFunction) {
                                print "
                                    <li><a data-href=\"{$rowFunction['url']}\" href=\"javascript:void(0)\">{$rowFunction['name']}</a></li>
                                ";
                            }
                            print "</ul>";
                        }
                        print "</li>";
                    }
                ?>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a class="logout" data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>