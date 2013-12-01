/***********************************************************************
//                             iHome - Sink
// *********************************************************************
//
// Intended for:
//      HW: - TR-52B or TR-53B
//          - DS-UART (DK-PGM-01 with CAB-SER-02)
//      v3.00 or higher
//
// Author:
//		Sigit B. Wibowo
// Forked by:
// 		Guntur DP (@gunturdputra)
//
// Description:
//      This is for node attached to the Gateway a.k.a. Sink
//
// File:    iHome-Sink.c
// Version: v1.10                                   Revision: 23/09/2012
//
// Revision history:
//      v1.00: 23/09/2012  First release.
//      v1.10: 27/11/2013  Forked.
/*
	Available Commands:
	'b' Bond the specified node.
	'u' Unbond the specified node.
	'g' Get temperature from specified node.
	'p' Turn ON/OFF port
*/
#include "../includes/template-basic.h"
//#include "../includes/RFPGMTR-LITE.h"

// *********************************************************************
#define	RX_FILTER				15		// E.g. 50 - for testing on a table, 5-15 - for testing in a field

#define OUT1_TRIS 		TRISC.5			// C8/SDO pin connected to the OUT1
#define OUT1 			PORTC.5

#define OUT2_TRIS 		TRISC.4			// C7/SDI pin connected to the OUT2
#define OUT2 			PORTC.4

#define OUT3_TRIS 		TRISC.3			// C6/SCK pin connected to the OUT3
#define OUT3 			PORTC.3

#define OUT4_TRIS 		TRISA.5			// C5/SS pin connected to the OUT4
#define OUT4 			PORTA.5

#define OUT5_TRIS 		TRISA.0			// C1/IO1 pin connected to the OUT5
#define OUT5 			PORTA.0

#define OUT6_TRIS 		TRISC.2			// C2/IO2 pin connected to the OUT6
#define OUT6 			PORTC.2

// *********************************************************************
void mySleep(void);
void GetTemperature(void);
void Unbond(void);
uns16 temperature;

// *********************************************************************

