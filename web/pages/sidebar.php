<div class="container-fluid">
<div class="row-fluid">

<div class="span3" id="sidebar">
    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
        <li <?php if($page == 'dashboard') echo 'class="active"';?>>
            <a href="dashboard.php"><i class="icon-chevron-right"></i> Dashboard</a>
        </li>
        <li <?php if($page == 'iqrf') echo 'class="active"';?>>
            <a href="device.php?device=iqrf"><i class="icon-chevron-right"></i> IQRF</a>
        </li>
        <li <?php if($page == 'xbee') echo 'class="active"';?>>
            <a href="device.php?device=xbee"><i class="icon-chevron-right"></i> XBee Relay</a>
        </li>
        <li <?php if($page == 'profile') echo 'class="active"';?>>
            <a href="list.php?list=profile"><i class="icon-chevron-right"></i> Profile</a>
        </li>
        <?php if($_SESSION['superuser'] == 1): ?>
        <li <?php if($page == 'user') echo 'class="active"';?>>
            <a href="list.php?list=user"><i class="icon-chevron-right"></i> Users</a>
        </li>
        <?php endif; ?>
        <li <?php if($page == 'about') echo 'class="active"';?>>
            <a href="about.php"><i class="icon-chevron-right"></i> About</a>
        </li>
        <li>
            <a href="script/logout.php"><i class="icon-chevron-right"></i> Log out</a>
        </li>
    </ul>
</div>