<?php
$node = $_GET['node'];

$command = 'python /root/iqrf.py g'.$node;

echo substr(exec($command), 0, 2);

?>