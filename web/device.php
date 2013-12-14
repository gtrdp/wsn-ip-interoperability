<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

if (!isset($_GET['device']) || ($_GET['device'] != 'xbee' && $_GET['device'] != 'iqrf'))
    header('Location: dashboard.php');

$page = $_GET['device'];
include('pages/header.php');
include('script/db.php');

// Check if delete device
if(isset($_POST['delete']) && $_POST['delete'] != '') {
    $id = $_POST['delete'];
    $device = $_POST['device'];
    $page = $device;

    if($device == 'iqrf') {
        if(mysql_query("DELETE FROM iqrf_device WHERE node_address = $id")){
            $message = '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Success</h4>
                          You have successfully deleted the device.</div>';

            // Ubbond the node
            $command = 'python /root/iqrf.py u'.$id;
            exec($command);
        }
        else
            $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          '.mysql_error().'</div>';
    } elseif ($device == 'xbee') {
        if(mysql_query("DELETE FROM xbee_device WHERE atmy = $id"))
            $message = '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Success</h4>
                          You have successfully deleted the device.</div>';
        else
            $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          '.mysql_error().'</div>';
    } else {
        $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          Missing device attribute.</div>';
    }
}

$data = array();
if($page == 'iqrf') {
    $query = "SELECT * FROM iqrf_device";
    $result = mysql_query($query) or die(mysql_error());

    // Check if there is no device
    if(mysql_num_rows($result) > 0) {
        $no_device = false;

        while($foo = mysql_fetch_object($result)) {
            $bar = array('id' => $foo->id, 'node_address' => $foo->node_address);
            array_push($data, $bar);
        }
    } else {
        $no_device = true;
    }
} elseif ($page == 'xbee') {
    $query = "SELECT * FROM xbee_device";
    $result = mysql_query($query) or die(mysql_error());

    // Check if there is no device
    if(mysql_num_rows($result) > 0) {
        $no_device = false;

        while($foo = mysql_fetch_object($result)) {
            $bar = array('id' => $foo->id, 'atmy' => $foo->atmy);
            array_push($data, $bar);
        }
        
        //check every xbee relay status
        foreach ($data as $key => $value) {
            $relay1_status[$key] = substr(exec('python /root/xbee.py status '. $value['atmy'] .' 1'), -1);
            $relay2_status[$key] = substr(exec('python /root/xbee.py status '. $value['atmy'] .' 2'), -1);

            if($relay1_status[$key] == 'H'){
                $relay1_percentage[$key]    = 100;
                $relay1[$key]               = 'ON';
                $checked1[$key]             = 'checked';
            } else {
                $relay1_percentage[$key]    = 0;
                $relay1[$key]               = 'OFF';
                $checked1[$key]             = '';
            }

            if($relay2_status[$key] == 'H'){
                $relay2_percentage[$key]  = 100;
                $relay2[$key]             = 'ON';
                $checked2[$key]           = 'checked';
            } else {
                $relay2_percentage[$key]  = 0;
                $relay2[$key]             = 'OFF';
                $checked2[$key]           = '';
            }
        }
    } else {
        $no_device = true;
    }
}
?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
		
		<div class="span9" id="content">
        <?php echo $message; ?>
			<div class="row-fluid">


            <?php if($page == 'xbee'): ?>
                <?php if($no_device): ?>
                    <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">No Device Installed</div>
                                <div class="pull-right"><a href="add-device.php?device=xbee"> <span class="badge badge-success">Add Device</span></a></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <p>Sorry, no device installed.</p>
                                </div>
                            </div>
                    </div>
                <?php else: ?>
                <?php foreach ($data as $key => $value): ?>
                    <div class="span6">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Relay Status of ATMY <?php echo $value['atmy']; ?></div>
                                <div class="pull-right"><span onclick="deleteXbee(<?php echo $value['atmy']; ?>)" style="cursor:pointer;" class="badge badge-important">Delete this device</span></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span6">
                                    <div class="chart chart-relay" data-percent="<?php echo $relay1_percentage[$key]; ?>">
                                        <span class="status-relay"><?php echo $relay1[$key]; ?></span>
                                    </div>
                                    <div class="chart-bottom-heading">
                                        <span class="label label-success">Relay 1</span><br><br>
                                        <div atmy="<?php echo $value['atmy']; ?>" relay-id="1" class="make-switch switch-small button-relay" data-on="success" data-off="warning">
                                            <input class="relay-checkbox" type="checkbox" <?php echo $checked1[$key]; ?>>
                                        </div>
                                    </div>
                                </div>

                                <div class="span6">
                                    <div class="chart chart-relay" data-percent="<?php echo $relay2_percentage[$key]; ?>">
                                        <span class="status-relay"><?php echo $relay2[$key]; ?></span>
                                    </div>
                                    <div class="chart-bottom-heading">
                                        <span class="label label-info">Relay 2</span><br><br>
                                        <div atmy="<?php echo $value['atmy']; ?>" relay-id="2" class="make-switch switch-small button-relay" data-on="success" data-off="warning">
                                            <input class="relay-checkbox" type="checkbox" <?php echo $checked2[$key]; ?>>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if($key%2 == 1): ?>
                        </div>
                        <div class="row-fluid">
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>



            <?php elseif($page == 'iqrf'): ?>
                <?php if($no_device): ?>
                    <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">No Device Bonded</div>
                                <div class="pull-right"><a href="add-device.php?device=iqrf"> <span class="badge badge-success">Add Device</span></a></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <p>Sorry, no device bonded.</p>
                                </div>
                            </div>
                    </div>
                <?php else: ?>
                <?php foreach ($data as $key => $value): ?>
                    <div class="span6">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">IQRF Temperature Node <?php echo $value['node_address']; ?></div>
                                <div class="pull-right"><span onclick="deleteIQRF(<?php echo $value['node_address']; ?>)" style="cursor:pointer;" class="badge badge-important">Delete this device</span></div>
                            </div>
                            <div class="block-content collapse in">
                                <div node="<?php echo $value['node_address']; ?>" class="temperatureGauge" style="height:180px"></div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                    <?php if($key%2 == 1): ?>
                        </div>
                        <div class="row-fluid">
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
            </div>

        </div>
