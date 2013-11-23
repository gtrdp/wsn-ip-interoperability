// *********************************************************************
// *                           RFPGMTR-LITE                            *
// *              IQRF wireless upload plug-in header file             *
// *********************************************************************
// Intended for:
//    HW: TR-52B, TR-53B
//    OS: v3.00 or higher
//
// File:    RFPGMTR-LITE.h
// Version: v1.00                                   Revision: 08/12/2010
//
// Revision history:
//     v1.00: 08/12/2010  First release
//
// *********************************************************************

#define enableRFPGM()\
  #asm\
    DW 0x118A\
    DW 0x160A\
    DW 0x2600\
    DW 0x158A\
 #endasm\

#define disableRFPGM()\
  #asm\
    DW 0x118A\
    DW 0x160A\
    DW 0x2620\
    DW 0x158A\
 #endasm\
  
#define setupRFPGM(a)\
  W = a;\
  #asm\
    DW 0x118A\
    DW 0x160A\
    DW 0x2640\
    DW 0x158A\
  #endasm\

#define runRFPGM()\
  #asm\
    DW 0x118A\
    DW 0x160A\
    DW 0x2650\
    DW 0x158A\
  #endasm\
