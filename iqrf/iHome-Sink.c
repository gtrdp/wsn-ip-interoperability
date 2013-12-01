// *********************************************************************
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
//
// *********************************************************************
#include "includes/template-basic.h"    // system header files inclusion

// *********************************************************************
                                        // set baudrate
#define BD_4800                         // BD_19200, BD_9600, BD_4800
// *********************************************************************

void configure_IO(void);
void openUART(void);
void SendByteUART(uns8 tx_data);
void SendDataUART(uns8 data_len);
uns8 RxDataUART(void);
void UART_ErrorsRecovery(void);
void GetTemperature(void);
void BondTheNode(void);
int UnbondTheNode(void);
void TurnPort(void);
void SendPacket(void);
void GetInfo(void);
// *********************************************************************

uns8 UART_dlen, myTIMESLOT;
uns16 temperature;
bit non_NTW;

// *********************************************************************

void APPLICATION(void)
{
    openUART();                         // UART initialization
    toutRF = 5;
	
    while (1)                           // main loop
    {
        clrwdt();
		
        if (checkRF(0))
        {
            if (RFRXpacket())
            {
                pulseLEDG();
                copyMemoryBlock(bufferRF, bufferCOM, DLEN);
                SendDataUART(DLEN);     // send DLEN bytes from bufferCOM via UART
				
				bufferCOM[0] = 13;
				SendDataUART(1);
            }
        }
			
        UART_dlen = RxDataUART();       // returns number of received data stored in bufferCOM

        if (UART_dlen)                  // if anything received via UART
        {
            pulseLEDR();
			switch (bufferCOM[0])
			{
				case 'b':
					BondTheNode();
					break;
					
				case 'u':
					UnbondTheNode();
					break;
				
				case 'p':
					TurnPort();
					break;
					
				case 'g':
					GetTemperature();					
					break;
					
				case 'i':
					GetInfo();
					break;
					
			}					
        }
    }
}
//**********************************************************************

void configure_IO(void)
{
    TRISC.5 = 1;                        // pin connected with RX
    TRISC.7 = 1;                        // RX input
    TRISC.6 = 0;                        // TX output
    BAUDCTL = 0;                        // baudrate control setup
}
//----------------------------------------------------------------------

void openUART(void)                     // baudrate, 8N1
{
    configure_IO();
                                        // baudrate @ 8MHz, high speed
#ifdef BD_19200
    SPBRG = 25;
#endif

#ifdef BD_9600
    SPBRG = 51;
#endif

#ifdef BD_4800
    SPBRG = 103;
#endif

    TXSTA = 0b00100100;                 // async UART, high speed, 8 bit, TX enabled
    RCSTA = 0b10010000;                 // Continuous receive, enable port, 8 bit
}
//----------------------------------------------------------------------

void SendByteUART(uns8 tx_data)         // send a byte via UART
{
    IRP = 0;
    while ((readFromRAM(0x0C) & 0x10) == 0); // wait until bit PIR1.TXIF is cleared
    TXREG = tx_data;
}
//----------------------------------------------------------------------

void SendDataUART(uns8 data_len)        // send data_len bytes from bufferCOM via UART
{
uns8 i;

    if (data_len > 41)                  // max. 41B from bufferCOM
        data_len = 41;

    IRP = 0;

    for (i = 0; i < data_len; i++)
        SendByteUART(readFromRAM(bufferCOM + i));
}
//----------------------------------------------------------------------

#define checkRxUART ((readFromRAM(0x0C) & 0x20) == 0x20)    // PIR1.RXIF test

uns8 RxDataUART(void)                   // returns number of received data stored in bufferCOM
{
	uns8 i = 0;

    UART_ErrorsRecovery();
    IRP = 0;

    if (checkRxUART)                    // if anything received via UART
    {
		pulseLEDG();
		
        writeToRAM(bufferCOM, RCREG);
        i++;
        startDelay(2);                  // wait for next byte

        while (isDelay())
        {
            IRP = 0;

            if (checkRxUART)            // if anything received via UART
            {
                writeToRAM(bufferCOM + i, RCREG);
                i++;
                startDelay(2);          // wait for next byte

                if (i >= 41)            // max. 41B to bufferCOM
                    break;
            }
        }
		
		
    }
    
    return i;
}
//----------------------------------------------------------------------

void UART_ErrorsRecovery(void)          // OERR and FERR bits recovery - see PIC datasheet
{
    if (OERR)                           // UART overrun recovery
    {
        CREN = 0;
        CREN = 1;
    }

    if (FERR)                           // UART framing error recovery
        FERR = 0;
}

// ************************************************
// Bond the specified node
// ************************************************
void BondTheNode(void)
{
	uns8 i;
	
	if (bondNewNode(bufferCOM[1]))
	{
		bufferCOM[0] = 'O';         // Bonding ok - address is in param2
		bufferCOM[1] = 'K';
		bufferCOM[2] = ':';
		bufferCOM[3] = '#';
		bufferCOM[4] = param2; 		// Node address
		bufferCOM[5] = ' ';
		bufferCOM[6] = '$';
		bufferCOM[7] = bufferRF[1]; // Node ID [1]
		bufferCOM[8] = '$';
		bufferCOM[9] = bufferRF[0]; // Node ID [0]
		i = 10;
	}
	else
	{
		bufferCOM[0] = 'E';         // Bond error
		bufferCOM[1] = 'R';
		bufferCOM[2] = 'R';
		bufferCOM[3] = 'O';
		bufferCOM[4] = 'R';
		i = 5;
	}
	
	SendDataUART(i);
}

// ************************************************
// Unbond the specified node
// ************************************************
int UnbondTheNode(void)
{
	
//	if (UART_dlen < 2)
//		return 0;
		
	if (bufferCOM[1] < 0xF0)		// Max. Node address is 239
		removeBondedNode(bufferCOM[1]);
	
	non_NTW = 0;
	SendPacket();
	
	return 0;
}

// ************************************************
// Send the packet when it is ready
// ************************************************
void SendPacket(void)
{
	bufferRF[0] = 0xEE;             // Just for packet identification in this example
	bufferRF[1] = bufferCOM[0];     // Command
	
	bufferRF[2] = bufferCOM[2];
	bufferRF[3] = bufferCOM[3];
	
	PIN = 0;                        // Preclearing
	

	if (non_NTW)
		setNonetMode();				// Send as non-networking packet to all
	else
		{								// Send as networking packet
			setCoordinatorMode();
			RX = bufferCOM[1];			// Node address
			_ROUTEF = 1;				// Packet will be routed
			RTDEF = 1;					// Routing algorithm: SFM
			RTDT0 = eeReadByte(0x00);   // Number of hops = number of bonded Nodes
			RTDT1 = myTIMESLOT;			// Timeslot setting
		}

	DLEN = 4;
	PID++;							// Every packed has different identification
	RFTXpacket();
}

// ************************************************
// Turn the port ON or OFF on the specified address
// ************************************************
void TurnPort(void)
{
	non_NTW = 0;	
	SendPacket();
}

// ************************************************
// Get temperature from sink node
// ************************************************
void GetTemperature(void)
{
	// Get temperature from other node!
	non_NTW = 0;	
	SendPacket();

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

	bufferCOM[0] = temperature.low8/10;
    bufferCOM[0] += '0';
    bufferCOM[1] = temperature.low8%10;
    bufferCOM[1] += '0';                  	// Display in ttC format
    bufferCOM[2] = 'C';
	 SendDataUART(3);

}

void GetInfo(void)
{
	non_NTW = 0;	
	SendPacket();	
}
// *********************************************************************

