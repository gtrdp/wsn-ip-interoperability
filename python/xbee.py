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

import serial,sys

#check the required arguments
if len(sys.argv) < 4:
	print 'This program needs 3 arguments'

else:
	xbee = serial.Serial('/dev/ttyUSB1', 9600, timeout=1)
	# Get the arguments
	atmy = sys.argv[1]
	mode = sys.argv[2]
	relay= sys.argv[3]

	# Start ATCOMMAND with +++
	xbee.write('+++')
	if xbee.read(10) == 'OK'
		# If OK, change the address using ATMY
		xbee.write('ATMY %d' % atmy)
		if xbee.read(10) == 'OK'
			# if OK, write the setting to the memory using ATWR
			xbee.write('ATWR')
			if xbee.read(10) == 'OK'
				# If OK, start the communication to the desired device
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
					print 'Your command is not recognized.'
			else:
				print 'Communication error.'
		else:
			print 'Communication error.'
	else:
		print 'Communication error.'

	xbee.close()             # close port
