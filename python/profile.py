# Python script to communicate with arduino relay with XBee communications
# (c) @gunturdputra 2013
# Format:
# 	<iqrf node> <iqrf temperature> <atmy> <relay1> <relay2>
# Example:
# 	- If the temperature on node 5 is 30C then turn relay1 on and relay2 off on device with atmy 9
#		5 30 9 1 0
#	- If you do not want to use iqrf temperature just do:
#		0 0 9 1 0

# Importing PySerial library (serial) to read serial port
import serial,sys,time

#check the required arguments
if len(sys.argv) < 6:
	print 'This program needs 5 arguments'

else:
	# Get the parameter
	node = sys.argv[1]
	temperature = sys.argv[2]
	atmy = sys.argv[3]
	relay1 = sys.argv[4]
	relay2 =sys.argv[5]

	# If the iqrf node is zero, so we do not need iqrf sensor
	if node == 0 :
		# Open Serial port for XBee
		xbee = serial.Serial('/dev/ttyUSB0', 9600, timeout=3)

		# AT COMMAND for changing the destination address
		xbee.write('+++')					# Start ATCOMMAND with +++
		time.sleep(2)						# Wait to enter AT MODE
		xbee.write('ATDL ' + atmy + '\r\n')	# Change ATDL
		xbee.write('ATCN\r\n')				# Quit ATCOMMAND

		if relay1 == 1 :
			xbee.write("q")
		else:
			xbee.write("w")

		if relay2 == 1:
			xbee.write("e")
		else:
			xbee.write("r")
		
		# close port
		xbee.close()       

	# We need iqrf
	else:
		# Open Serial port for XBee
		xbee = serial.Serial('/dev/ttyUSB0', 9600, timeout=3)

		# AT COMMAND for changing the destination address
		xbee.write('+++')					# Start ATCOMMAND with +++
		time.sleep(2)						# Wait to enter AT MODE
		xbee.write('ATDL ' + atmy + '\r\n')	# Change ATDL
		xbee.write('ATCN\r\n')				# Quit ATCOMMAND

		# Open serial port for IQRF
		iqrf = serial.Serial('/dev/ttyUSB1', 4800, timeout=3)

		while 1:
			# Read temperature, if the temperature match, turn on/off the relay
			iqrf.write('g' + node)
			if iqrf.read(10) == temperature:
				if relay1 == 1:
					xbee.write("q")
				else:
					xbee.write("w")

				if relay2 == 1:
					xbee.write("e")
				else:
					xbee.write("r")
			else:
				# Turn off all relay
				xbee.write("w")
				xbee.write("r")
				# Sleep
				time.sleep(0.1)

