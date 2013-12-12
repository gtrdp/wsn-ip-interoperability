<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

if(isset($_POST['type']) && $_POST['type'] == 'basic_info') {
	include('script/db.php');

	$full_name = mysql_real_escape_string($_POST['full_name']);
	$username = $_SESSION['username'];
	$query = "UPDATE user SET full_name = '$full_name' WHERE username = '$username'";
	if(mysql_query($query)) {
		$message = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Success</h4>
                        	You have successfully changed your name.</div>';
        $_SESSION['full_name'] = $full_name;
	}
    else
    	$message = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                        	Something went wrong.</div>';
} elseif (isset($_POST['type']) && $_POST['type'] == 'password') {
	include('script/db.php');

	$username = $_SESSION['username'];
	$old_password = md5(mysql_real_escape_string($_POST['old_password']));
	$new_password = md5(mysql_real_escape_string($_POST['new_password']));
	$new_password_retype = md5(mysql_real_escape_string($_POST['new_password_retype']));

	if($new_password != $new_password_retype)
		$message = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                        	New password is not typed correctly.</div>';
    else {
    	$password = mysql_fetch_object(mysql_query("SELECT password FROM user WHERE username = '$username'"))->password;
    	if($old_password != $password)
    		$message = '<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                        	Your old password is incorrect.</div>';
        else {
        	$query = "UPDATE user SET password = '$new_password' WHERE username = '$username'";
        	if(mysql_query($query)) {
				$message = '<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">x</button>
		                            <h4>Success</h4>
		                        	You have successfully changed your password. Please re-login.</div>';
			}
		    else
		    	$message = '<div class="alert alert-error">
									<button type="button" class="close" data-dismiss="alert">x</button>
		                            <h4>Error</h4>
		                        	'.mysql_error().'</div>';
        }
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
	                    <div class="muted pull-left">Profile</div>
	                </div>
	                <div class="block-content collapse in">
	                    <div class="span12">
	                         <form class="form-horizontal" method="post">
	                         <input type="hidden" name="type" value="basic_info">
	                            <legend>Basic Information</legend>
	                            <div class="control-group">
	                              <label class="control-label">Username</label>
	                              <div class="controls">
	                                <span class="input-xlarge uneditable-input"><?php echo $_SESSION['username']; ?></span>
	                              </div>
	                            </div>
	                            <div class="control-group">
	                              <label class="control-label">Full Name</label>
	                              <div class="controls">
	                                <input name="full_name" class="input-xlarge focused" type="text" value="<?php echo $_SESSION['full_name']; ?>">
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
	        <div class="row-fluid">
	            <!-- block -->
	            <div class="block">
	                <div class="navbar navbar-inner block-header">
	                    <div class="muted pull-left">Password</div>
	                </div>
	                <div class="block-content collapse in">
	                    <div class="span12">
	                         <form class="form-horizontal" method="post">
	                         <input type="hidden" name="type" value="password">
	                            <legend>Change Password</legend>
	                            <div class="control-group">
	                              <label class="control-label">Old Password</label>
	                              <div class="controls">
	                                <input name="old_password" class="input-xlarge" type="password">
	                              </div>
	                            </div>
	                            <div class="control-group">
	                              <label class="control-label">New Password</label>
	                              <div class="controls">
	                                <input name="new_password" class="input-xlarge" type="password">
	                              </div>
	                            </div>
	                            <div class="control-group">
	                              <label class="control-label">Retype New Password</label>
	                              <div class="controls">
	                                <input name="new_password_retype" class="input-xlarge" type="password">
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