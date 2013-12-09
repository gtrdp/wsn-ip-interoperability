<div class="container-fluid">
<div class="row-fluid">

<div class="span3" id="sidebar">
    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
        <li <?php if($page == 'dashboard') echo 'class="active"';?>>
            <a href="dashboard.php"><i class="icon-chevron-right"></i> Dashboard</a>
        </li>
        <li <?php if($page == 'iqrf') echo 'class="active"';?>>
            <a href="list.php?list=iqrf"><i class="icon-chevron-right"></i> IQRF</a>
        </li>
        <li <?php if($page == 'xbee') echo 'class="active"';?>>
            <a href="list.php?list=xbee"><i class="icon-chevron-right"></i> XBee Relay</a>
        </li>
        <li <?php if($page == 'profile') echo 'class="active"';?>>
            <a href="profile.php"><i class="icon-chevron-right"></i> Profile</a>
        </li>
        <li <?php if($page == 'user') echo 'class="active"';?>>
            <a href="list.php?list=user"><i class="icon-chevron-right"></i> Users</a>
        </li>
        <li <?php if($page == 'about') echo 'class="active"';?>>
            <a href="about.php"><i class="icon-chevron-right"></i> About</a>
        </li>
        <li>
            <a href="script/logout.php"><i class="icon-chevron-right"></i> Log out</a>
        </li>
    </ul>
</div>