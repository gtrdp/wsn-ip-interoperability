<?php
include('db.php');

// Check received data
$device = $_GET['device'];
$address = $_GET['address'];

// Validate input
if($address > 100 || $address < 0)
	echo 'ERROR!
Address is out of range. Please enter a number between 0 to 100.';
elseif($address == 0 || $address == 1)
	echo 'ERROR!
Address 0 and 1 are reserved for coordinator.';
else {
	// First check if the specified note exists
	if($device == 'iqrf')
		$query = "SELECT * FROM iqrf_device WHERE node_address = $address";
	elseif ($device == 'xbee')
		$query = "SELECT * FROM xbee_device WHERE atmy = $address";

	$result = mysql_query($query);

	if(mysql_num_rows($result) > 0)
		echo 'Desired address is already occupied.';
	else {
		// Then check the connection
		if($device == 'iqrf') {
			// bond desired node
			$command = 'python /root/iqrf.py b' . $address;

			// If OK -> add the device to database
			if(substr(exec($command), 0, 2) == 'OK') {
				if(mysql_query("INSERT INTO iqrf_device (node_address) VALUES ($address)"))
					echo 'The process is successful!';
				else
					echo mysql_error();
			}
		} elseif($device == 'xbee') {
			// Turn on relay 1
			exec('python /root/xbee.py on '. $address .' 1');
			// Turn off relay 1
			exec('python /root/xbee.py off '. $address .' 1');
			// Check status
			if(exec('python /root/xbee.py status '. $address .'1') == 'L') {
				if(mysql_query("INSERT INTO xbee_device (atmy) VALUES ($address)"))
					echo 'The process is successful!';
				else
					echo mysql_error();
			} else 
				echo 'ERROR!
Your device is not reponding, failed to add new device';
		}
	}
}
?>