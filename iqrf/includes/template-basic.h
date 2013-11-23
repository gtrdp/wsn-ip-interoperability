// *********************************************************************
// *                             Template - basic                      *
// *********************************************************************
// Application basic template include
//
// Intended for:
//    HW: TR-52B, TR-53B
//    OS: v3.00 or higher
//
// File:    template-basic.h
// Version: v1.00                                   Revision: 08/12/2010
//
// Revision history:
//     v1.00: 08/12/2010  First release
//
// *********************************************************************

#ifdef TR52B
    #message Compilation for TR-52B and TR-53B modules (PIC16F886)
    #pragma chip PIC16F886
#endif

void APPLICATION();

#pragma origin 0x100

#pragma update_RP 0

void main()                                     // skipped during Upload
{
    nop();
    nop();
    RP0 = 0;
    RP1 = 0;
    PA0 = 1;
    APPLICATION();
}

#pragma update_RP 1
#include "IQRF-memory.h"               			// memory definitions

#ifdef TR52B
    #include "IQRF-functions-52B.h"    			// functions definitions
    #pragma origin 0x1c00                       // app starts here
#else
	#error Template-basic.h does not correspond to selected TR module type.
#endif

#include "IQRF-macros.h"

// *********************************************************************

