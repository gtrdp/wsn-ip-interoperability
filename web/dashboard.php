<?php
//check the relay status
$relay1_status = exec('python /root/xbee.py status 1');
$relay2_status = exec('python /root/xbee.py status 2');

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
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Relay Status</div>
                            <div class="pull-right"><a href="#"> <span class="badge badge-warning">View More</span></a></div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span6">
                                <div class="chart chart-relay-1" data-percent="<?php echo $relay1_percentage; ?>">
                                    <span class="status-relay-1"><?php echo $relay1; ?></span>
                                </div>
                                <div class="chart-bottom-heading">
                                    <span class="label label-success">Relay 1</span><br><br>
                                    <div class="make-switch switch-small button-relay-1" data-on="success" data-off="warning">
                                        <input id="relay1" type="checkbox" <?php echo $checked1; ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="chart chart-relay-2" data-percent="<?php echo $relay2_percentage; ?>">
                                    <span class="status-relay-2"><?php echo $relay2; ?></span>
                                </div>
                                <div class="chart-bottom-heading">
                                    <span class="label label-info">Relay 2</span><br><br>
                                    <div class="make-switch switch-small button-relay-2" data-on="success" data-off="warning">
                                        <input id="relay2" type="checkbox" <?php echo $checked2; ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <!-- block -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">IQRF Temperature</div>
                            <div class="pull-right"><a href="#"> <span class="badge badge-warning">View More</span></a></div>
                        </div>
                        <div class="block-content collapse in">
                            <div id="gaugeContainer" style="height:180px"></div>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6">
                    <!-- block -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Next Relay Schedule</div>
                            <div class="pull-right"><a href="schedule.php"> <span class="badge badge-warning">View More</span></a></div>
                        </div>
                        <div class="block-content collapse in">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Timestap</th>
                                        <th>Relay ID</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Oct 26 20:44:29</td>
                                        <td>1</td>
                                        <td>ON</td>
                                        <td>OK</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Oct 27 20:47:29</td>
                                        <td>2</td>
                                        <td>ON</td>
                                        <td>NULL</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Oct 28 20:44:29</td>
                                        <td>1</td>
                                        <td>OFF</td>
                                        <td>NULL</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
                <div class="span6">
                    <!-- block -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Registered Users</div>
                            <div class="pull-right"><a href="user.php"> <span class="badge badge-warning">View More</span></a></div>
                        </div>
                        <div class="block-content collapse in">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>gtrdp</td>
                                        <td><button class="btn btn-mini" type="button">Edit</button></td>
                                        <td><button class="btn btn-mini btn-danger" type="button">Delete</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td><button class="btn btn-mini" type="button">Edit</button></td>
                                        <td><button class="btn btn-mini btn-danger" type="button">Delete</button></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Vincent</td>
                                        <td><button class="btn btn-mini" type="button">Edit</button></td>
                                        <td><button class="btn btn-mini btn-danger" type="button">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /block -->
                </div>
            </div>
        </div>
    </div>
    <hr>
    <?php include('pages/footer.php'); ?>