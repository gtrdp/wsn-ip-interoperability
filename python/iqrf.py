# Python script to communicate with iqrf nodes
# (c) @gunturdputra 2013
# Available commands:
# 	g<address>	: Get temperature from specified device
# 		eg. g2
# 	b<addrees>	: Bond specified address
# 		eg. b2
# 	u<address>	: unbond specified address
# 		eg. u2

# Importing PySerial library (serial) to read serial port
import serial,sys

#check the required arguments
if len(sys.argv) < 2:
	print 'This program needs 1 arguments'

else:
	# Get the commands
	command = sys.argv[1]

	# xbee is a variable that refers to serial port:
	# 	path: 		/dev/ttyUSB0
	# 	baud rate: 	4800
	xbee = serial.Serial('/dev/ttyUSB1', 4800, timeout=3)

	# write char 'g' and get the returned temperature
	xbee.write(command)
	print xbee.read(10)

	# close port
	xbee.close()