# Python script to communicate with arduino relay with XBee communications
# (c) @gunturdputra 2013
# Available commands:
# 	on <atmy> <relay_number>
# 		turn on specified <relay_number> on <atmy> device
# 		eg. on 2 1
# 	on <atmy> <relay_number>
# 		turn off specified <relay_number> on <atmy> device
# 		eg. off 2 1
# 	status <atmy> <relay_number>
# 		check specified <relay_number> status on <atmy> device
# 		eg. status 2 1

import serial,sys,time

#check the required arguments
if len(sys.argv) < 4:
	print 'This program needs 3 arguments'

else:
	xbee = serial.Serial('/dev/ttyUSB0', 9600, timeout=3)
	# Get the arguments
	mode = sys.argv[1]
	atmy = sys.argv[2]
	relay= sys.argv[3]

	# AT COMMAND for changing the destination address
	xbee.write('+++')					# Start ATCOMMAND with +++
	time.sleep(2)						# Wait to enter AT MODE
	xbee.write('ATDL ' + atmy + '\r\n')	# Change ATDL
	xbee.write('ATCN\r\n')				# Quit ATCOMMAND

	if mode == "on" :
		if relay == "1":
			xbee.write("q")
		elif relay == "2":
			xbee.write("e")

	elif mode == "off" :
		if relay == "1":
			xbee.write("w")
		elif relay == "2":
			xbee.write("r")

	elif mode == "status" : 
		if relay == "1":
			xbee.write("a")
			print xbee.read(10)
		elif relay == "2":
			xbee.write("s")
			print xbee.read(10)
	else:
		print 'You command is not recognized'

	xbee.close()             # close port
