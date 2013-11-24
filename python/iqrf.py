import serial,sys

#check the required arguments
#if len(sys.argv) < 2:
#	print 'This program needs 2 arguments'

#else:
# /dev/ttyUSB0 is the usb to serial device
# Please check in your own configuration
xbee = serial.Serial('/dev/ttyUSB0', 4800, timeout=1)
#mode = sys.argv[1]
#relay= sys.argv[2]

# write char 'g' and get the returned temperature
xbee.write("g")
print xbee.read(10)

xbee.close()             # close port