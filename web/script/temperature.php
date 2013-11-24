<?php
$command = 'python /root/iqrf.py';

echo substr(exec($command), 0, 2);

?>