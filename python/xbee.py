import serial,sys

#check the required arguments
if len(sys.argv) < 3:
	print 'This program needs 3 arguments'

else:
	xbee = serial.Serial('/dev/ttyUSB0', 9600, timeout=1)
	mode = sys.argv[1]
	relay= sys.argv[2]

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

	xbee.close()             # close port
