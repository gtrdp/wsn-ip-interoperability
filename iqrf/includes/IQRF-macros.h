// *********************************************************************
//                               IQRF - macros                         *
// *********************************************************************
// Just for easier life (better mnemonic and compatibility with older
// versions only).
//
// Intended for:
//    OS: v3.00 or higher
//
// File:    IQRF-macros.h
// Version: v1.00                                   Revision: 08/12/2010
//
// Revision history:
//     v1.00: 08/12/2010  First release
//
// *********************************************************************

#define buttonPressed 	!_SS        // button on DK-EVAL-03(04) or CK-USB-02(04)

#define _DQI			0x80		// Digital Quality Indicator of RF signal switched on
									//   (see checkRF(x) in Ref. Guide) 

								// setRFspeed(baud rate)
#define _BR1200			1			// 1.2 kb/s
#define _BR19200		2			// 19.2 kb/s (default)
#define _BR57600		3			// 57.6 kb/s
#define _BR86200		4			// 86.2 kb/s

								// setRFband(band)
#define _RFB868			0			// 868 MHz (default)	
#define _RFB916			1			// 916 MHz

								// setRFmode(mode)
#define _RX_STD			0x00		// RX mode STD
#define _RX_LP			0x01		// RX mode LP
#define _RX_XLP			0x02		// RX mode XLP
#define _RX_RFIM		0x03		// RX mode RFIM
#define _FLT_20			0x04		// RX filter - corresponds to checkRF(20)
#define _FLT_35			0x08		// RX filter - corresponds to checkRF(35)
#define _FLT_50 		0x0C		// RX filter - corresponds to checkRF(50)
#define _TX_STD			0x00		// TX mode STD
#define _TX_LP			0x10		// TX mode LP
#define _TX_XLP			0x20		// TX mode XLP
#define _WPE			0x40		// Wait Packet End
#define _STAYRX			0x80		// Stay in RX

// *********************************************************************

