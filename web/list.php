<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');

$page = $_GET['list'];
include('pages/header.php');
?>

<div class="container-fluid">
    <div class="row-fluid">
        <?php include('pages/sidebar.php'); ?>
		
		<div class="span9" id="content">
			<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">List of Registered User</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
  									<table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>gtrdp</td>
                                        <td><button class="btn btn-mini" type="button">Edit</button></td>
                                        <td><button class="btn btn-mini btn-danger" type="button">Delete</button></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td><button class="btn btn-mini" type="button">Edit</button></td>
                                        <td><button class="btn btn-mini btn-danger" type="button">Delete</button></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Vincent</td>
                                        <td><button class="btn btn-mini" type="button">Edit</button></td>
                                        <td><button class="btn btn-mini btn-danger" type="button">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
        </div>


    </div>
</div>
</div>
    <hr>

<?php include('pages/footer.php'); ?>