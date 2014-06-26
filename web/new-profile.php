<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

$page = 'profile';

include('script/db.php');
// Receive POST request
if($_POST['profile_name'] != '') {
  $profile_name = $_POST['profile_name'];
  $iqrf_node = $_POST['iqrf-node'];
  $atmy = $_POST['xbee-atmy'];
  $date_check = ($_POST['optionsCheckbox'] == 'true')? 'true':'false';
  $date = $_POST['date'];
  $time = $_POST['waktu'];
  $relay1 = $_POST['relay1'];
  $relay2 = $_POST['relay2'];
  $temperature = $_POST['temperature'];

  echo 'profile '.$profile_name .'iqrf '. $iqrf_node .'atmy '. $atmy.'datecheck '.$date_check.'date '.$date.'time '.$time.'relay1 '.$relay1.'relay2 '.$relay2.'temper '.$temperature;
}


// Get available iqrf node and xbee device
//iqrf
$iqrf_node = array();
$result = mysql_query("SELECT * FROM iqrf_device");
while($foo = mysql_fetch_object($result))
  array_push($iqrf_node, $foo->node_address);

//xbee
$xbee_atmy = array();
$result = mysql_query("SELECT * FROM xbee_device");
while($foo = mysql_fetch_object($result))
  array_push($xbee_atmy, $foo->atmy);

include('pages/header.php');
?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
        
        <div class="span9" id="content">
       		<div class="row-fluid">
            	<div class="navbar">
                	<div class="navbar-inner">
                        <ul class="breadcrumb">
                            <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
                            <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
                            <li>
                                <a href="new-profile.php">
                                	Add New Profile
                                </a>
                            </li>
                        </ul>
                	</div>
            	</div>
            </div>
	        <!-- morris stacked chart -->
	        <div class="row-fluid">
	            <div class="span4">
                    <!-- block -->
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">IQRF Temperature</div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="temperatureGauge" style="height:180px;width:250px;"></div>
                        </div>
                        <p style="margin:5px;">
                        	<small>
                        	<em>Hover the cursor to the gauge and scroll to change the temperature.</em>
                        	</small>
                        </p>
                    </div>
                    <!-- /block -->
                </div>
                <div class="span8">
                    <div class="block">
                        <div class="navbar navbar-inner block-header">
                            <div class="muted pull-left">Relay Configuration</div>
                        </div>
                        <div class="block-content collapse in">
                            <div class="span6">
                                <div class="chart chart-relay-1" data-percent="0">
                                    <span class="status-relay-1">OFF</span>
                                </div>
                                <div class="chart-bottom-heading">
                                    <span class="label label-success">Relay 1</span><br><br>
                                    <div class="make-switch switch-small button-relay-1" data-on="success" data-off="warning">
                                        <input id="relay1" type="checkbox" value="true">
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="chart chart-relay-2" data-percent="0">
                                    <span class="status-relay-2">OFF</span>
                                </div>
                                <div class="chart-bottom-heading">
                                    <span class="label label-info">Relay 2</span><br><br>
                                    <div class="make-switch switch-small button-relay-2" data-on="success" data-off="warning">
                                        <input id="relay2" type="checkbox" value="true">
                                    </div>
                                </div>
                            </div>
                            <p style="margin:5px;">
                        	<small>
                        	<em>&nbsp;<br>Click the switch to toggle the following relay status.</em>
                        	</small>
                        </p>
                        </div>
                    </div>
                </div>
	        </div>

	        <div class="row-fluid">    
	            <div class="span12">
		            <div class="block">
		                <div class="navbar navbar-inner block-header">
		                    <div class="muted pull-left">Add New Profile</div>
		                </div>
		                <div class="block-content collapse in">
	                         <form id="form-new-profile" class="form-horizontal" onsubmit="return validateForm();" method="post">
	                            <legend>Profile Setting</legend>
	                          <div class="control-group">
                              <label class="control-label">Profile Name</label>
                              <div class="controls">
                                <input id="profile_name" name="profile_name" class="input-xlarge focused" type="text">
                              </div>
                            </div>
	                        	<div class="control-group">
                                  <label class="control-label">#IQRF Node</label>
                                  <div class="controls">
                                    <select id="iqrf-node" name="iqrf-node">
                                   	  <option value="0">0</option>
                                      <?php foreach ($iqrf_node as $foo): ?>
                                        <option value="<?php echo $foo; ?>"><?php echo $foo; ?></option>  
                                      <?php endforeach; ?>
                                    </select>
                                    <p class="help-block">Your node address for this profile.
                                    Choose 0 if you do not want to use temperature sensor.</p>
                                  </div>
                                </div>

                                <div class="control-group">
                                  <label class="control-label">#XBee Relay</label>
                                  <div class="controls">
                                    <select id="xbee-atmy" name="xbee-atmy">
                                      <option value="0">Select Device</option>
                                    <?php foreach ($xbee_atmy as $foo): ?>
                                      <option value="<?php echo $foo; ?>"><?php echo $foo; ?></option>  
                                    <?php endforeach; ?>
                                    </select>
                                    <p class="help-block">Your Xbee address for this profile.</p>
                                  </div>
                                </div>

								<div class="control-group">
                                  <label class="control-label" for="optionsCheckbox">Configure Datetime?</label>
                                  <div class="controls">
                                    <label class="uniform">
                                      <input type="checkbox" id="optionsCheckbox" checked="checked" name="optionsCheckbox" value="true">
                                    </label>
                                  </div>
                                </div>

                                <div class="control-group">
                                  <label class="control-label" for="date01">Date input</label>
                                  <div class="controls">
                                  	<div id="enabledDatetime">
                                  		<input type="text" class="datepicker" id="date" name="date" >
                                    	<input id="waktu" type="text" name="waktu" >
                                  	</div>
                                  	<div id="disabledDatetime" style="display:none;">
                                  		<input class="disabled" type="text" value="Datetime is disabled." disabled>
                                    	<input class="disabled" type="text" value="Datetime is disabled." disabled>
                                  	</div>
                                    <p class="help-block">
                                    	Select the time this profile will run at.
                                    </p>
                                  </div>
                                </div>

	                            <div class="form-actions">
	                              <button class="btn btn-primary">Add Profile</button>
	                              <button type="reset" class="btn">Cancel</button>
	                            </div>
	                        </form>
		                </div>
		            </div>
		        </div>
	            <!-- /block -->
	        </div>
	    </div>
    </div>
    <hr>

<?php include('pages/footer.php'); ?>