<script type="text/javascript">
    function deleteXbee(atmy) {
        if (confirm('Are you sure you want to delete this device?')) {
            //location.href = 'delete-user.php?id=' + userid;
            
            var form = document.createElement("form");
            form.setAttribute("method", "post");

            var field = document.createElement("input");
            field.setAttribute("type", "hidden");
            field.setAttribute("name", "delete");
            field.setAttribute("value", atmy);
            form.appendChild(field);

            var field2 = document.createElement("input");
            field2.setAttribute("type", "hidden");
            field2.setAttribute("name", "device");
            field2.setAttribute("value", "xbee");
            form.appendChild(field2);

            document.body.appendChild(form);
            form.submit();
        } else {
            // Do nothing!
        }
    }

    function deleteIQRF(node) {
        if (confirm('Are you sure you want to delete this device?')) {
            //location.href = 'delete-user.php?id=' + userid;
            
            var form = document.createElement("form");
            form.setAttribute("method", "post");

            var field = document.createElement("input");
            field.setAttribute("type", "hidden");
            field.setAttribute("name", "delete");
            field.setAttribute("value", node);
            form.appendChild(field);

            var field2 = document.createElement("input");
            field2.setAttribute("type", "hidden");
            field2.setAttribute("name", "device");
            field2.setAttribute("value", "iqrf");
            form.appendChild(field2);

            document.body.appendChild(form);
            form.submit();
        } else {
            // Do nothing!
        }
    }
</script>

    </div>
</div>
</div>
    <hr>

<?php include('pages/footer.php'); ?>