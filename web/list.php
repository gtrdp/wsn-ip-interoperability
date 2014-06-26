<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

$page = $_GET['list'];
include('pages/header.php');
include('script/db.php');

// the ribbon on the right
$ribbon['name'] = ($page == 'user')? 'Add New User':'Add New Profile';
$ribbon['href'] = ($page == 'user')? 'new-user.php':'new-profile.php';

if(isset($_POST['delete']) && $_POST['delete'] != '') {
    $id = $_POST['delete'];

    if($id == $_SESSION['id'])
        $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          Hey! It\'s You! You cannot delete yourself ._.</div>';
    else {
        if(mysql_query("DELETE FROM user WHERE id = $id"))
            $message = '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Success</h4>
                          You have successfully deleted the user.</div>';
        else
            $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          '.mysql_error().'</div>';
    }
    $page = 'user';
}

$data = array();
if($page == 'user') {
    $column_name = 'Username';

    if(isset($_GET['makeadmin']) && $_GET['makeadmin'] != '') {
        //set user as admin
        $id = $_GET['makeadmin'];

        if(mysql_query("UPDATE user SET superuser = 1 WHERE id = $id"))
            $message = '<div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Success</h4>
                          You have successfully changed the user to be administrator.</div>';
        else
            $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          '.mysql_error().'</div>';
    } elseif (isset($_GET['removeadmin']) && $_GET['removeadmin'] != '') {
        //remove user as admin
        $id = $_GET['removeadmin'];

        if($id == $_SESSION['id'])
            $message = '<div class="alert alert-error">
              <button type="button" class="close" data-dismiss="alert">x</button>
                            <h4>Error</h4>
                          Hey! It\'s You! You cannot remove admin for yourself.</div>';
        else {
            if(mysql_query("UPDATE user SET superuser = 0 WHERE id = $id"))
                $message = '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                                <h4>Success</h4>
                              You have successfully removed admin privilieges from the user.</div>';
            else
                $message = '<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                                <h4>Error</h4>
                              '.mysql_error().'</div>';
        }
    }

    $query = "SELECT * FROM user";
    $result = mysql_query($query) or die(mysql_error());
    while($foo = mysql_fetch_object($result)) {
        $bar = array($foo->username, $foo->id, $foo->superuser);
        array_push($data, $bar);
    }
}
?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
		
		<div class="span9" id="content">
        <?php echo $message; ?>
			<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">List of <?php echo ucwords($page); ?></div>
                                <div class="pull-right"><a href="<?php echo $ribbon['href']; ?>"> <span class="badge badge-success"><?php echo $ribbon['name']; ?></span></a></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $column_name; ?></th>
                                                <th colspan="3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data as $key => $value): ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo $value[0]; ?></td>
                                                <td><button class="btn btn-mini" type="button" onclick="location.href='edit-user.php?id=<?php echo $value[1]; ?>'">Edit</button></td>
                                                <?php if($value[2] == 1): ?>
                                                    <td><button class="btn btn-mini btn-warning" type="button" onclick="location.href='list.php?list=user&removeadmin=<?php echo $value[1]; ?>'">Remove Admin</button></td>
                                                <?php else: ?>
                                                    <td><button class="btn btn-mini btn-success" type="button" onclick="location.href='list.php?list=user&makeadmin=<?php echo $value[1]; ?>'">Make Admin</button></td>
                                                <?php endif; ?>
                                                <td><button class="btn btn-mini btn-danger" type="button" onclick="confirmation(<?php echo $value[1]; ?>)">Delete</button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
        </div>
<script type="text/javascript">
    function confirmation(userid) {
        if (confirm('Are you sure you want to delete this user?')) {
            //location.href = 'delete-user.php?id=' + userid;
            
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "list.php");

            var field = document.createElement("input");
            field.setAttribute("type", "hidden");
            field.setAttribute("name", "delete");
            field.setAttribute("value", userid);
            form.appendChild(field);

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