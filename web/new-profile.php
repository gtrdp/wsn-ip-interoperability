<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

$page = 'profile';
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
                            <div id="gaugeSetting" style="height:180px;width:250px;"></div>
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
                                        <input id="relay1" type="checkbox">
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
                                        <input id="relay2" type="checkbox">
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
	                         <form class="form-horizontal">
	                            <legend>Profile Setting</legend>
	                            
	                        	<div class="control-group">
                                  <label class="control-label">#IQRF Node</label>
                                  <div class="controls">
                                    <select id="selectError">
                                   	  <option>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                    <p class="help-block">Your node address for this profile.
                                    Choose 0 if you do not want to use temperature sensor.</p>
                                  </div>
                                </div>

                                <div class="control-group">
                                  <label class="control-label">#XBee Relay</label>
                                  <div class="controls">
                                    <select id="selectError">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                    <p class="help-block">Your Xbee address for this profile.</p>
                                  </div>
                                </div>

								<div class="control-group">
                                  <label class="control-label" for="optionsCheckbox">Configure Datetime?</label>
                                  <div class="controls">
                                    <label class="uniform">
                                      <input type="checkbox" id="optionsCheckbox">
                                    </label>
                                  </div>
                                </div>

                                <div class="control-group">
                                  <label class="control-label" for="date01">Date input</label>
                                  <div class="controls">
                                  	<div id="enabledDatetime" style="display:none;">
                                  		<input type="text" class="datepicker" id="date01" value="02/16/12">
                                    	<input id="waktu" type="text" value="1:00am">
                                  	</div>
                                  	<div id="disabledDatetime">
                                  		<input class="disabled" type="text" value="Datetime is disabled." disabled>
                                    	<input class="disabled" type="text" value="Datetime is disabled." disabled>
                                  	</div>
                                    <p class="help-block">
                                    	Select the time this profile will run at.
                                    </p>
                                  </div>
                                </div>

	                            <div class="form-actions">
	                              <button type="submit" class="btn btn-primary">Add Profile</button>
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