<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

if(isset($_POST['username'])) {
	include('script/db.php');

	$full_name = mysql_real_escape_string($_POST['full_name']); 
	$username = mysql_real_escape_string($_POST['username']);
	$password = mysql_real_escape_string($_POST['password']);
	$password_retype = mysql_real_escape_string($_POST['password_retype']);
	if($username == '' or $password == '' or $password_retype == '' or $full_name == '') {
		$message = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                        	Some forms contain are blank.</div>';
	} elseif($password != $password_retype) {
		$message = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                        	The password doesn\'t match.</div>';
	} else {
		$query = "INSERT INTO user (full_name, username, password) VALUES ('$full_name', '$username', MD5('$password'))";
		if(mysql_query($query)) {
			$message = '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">x</button>
	                            <h4>Success</h4>
	                        	You have successfully added new user.</div>';
		}
	    else
	    	$message = '<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">x</button>
	                            <h4>Error</h4>
	                        	'.mysql_error().'</div>';
	}
}

$page = 'user';
include('pages/header.php');
?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
        
        <div class="span9" id="content">
        	<?php echo $message; ?>
	        <!-- morris stacked chart -->
	        <div class="row-fluid">
	            <!-- block -->
	            <div class="block">
	                <div class="navbar navbar-inner block-header">
	                    <div class="muted pull-left">Add New User</div>
	                </div>
	                <div class="block-content collapse in">
	                    <div class="span12">
	                         <form class="form-horizontal" method="post">
	                            <legend>Basic Information</legend>
	                            <div class="control-group">
	                              <label class="control-label">Username</label>
	                              <div class="controls">
	                                <input name="username" class="input-xlarge focused" type="text">
	                              </div>
	                            </div>
	                            <div class="control-group">
	                              <label class="control-label">Full Name</label>
	                              <div class="controls">
	                                <input name="full_name" class="input-xlarge focused" type="text">
	                              </div>
	                            </div>
	                            <legend>Change Password</legend>
	                            <div class="control-group">
	                              <label class="control-label">Password</label>
	                              <div class="controls">
	                                <input name="password" class="input-xlarge" type="password">
	                              </div>
	                            </div>
	                            <div class="control-group">
	                              <label class="control-label">Retype Password</label>
	                              <div class="controls">
	                                <input name="password_retype" class="input-xlarge" type="password">
	                              </div>
	                            </div>
	                            <div class="form-actions">
	                              <button type="submit" class="btn btn-primary">Save changes</button>
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