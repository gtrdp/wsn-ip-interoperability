<?php

include('script/db.php');

$status = $_GET['status'];
$query 	= "INSERT INTO admin_page (status) VALUES('$status')";

mysql_query($query);

?>