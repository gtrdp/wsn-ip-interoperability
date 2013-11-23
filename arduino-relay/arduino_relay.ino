/*
  Software serial multple serial test
 
 Receives from the hardware serial, sends to software serial.
 Receives from software serial, sends to hardware serial.
 
 The circuit: 
 * RX is digital pin 10 (connect to TX of other device)
 * TX is digital pin 11 (connect to RX of other device)
 
 Note:
 Not all pins on the Mega and Mega 2560 support change interrupts, 
 so only the following can be used for RX: 
 10, 11, 12, 13, 50, 51, 52, 53, 62, 63, 64, 65, 66, 67, 68, 69
 
 Not all pins on the Leonardo support change interrupts, 
 so only the following can be used for RX: 
 8, 9, 10, 11, 14 (MISO), 15 (SCK), 16 (MOSI).
 
 created back in the mists of time
 modified 25 May 2012
 by Tom Igoe
 based on Mikal Hart's example
 
 This example code is in the public domain.
 
 Command:
 q - turn on   relay 1
 w - turn off  relay 1
 e - turn on   relay 2
 r - turn off  relay 2
 a - check status relay 1
 s - check status relay 2
 
 */
#include <SoftwareSerial.h>

SoftwareSerial xbee(0, 1); // RX, TX

//relay
int relay1 = 4;
int relay2 = 5;
char inChar;

void setup()  
{
  // Open serial communications and wait for port to open:
  Serial.begin(9600);
  while (!Serial) {
    ; // wait for serial port to connect. Needed for Leonardo only
  }

  // set the data rate for the SoftwareSerial port
  xbee.begin(9600);
  xbee.println("Hello, world?");
  
  //relay  output
  pinMode(relay1, OUTPUT);
  pinMode(relay2, OUTPUT);
}

void loop() // run over and over
{
  while (xbee.available() > 0)
  {
      inChar = xbee.read();
      
      switch(inChar){
        case 'q':
          digitalWrite(relay1, HIGH);
          break;
        case 'w':
          digitalWrite(relay1, LOW);
          break;
        case 'e':
          digitalWrite(relay2, HIGH);
          break;
        case 'r':
          digitalWrite(relay2, LOW);
          break;
        case 'a':
          if(digitalRead(relay1) == HIGH)
            Serial.write('H');
          else
            Serial.write('L');
          break;
        case 's':
          if(digitalRead(relay2) == HIGH)
            Serial.write('H');
          else
            Serial.write('L');
          break;
        default:
          break;
      }
  }
}

