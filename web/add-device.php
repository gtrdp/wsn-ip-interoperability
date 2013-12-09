<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

$page = $_GET['device'];
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
                                <a href="add-device.php?<?php echo $_GET['device']; ?>">
                                	Add New <?php echo strtoupper($_GET['device']);?> Device
                                </a>
                            </li>
                        </ul>
                	</div>
            	</div>
            </div>
	        <!-- morris stacked chart -->
	        <div class="row-fluid">
	            <!-- block -->
	            <div class="block">
	                <div class="navbar navbar-inner block-header">
	                    <div class="muted pull-left">Add New <?php echo strtoupper($_GET['device']);?> Device</div>
	                </div>
	                <div class="block-content collapse in">
	                    <div class="span12">
	                    <legend>Read Me First</legend>
	                    	<div class="alert alert-block">
								<a class="close" data-dismiss="alert" href="#">&times;</a>
								<h4 class="alert-heading">Warning!</h4>
								Please make sure that you have read this information carefully
								before you proceed to further process. Thank you.
							</div>
							<?php if($_GET['device'] == 'xbee'):?>
							<p>Before proceed, please make sure that your device meets these following conditions:
								<ol>
									<li>The device is Arduino Uno + Relay Shield + XBee.</li>
									<li>Arduino Uno must be installed with the <a href="https://github.com/gtrdp/wsn-ip-interoperability" target="_blank">required program</a>.</li>
									<li>XBee must be configured to connect to the coordinator using this configuration:</li>
									<ul>
										<li>ATID: 1234</li>
										<li>ATMY: <em>your device address</em></li>
										<li>ATDH: 0</li>
										<li>ATDL: 1</li>
									</ul>
									You can find XBee basic tutorial <a href="http://examples.digi.com/get-started/basic-xbee-802-15-4-chat/3/" target="_blank">here</a>.
								</ol>
							</p>
							<?php elseif($_GET['device'] == 'iqrf'):?>
							<p>Before proceed, please make sure that your device meets these following conditions:
							<ol>
								<li>The device is IQRF TR-52 Series with evaluation board installed.</li>
								<li>The device must be installed with the <a href="https://github.com/gtrdp/wsn-ip-interoperability" target="_blank">required program</a>.</li>
								<li>In order to bond the node to the coordinator, follow this steps:</li>
								<ul>
									<li>Add the device using this web app by submitting the form below. The coordinator then will call BondNewNode function.</li>
									<li>Turn on your device. When the Red LED start blinking, push the button.</em></li>
									<li>If the bonding process succeeded, your device green LED will flash up and success notification appears on the web app.</li>
									<li>If the bonding process failed, there will be a notification in the web app.</li>
								</ul>
							</ol>
							</p>
							<?php else: ?>
								ERROR!
							<?php endif; ?>

	                         <form class="form-horizontal">
	                            <legend>Add New <?php echo strtoupper($_GET['device']);?> Device</legend>
	                        <?php if($_GET['device'] == 'xbee'):?>
	                            <div class="control-group">
	                              <label class="control-label">ATMY</label>
	                              <div class="controls">
	                                <input class="input-xlarge" type="text">
	                                <p class="help-block">Your device address.</p>
	                              </div>
	                            </div>
	                        <?php elseif($_GET['device'] == 'iqrf'):?>
	                        	<div class="control-group">
	                              <label class="control-label">Node Address</label>
	                              <div class="controls">
	                                <input class="input-xlarge" type="text">
	                                <p class="help-block">Your device address.</p>
	                              </div>
	                            </div>
	                        <?php else: ?>
								ERROR!
							<?php endif; ?>
	                            <div class="form-actions">
	                              <button type="submit" class="btn btn-primary">Add This Device</button>
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