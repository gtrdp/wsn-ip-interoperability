<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo (strlen($page) < 5)? strtoupper($page):ucwords($page); ?> | WSN+IP</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- Bootstrap-Switch -->
        <link href="bootstrap/css/bootstrap-switch.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="dashboard.php">{ WSN+IP }</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php echo $_SESSION['full_name']; ?><i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="profile.php">My Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="script/logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li <?php if($page == 'dashboard') echo "class=\"active\"";?>>
                                <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="dropdown <?php if($page == 'iqrf') echo "active";?>">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">IQRF <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="device.php?device=iqrf">View Devices</a>
                                    </li>
                                    <li>
                                        <a href="add-device.php?device=iqrf">Add New Device</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php if($page == 'xbee') echo "active";?>">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">XBee Relay <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="device.php?device=xbee">View Devices</a>
                                    </li>
                                    <li>
                                        <a href="add-device.php?device=xbee">Add New Device</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown <?php if($page == 'profile') echo "active";?>">
                                <a href="mode.php" role="button" class="dropdown-toggle" data-toggle="dropdown">Profile <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="list.php?list=profile">View/Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="new-profile.php">Add New Profile</a>
                                    </li>
                                </ul>
                            </li>
                            <?php if($_SESSION['superuser'] == 1): ?>
                            <li class="dropdown <?php if($page == 'user') echo "active";?>">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="profile.php">My Profile</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="list.php?list=user">User List</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="new-user.php">Add New User</a>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <li <?php if($page == 'about') echo "class=\"active\"";?>>
                                <a href="about.php">About</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>