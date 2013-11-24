<?php

$status = $_GET['status'];
$relay 	= $_GET['relay'];

$command = 'python /root/xbee.py ' . $status . ' ' . $relay;

exec($command);

?>