# Importing PySerial library (serial) to read serial port
import serial,sys

# xbee is a variable that refers to serial port:
# 	path: 		/dev/ttyUSB0
# 	baud rate: 	4800
xbee = serial.Serial('/dev/ttyUSB0', 4800)

# write char 'g' and get the returned temperature
xbee.write("g")
print xbee.read(10)

# close port
xbee.close()