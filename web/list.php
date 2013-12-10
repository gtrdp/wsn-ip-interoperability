<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

$page = $_GET['list'];
include('pages/header.php');
include('script/db.php');

$data = array();
if($page == 'user') {
    $query = "SELECT * FROM user";
    $result = mysql_query($query) or die(mysql_error());
    while($foo = mysql_fetch_object($result)) {
        $bar = array($foo->username, $foo->id);
        array_push($data, $bar);
    }

    $column_name = 'Username';
} elseif($page == 'profile') {

}
?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
		
		<div class="span9" id="content">
			<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">List of <?php echo strtoupper($page); ?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $column_name; ?></th>
                                                <th colspan="2">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($data as $key => $value): ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo $value[0]; ?></td>
                                                <td><button class="btn btn-mini" type="button" onclick="location.href='edit-user.php?id=<?php echo $value[1]; ?>'">Edit</button></td>
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
            location.href = 'delete-user.php?id=' + userid;
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