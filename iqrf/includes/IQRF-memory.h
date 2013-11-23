// *****************************************************************************
//                               IQRF - memory                                 *
// *****************************************************************************
// Intended for:
//    HW: TR-52B, TR-53B
//    OS: v3.00 or higher
//
// File:    IQRF-memory.h
// Version: v1.00                                   Revision: 17/12/2010
//
// Revision history:
//     v1.00: 17/12/2010  First release
//						
// *****************************************************************************
uns8  usedBank0[80]     @ 0x20;                     // do not use this space
uns8  usedBank1[80]     @ 0xA0;                     // do not use this space
uns8  usedBank2[96]     @ 0x110;                    // do not use this space
uns8  usedBank3[56]     @ 0x1B8;                    // do not use this space
uns8  usedCommon[8]     @ 0x78;                     // do not use this space
													
//******************************************************************************
//             dedicated buffers and file registers
//******************************************************************************
uns8  bufferINFO[35]    @ usedBank0;                // auxilliary buffer, 35B long
uns8  bufferRF[64]      @ usedBank2;                // buffer for RF routines, 64B long
uns8  bufferCOM[41]     @ usedBank1;                // buffer for communication routines, 41B long
uns8  bufferAUX[32]		@ usedBank3[0x1C0 - 0x1B8];	// auxilliary buffer, 32B long

uns8  X70[8]          	@ 0x70;                    	// register array in shared bank
uns8  userReg0        	@ X70;                     	// available for user's application
uns8  userReg1        	@ X70[1];                  	// available for user's application
uns8  param1          	@ X70[2];                  	// parameter_02 for function calls
uns8  param2          	@ X70[3];                  	// parameter_01 for function calls
uns16 param3         	@ X70[4];                  	// used as parameter for function calls
uns16 param4          	@ X70[6];                  	// used as parameter for function calls
		
uns8  toutRF          	@ usedBank0[0x4C-0x20];     // timeout for RFRXpacket() routine in ticks
uns8  lastRSSI 			@ usedBank0[0x6F-0x20];		// RSSI level after RFRXpacket()
uns8  SPIpacketLength 	@ usedBank1[0xDD-0xA0];		
uns8  userStatus 		@ usedBank3[0x1ED - 0x1B8];
uns8  memoryOffsetTo 	@ usedBank3[0x1EE - 0x1B8];
uns8  memoryOffsetFrom 	@ usedBank3[0x1EF - 0x1B8];

//******************************************************************************
//    after getStatusSPI() in param2 there are information as bellow
//******************************************************************************
bit  _SPIRX             @ param2.3;                 // something received on SPI
bit  _SPICRCok          @ param2.4;                 // received SPICRC (last one) was ok

//******************************************************************************
//    after device reset in userReg0 there are information as bellow
//******************************************************************************
bit  _BOR             	@ userReg0.0;               // Brown-out reset flag
bit  _POR             	@ userReg0.1;               // Power-on reset flag
bit  _PD             	@ userReg0.3;               // Power-down flag
bit  _TO          		@ userReg0.4;               // Watchdog time-out flag

//******************************************************************************
//             file registers dedicated to networking
//******************************************************************************
uns8  networkInfo[22]   @ usedBank2[0x153-0x110]; 	// address of networkInfo data
						
struct PINfield
{						
    bit                	AUXF;                       // extra 1B will follow
    bit                	TIMEF;                      // extra 1B will follow
    bit                	SYSPF;                      // system packet
    bit                	MPRWF;                      // extra 3B will follow
    bit                	CRYPTF;                     // extra 2B will follow
    bit                	ROUTEF;                     // extra 6B will follow
    bit                	ACKF;                       // acknowledment requested
    bit                	NTWF;                       // networking topology

} PINF @ networkInfo;

bit   _ACKF        		@ PINF.ACKF;                // acknowledgement requested
bit   _ROUTEF      		@ PINF.ROUTEF;              // routing requested
bit   _MPRWF       		@ PINF.MPRWF;               // module peripheral R/W requested
bit   _CRYPTF      		@ PINF.CRYPTF;              // crypting requested
bit   _TIMEF       		@ PINF.TIMEF;               // time info in packet requested
bit   _AUXF        		@ PINF.AUXF;                // reserved for future use
bit   _NTWF				@ PINF.NTWF;                // networking packet requested
bit   _NTWPACKET   		@ PINF.NTWF;                // networking packet requested

uns8  PIN            	@ networkInfo;              // packet info
uns8  DLEN           	@ networkInfo[1];           // data length in packet
uns8  RX             	@ networkInfo[3];           // addressee of packet
uns8  TX             	@ networkInfo[4];           // direct sender of packet
uns8  PID 				@ networkInfo[7];			// packet identification
uns8  RTOTX          	@ networkInfo[8];           // originated sender of packet
uns8  RTDEF         	@ networkInfo[9];           // routing definition
uns8  RTDT0        	  	@ networkInfo[10];          // routing data 0
uns8  RTDT1          	@ networkInfo[11];          // routing data 1
uns8  RTDT2          	@ networkInfo[12];          // routing data 2
uns8  RTDT3          	@ networkInfo[13];          // routing data 3
uns8  MPRW0          	@ networkInfo[14];          // Module Peripheral R/W B0
uns8  MPRW1          	@ networkInfo[15];          // Module Peripheral R/W B1
uns8  MPRW2          	@ networkInfo[16];          // Module Peripheral R/W B2

//******************************************************************************
//         EEPROM
//******************************************************************************
#define __EEAPPINFO        0x21A0                   // user's application data, 32B

//******************************************************************************
//             I/O definitions
//******************************************************************************
#ifdef TR52B
    #define _IO1        PORTA.0         			// IO1 (C1)
	#define _C1         PORTA.0         			// IO1 (C1)
    #define _IO2        PORTC.2         			// IO2 (C2)
	#define _C2         PORTC.2         			// IO2 (C2)
    #define _SS         PORTA.5         			// SPI SS (C5)
	#define _C5         PORTA.5         			// SPI SS (C5)
    #define _OUT1       PORTB.7         			// green LED, output OUT1
    #define _GLED       PORTB.7         			// green LED, output OUT1
    #define _LEDG       PORTB.7         			// green LED, output OUT1
    #define _OUT2       PORTA.2         			// red LED, output OUT2
    #define _RLED       PORTA.2         			// red LED, output OUT2
    #define _LEDR       PORTA.2         			// red LED, output OUT2
    #define _SCK        PORTC.3         			// SPI SCK (C6)
	#define _C6         PORTC.3         			// SPI SCK (C6)
    #define _SDI        PORTC.4         			// SPI SDI (C7)
	#define _C7         PORTC.4         			// SPI SDI (C7)
    #define _SDO        PORTC.5         			// SPI SDO (C8)
	#define _C8         PORTC.5         			// SPI SDO (C8)
#else
    #error IQRF-memory.h does not correspond to selected TR module type.
#endif

//******************************************************************************
#pragma rambank = 3            // user's registers  will be allocated in bank3
