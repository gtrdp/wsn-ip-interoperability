<?php

$status = $_GET['status'];
$relay 	= $_GET['relay'];
$atmy 	= $_GET['atmy'];

$command = 'python /root/xbee.py ' . $status . ' ' . $atmy . ' ' .$relay;

exec($command);

?>