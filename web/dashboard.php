<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

// Dashboard will display one device per sensor
// Fetch the data first
include('script/db.php');

// IQRF
$result = mysql_query("SELECT * FROM iqrf_device LIMIT 0,1");
if(mysql_num_rows($result) == 0)
    $iqrf_no_device = true;
else {
    $iqrf_no_device = false;

    $result = mysql_fetch_object($result);
    $id = $result->id;
    $node_address = $result->node_address;
}

// XBee
$result = mysql_query("SELECT * FROM xbee_device LIMIT 0,1");
if(mysql_num_rows($result) == 0)
    $xbee_no_device = true;
else {
    $xbee_no_device = false;

    $result = mysql_fetch_object($result);
    $id = $result->id;
    $atmy = $result->atmy;
}

//check the relay status
$relay1_status = substr(exec('python /root/xbee.py status '. $atmy .' 1'), -1);
$relay2_status = substr(exec('python /root/xbee.py status '. $atmy .' 2'), -1);

if($relay1_status == 'H'){
    $relay1_percentage = 100;
    $relay1 = 'ON';
    $checked1 = 'checked';
} else {
    $relay1_percentage = 0;
    $relay1 = 'OFF';
    $checked1 = '';
}

if($relay2_status == 'H'){
    $relay2_percentage  = 100;
    $relay2             = 'ON';
    $checked2           = 'checked';
} else {
    $relay2_percentage  = 0;
    $relay2             = 'OFF';
    $checked2           = '';
}

// page description
$page = 'dashboard';
?>

<?php include('pages/header.php'); ?> 


<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
        
        <!--/span-->
        <div class="span9" id="content">
            <div class="row-fluid">
            	<div class="navbar">
                	<div class="navbar-inner">
                        <ul class="breadcrumb">
                            <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                            <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                            <li>
                                <a href="dashboard.php">Dashboard</a>
                            </li>
                        </ul>
                	</div>
            	</div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <div class="block">
                        <?php if($xbee_no_device): ?>
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Relay Status</div>
                            <div class="pull-right"><a href="add-device.php?device=xbee"> <span class="badge badge-success">Add Device</span></a></div>
                        </div>
                        <div class="block-content collapse in">
                            <p>Sorry, no device installed.</p>
                        </div>


                        <?php else: ?>
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Relay Status of ATMY <?php echo $atmy; ?></div>
                            <div class="pull-right"><a href="device.php?device=xbee"> <span class="badge badge-warning">View More</span></a></div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span6">
                                <div class="chart chart-relay" data-percent="<?php echo $relay1_percentage; ?>">
                                    <span class="status-relay"><?php echo $relay1; ?></span>
                                </div>
                                <div class="chart-bottom-heading">
                                    <span class="label label-success">Relay 1</span><br><br>
                                    <div atmy="<?php echo $atmy; ?>" relay-id="1" class="make-switch switch-small button-relay" data-on="success" data-off="warning">
                                        <input class="relay-checkbox" type="checkbox" <?php echo $checked1; ?> >
                                    </div>
                                </div>
                            </div>

                            <div class="span6">
                                <div class="chart chart-relay" data-percent="<?php echo $relay2_percentage; ?>">
                                    <span class="status-relay"><?php echo $relay2; ?></span>
                                </div>
                                <div class="chart-bottom-heading">
                                    <span class="label label-info">Relay 2</span><br><br>
                                    <div atmy="<?php echo $atmy; ?>" relay-id="2" class="make-switch switch-small button-relay" data-on="success" data-off="warning">
                                        <input class="relay-checkbox" type="checkbox" <?php echo $checked2; ?> >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="span6">
                    <!-- block -->
                    <div class="block">
                        <?php if($iqrf_no_device): ?>
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">IQRF Temperature</div>
                            <div class="pull-right"><a href="add-device.php?device=iqrf"> <span class="badge badge-success">Add Device</span></a></div>
                        </div>
                        <div class="block-content collapse in">
                            <p>Sorry, no iqrf node bonded.</p>
                        </div>
                        <?php else: ?>
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">IQRF Temperature</div>
                            <div class="pull-right"><a href="device.php?device=iqrf"> <span class="badge badge-warning">View More</span></a></div>
                        </div>
                        <div class="block-content collapse in">
                            <div node="<?php echo $node_address; ?>" class="temperatureGauge" style="height:180px"></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- /block -->
                </div>
            </div>
        </div>
    </div>
    <hr>
    <?php include('pages/footer.php'); ?>