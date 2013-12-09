<?php
session_start();

if(isset($_POST['username']) && $_POST['username'] != '') {
  include('script/db.php');

  $username = mysql_escape_string($_POST['username']);
  $password = md5(mysql_escape_string($_POST['password']));
  $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
  $result = mysql_query($query);

  if(mysql_num_rows($result) > 0) {
    $data = mysql_fetch_array($result);
    $_SESSION['full_name']  = $data['full_name'];
    $_SESSION['username']   = $data['username'];
    header('Location: dashboard.php');
  }
  else
    $error = '<div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <strong>Error!</strong> Username or password doesn\'t match.
                  </div>';
} elseif(isset($_SESSION['username'])) {
  header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin Login</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">

      <form class="form-signin" action="index.php" method="post">
        <h2 class="form-signin-heading">Please Log in</h2>
        <?php echo $error;?>
        <input type="text" name="username" class="input-block-level" placeholder="Username">
        <input type="password" name="password" class="input-block-level" placeholder="Password">
        <!--<label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>-->
        <button class="btn btn-large btn-primary" type="submit">Log in</button>
      </form>

    </div> <!-- /container -->
    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>