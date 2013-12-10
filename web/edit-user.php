<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

$page = 'user';
$userid = $_GET['id'];
include('pages/header.php');
include('script/db.php');

if(isset($_POST['type']) && $_POST['type'] == 'basic_info') {

  $full_name = mysql_real_escape_string($_POST['full_name']);
  $query = "UPDATE user SET full_name = '$full_name' WHERE id = $userid";

  if(mysql_query($query)) {
    $message = '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Success</h4>
                          You have successfully changed the name.</div>';
  }
    else
      $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          '.mysql_error().'</div>';
} elseif (isset($_POST['type']) && $_POST['type'] == 'password') {

  $old_password = md5(mysql_real_escape_string($_POST['old_password']));
  $new_password = md5(mysql_real_escape_string($_POST['new_password']));
  $new_password_retype = md5(mysql_real_escape_string($_POST['new_password_retype']));

  if($new_password != $new_password_retype)
    $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          New password is not typed correctly.</div>';
    else {
      $password = mysql_fetch_object(mysql_query("SELECT password FROM user WHERE id = $userid"))->password;
      if($old_password != $password)
        $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          Your old password is incorrect.</div>';
        else {
          $query = "UPDATE user SET password = '$new_password' WHERE id = $userid";
          if(mysql_query($query)) {
        $message = '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                                <h4>Success</h4>
                              You have successfully changed the password.</div>';
      }
        else
          $message = '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                                <h4>Error</h4>
                              '.mysql_error().'</div>';
        }
    }
}

$query = "SELECT * FROM user WHERE id = $userid";
$result = mysql_query($query) or die(mysql_error());

$result = mysql_fetch_object($result);
$full_name = $result->full_name;
$username = $result->username;
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
                              <fieldset>
                                <legend>Basic Information</legend>
                                <div class="control-group">
                                  <label class="control-label">Username</label>
                                  <div class="controls">
                                    <span class="input-xlarge uneditable-input"><?php echo $username; ?></span>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <label class="control-label">Full Name</label>
                                  <div class="controls">
                                    <input name="full_name" class="input-xlarge focused" type="text" value="<?php echo $full_name; ?>">
                                  </div>
                                </div>
                                <div class="form-actions">
                                  <button type="submit" class="btn btn-primary">Save changes</button>
                                  <button type="reset" class="btn">Cancel</button>
                                </div>
                              </fieldset>
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
                              <fieldset>
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
                              </fieldset>
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