void APPLICATION()
{
	OUT1_TRIS = 0;						// pins as outputs
	OUT2_TRIS = 0;
	OUT3_TRIS = 0;
	OUT4_TRIS = 0;
	OUT5_TRIS = 0;
	OUT6_TRIS = 0;
	
	uns8 i, sleepTimeout;

    setOffPulsingLED(10);
    setNodeMode();

    while (!amIBonded())        		// If not bonded to some network
    {
        sleepTimeout = 0;

        while (!buttonPressed)          // The button must be pressed before bonding
        {
            clrwdt();

            if (sleepTimeout>40)       // Go to sleep if button not pressed until 10s
            {
                mySleep();
                break;                  // Go directly to bonding after wakeup
            }

            sleepTimeout++;
            pulseLEDR();     			// Wait for button press indication
            waitDelay(25);
        }

        stopLEDR();
        _LEDR = 1;                      // Bonding indication

        bondRequest();

        _LEDR = 0;
        waitDelay(50);
        clrwdt();
    }

	setNodeMode();						// See side effects of bondRequest()
    i = 0;

    while (1)
    {
mainLoop:
        clrwdt();
		SWDTEN = 1;						// WDT was switched off before RFRXpacket()

        if (i > 10)
			pulseLEDG();                // Button can be released to go to the sleep

        if (i > 100)                   	// Press button for more then 3s to unbond and reset
        {
            setNodeMode();
            removeBond();
            reset();
        }

        if (buttonPressed)
        {
            pulseLEDR();              	// Button press indication
            i++;                     	// Counts time of press
            waitDelay(3);
            continue;
        }
        else
        {
            if (i > 10)                	// Press button for more then 300ms to sleep
                mySleep();
        }

        i = 0;                       	// Counter clear

        // ************************************* Receiving part *********************************
 		lastRSSI = 0;

        if (checkRF(RX_FILTER))
        {
            setNodeMode();
			toutRF = 5;							// [ticks] must be > RF packet length
												//   Packet from Coordinator has DLEN = 4
												// toutRF must be set periodicaly due answerSystemPacket funcion
												//   See OS ref. guide

			SWDTEN = 0;							// The routing on the background during RFRXpacket()
												//   Could cause WDT overflow if the timeslot is set too long
            if (RFRXpacket())
            {
                if (wasRouted())   				// Routing indication for broadcast message
                    pulseLEDG();

				if (_ROUTEF)					// Has the packet been routed?
                {								// Yes - wait for finish of routing
					while (RTDT0)				// RTDT0 - rest of hops
					{
					//	clrwdt();
						waitDelay(RTDT1);		// RTDT1 - timeslot
						RTDT0--;
					}
                }

                if (bufferRF[0] == 0xEE)        // Is it a packet from this example?
                {
                    bufferRF[0] = 0x00;         // Yes - clear it

                    switch (bufferRF[1])		// Command
                    {
						//......................................................................
                        case 'p':                               // Answer is not required							
							switch (bufferRF[3])
							{
								case 0:
									switch(bufferRF[2])
									{
										case 10:
											_LEDG = 0;
											break;
										case 11:
											_LEDR = 0;
											break;
										case 1:
											OUT1 = 0;
											break;
										case 2:
											OUT2 = 0;
											break;
										case 3:
											OUT3 = 0;
											break;
										case 4:
											OUT4 = 0;
											break;
										case 5:
											OUT5 = 0;
											break;
										case 6:
											OUT6 = 0;
											break;
									}											
									break;
								case 1:
									switch(bufferRF[2])
									{
										case 10:
											_LEDG = 1;
											break;
										case 11:
											_LEDR = 1;
											break;
										case 1:
											OUT1 = 1;
											break;
										case 2:
											OUT2 = 1;
											break;
										case 3:
											OUT3 = 1;
											break;
										case 4:
											OUT4 = 1;
											break;
										case 5:
											OUT5 = 1;
											break;
										case 6:
											OUT6 = 1;
											break;
									}											
									break;
							}							
							break;
						
						case '?':                               // Answer is required

                            switch (bufferRF[2])				// Command for LED
							{
								case 0:
									_LEDR = 0;
									break;

								case 1:
									_LEDR = 1;
									break;

								case 2:
									pulseLEDR();
									break;
							}

							if (bufferRF[1] == '?')
                            {
                                if (RX != 0xFF)                 // To do not answer broadcast packets
                                {
                                    waitDelay(5);				// Recommended delay between RX and TX
									moduleInfo();
 									bufferRF[0] = 'I';
									bufferRF[1] = 'D';
									bufferRF[2] = ':';
									bufferRF[3] = '$';
									bufferRF[4] = bufferINFO[2];// Module ID
									bufferRF[5] = '$';
									bufferRF[6] = bufferINFO[1];
									bufferRF[7] = '$';
									bufferRF[8] = bufferINFO[0];
									bufferRF[9] = ' ';
									bufferRF[10] = 'R';
									bufferRF[11] = 'S';
									bufferRF[12] = 'S';
									bufferRF[13] = 'I';
									bufferRF[14] = ':';
									bufferRF[15] = '#';
									bufferRF[16] = lastRSSI;
                                    DLEN = 17;

									RTDEF = 1;                  // Routing algorithm: SFM
									getNetworkParams();         // Returns Node address in param2
									RTDT0 = param2;         	// SFM: number of hops for answer = my bonded address
																// RTDT1 (timeslot) remains from received packet
									RX = 0;						// To the Coordinator
 									RFTXpacket();
                                }
                            }

                            break;

						//......................................................................
                        case 't':					// Range test
							_LEDR = 1;
							_LEDG = 1;

							if (getSupplyVoltage() < 7)
								waitDelay(100);		// Long flash - Accu error
							else
								waitDelay(5);		// Short flash - Accu ok

							_LEDR = 0;
							_LEDG = 0;
                            break;

						//......................................................................
                        case 'r':             		// reset
							pulseLEDR();
							waitDelay(5);
                            reset();

						//......................................................................
                        case 'u':         			// Unbonding
							Unbond();

						//......................................................................
                        case 's':           		// Go to sleep
							_LEDG = 1;				// Longer indication before sleep
							SWDTEN = 0;
							startLongDelay(400);
							while (isDelay());
                            mySleep();
                            break;

						//......................................................................
						case 'g':
							GetTemperature();
						
						//......................................................................	
                        default:
                            break;
                    }
                }
            }
            else
            {
                if (wasRouted())        			// Routing indication
                    pulseLEDG();
			}

        }
    }
}
// *********************************************************************

void mySleep(void)
{
	_LEDG = 1;							// Indication before sleep
    waitDelay(100);
    stopLEDG();
    stopLEDR();
										// Recomended sequence see. example E01-TX
    GIE = 0;
    RBIE = 1;
    SWDTEN = 0;
    iqrfSleep();

    RBIF = 0;
    clrwdt();
    SWDTEN = 1;
}

void GetTemperature(void)
{
	getTemperature();                     	// Temperature measurement
	temperature.high8 = ADRESH & 0x03;  	// 10b result is stored
	temperature.low8  = ADRESL;       		//   in ADRESH and ADRESL

               // Vout = Tc * Ta + Vo       Tc = 10 mV/°C   Vo = 500mV
                //                              see MCP9700 datasheet

                // Vout = Vref * ADRES/1024   Vref = 3V
                //                              see PIC datasheet

				// Ta = 75/256 * ADRES - 50   [°C]
	temperature *= 75;
	temperature >>= 8;
	temperature -= 50;

	bufferRF[0] = temperature.low8/10;
    bufferRF[0] += '0';
    bufferRF[1] = temperature.low8%10;
    bufferRF[1] += '0';                  	// Display in ttC format
    bufferRF[2] = 'C';
	
    DLEN = 3;
	RTDEF = 1;                  // Routing algorithm: SFM
	getNetworkParams();         // Returns Node address in param2
	RTDT0 = param2;         	// SFM: number of hops for answer = my bonded address
																// RTDT1 (timeslot) remains from received packet
	RX = 0;						// To the Coordinator
 	RFTXpacket();
}

void Unbond(void)
{
    pulseLEDR();
    setNodeMode();
    removeBond();
    reset();
}
// *********************************************************************