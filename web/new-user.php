<?php include('pages/header.php'); ?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
        
        <div class="span9" id="content">
	        <!-- morris stacked chart -->
	        <div class="row-fluid">
	            <!-- block -->
	            <div class="block">
	                <div class="navbar navbar-inner block-header">
	                    <div class="muted pull-left">Add New User</div>
	                </div>
	                <div class="block-content collapse in">
	                    <div class="span12">
	                         <form class="form-horizontal">
	                            <legend>Basic Information</legend>
	                            <div class="control-group">
	                              <label class="control-label">Username</label>
	                              <div class="controls">
	                                <input class="input-xlarge focused" type="text">
	                              </div>
	                            </div>
	                            <div class="control-group">
	                              <label class="control-label">Full Name</label>
	                              <div class="controls">
	                                <input class="input-xlarge focused" type="text">
	                              </div>
	                            </div>
	                            <legend>Change Password</legend>
	                            <div class="control-group">
	                              <label class="control-label">Password</label>
	                              <div class="controls">
	                                <input class="input-xlarge" type="password">
	                              </div>
	                            </div>
	                            <div class="control-group">
	                              <label class="control-label">Retype Password</label>
	                              <div class="controls">
	                                <input class="input-xlarge" type="password">
	                              </div>
	                            </div>
	                            <div class="form-actions">
	                              <button type="submit" class="btn btn-primary">Save changes</button>
	                              <button type="reset" class="btn">Cancel</button>
	                            </div>	                        </form>
	                    </div>
	                </div>
	            </div>
	            <!-- /block -->
	        </div>
	    </div>
    </div>
    <hr>

<?php include('pages/footer.php'); ?>