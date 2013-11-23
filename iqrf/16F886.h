// HEADER FILE
#if !defined ICD2_DEBUG
 #pragma chip PIC16F886, core 14, code 8192, ram 32 : 0x1FF
#else
 #pragma chip PIC16F886, core 14, code 0x1F00, ram 32 : 0x1FF
 // last 256 locations are reserved for debugging

 #error ICD2 reservations are not confirmed!

 //RESERVED RAM LOCATIONS
 char ICD2R1 @ 0x70;
 char reservedICD2[11] @ 0x1E5;  // reserved RAM for ICD2

 #pragma stackLevels 7   // reserve one level for debugging
#endif

#pragma ramdef 0x110 : 0x11F
#pragma ramdef 0x190 : 0x19F
#pragma ramdef  0x70 : 0x7F mapped_into_all_banks

#define INT_gen_style
#define INT_rambank  0   /* interrupt variables in bank 0 */

#pragma config_def 0x0222

#pragma wideConstData

#pragma config_reg2 0x2008

/* Predefined:
  char W;
  char INDF, TMR0, PCL, STATUS, FSR, PORTA, PORTB;
  char OPTION, TRISA, TRISB;
  char PCLATH, INTCON;
  bit PS0, PS1, PS2, PSA, T0SE, T0CS, INTEDG, RBPU_;
  bit Carry, DC, Zero_, PD, TO, RP0, RP1, IRP;
  bit RBIF, INTF, T0IF, RBIE, INTE, T0IE, GIE;
  bit PA0, PA1;  // PCLATH
*/

#pragma char PORTC   @ 0x07

#pragma char PORTE   @ 0x09

#pragma char PIR1    @ 0x0C
#pragma char PIR2    @ 0x0D
#pragma char TMR1L   @ 0x0E
#pragma char TMR1H   @ 0x0F
#pragma char T1CON   @ 0x10
#pragma char TMR2    @ 0x11
#pragma char T2CON   @ 0x12
#pragma char SSPBUF  @ 0x13
#pragma char SSPCON  @ 0x14
#pragma char CCPR1L  @ 0x15
#pragma char CCPR1H  @ 0x16
#pragma char CCP1CON @ 0x17
#pragma char RCSTA   @ 0x18
#pragma char TXREG   @ 0x19
#pragma char RCREG   @ 0x1A
#pragma char CCPR2L  @ 0x1B
#pragma char CCPR2H  @ 0x1C
#pragma char CCP2CON @ 0x1D
#pragma char ADRESH  @ 0x1E
#pragma char ADCON0  @ 0x1F

#pragma char TRISC   @ 0x87

#pragma char TRISE   @ 0x89

#pragma char PIE1    @ 0x8C
#pragma char PIE2    @ 0x8D
#pragma char PCON    @ 0x8E
#pragma char OSCCON  @ 0x8F
#pragma char OSCTUNE @ 0x90
#pragma char SSPCON2 @ 0x91
#pragma char PR2     @ 0x92
#pragma char SSPADD  @ 0x93
#pragma char SSPSTAT @ 0x94
#pragma char WPUB    @ 0x95
#pragma char IOCB    @ 0x96
#pragma char VRCON   @ 0x97
#pragma char TXSTA   @ 0x98
#pragma char SPBRG   @ 0x99
#pragma char SPBRGH  @ 0x9A
#pragma char PWM1CON @ 0x9B
#pragma char ECCPAS  @ 0x9C
#pragma char PSTRCON @ 0x9D
#pragma char ADRESL  @ 0x9E
#pragma char ADCON1  @ 0x9F

#pragma char WDTCON  @ 0x105

#pragma char CM1CON0 @ 0x107
#pragma char CM2CON0 @ 0x108
#pragma char CM2CON1 @ 0x109

#pragma char EEDATA  @ 0x10C
#pragma char EEDAT   @ 0x10C
#pragma char EEADR   @ 0x10D
#pragma char EEDATH  @ 0x10E
#pragma char EEADRH  @ 0x10F

#pragma char SRCON   @ 0x185

#pragma char BAUDCTL @ 0x187
#pragma char ANSEL   @ 0x188
#pragma char ANSELH  @ 0x189

#pragma char EECON1  @ 0x18C
#pragma char EECON2  @ 0x18D

#pragma bit  PEIE    @ INTCON.6

#pragma bit  TMR1IF  @ PIR1.0
#pragma bit  TMR2IF  @ PIR1.1
#pragma bit  CCP1IF  @ PIR1.2
#pragma bit  SSPIF   @ PIR1.3
#pragma bit  TXIF    @ PIR1.4
#pragma bit  RCIF    @ PIR1.5
#pragma bit  ADIF    @ PIR1.6

#pragma bit  CCP2IF  @ PIR2.0
#pragma bit  ULPWUIF @ PIR2.2
#pragma bit  BCLIF   @ PIR2.3
#pragma bit  EEIF    @ PIR2.4
#pragma bit  C1IF    @ PIR2.5
#pragma bit  C2IF    @ PIR2.6
#pragma bit  OSFIF   @ PIR2.7

#pragma bit  TMR1ON  @ T1CON.0
#pragma bit  TMR1CS  @ T1CON.1
#pragma bit  T1SYNC_ @ T1CON.2
#pragma bit  T1OSCEN @ T1CON.3
#pragma bit  T1CKPS0 @ T1CON.4
#pragma bit  T1CKPS1 @ T1CON.5
#pragma bit  TMR1GE  @ T1CON.6
#pragma bit  T1GINV  @ T1CON.7

#pragma bit  TMR2ON  @ T2CON.2

#pragma bit  SSPM0   @ SSPCON.0
#pragma bit  SSPM1   @ SSPCON.1
#pragma bit  SSPM2   @ SSPCON.2
#pragma bit  SSPM3   @ SSPCON.3
#pragma bit  CKP     @ SSPCON.4
#pragma bit  SSPEN   @ SSPCON.5
#pragma bit  SSPOV   @ SSPCON.6
#pragma bit  WCOL    @ SSPCON.7

#pragma bit  CCP1M0  @ CCP1CON.0
#pragma bit  CCP1M1  @ CCP1CON.1
#pragma bit  CCP1M2  @ CCP1CON.2
#pragma bit  CCP1M3  @ CCP1CON.3
#pragma bit  DC1B0   @ CCP1CON.4
#pragma bit  DC1B1   @ CCP1CON.5
#pragma bit  P1M0    @ CCP1CON.6
#pragma bit  P1M1    @ CCP1CON.7

#pragma bit  RX9D    @ RCSTA.0
#pragma bit  OERR    @ RCSTA.1
#pragma bit  FERR    @ RCSTA.2
#pragma bit  ADDEN   @ RCSTA.3
#pragma bit  CREN    @ RCSTA.4
#pragma bit  SREN    @ RCSTA.5
#pragma bit  RX9     @ RCSTA.6
#pragma bit  SPEN    @ RCSTA.7

#pragma bit  CCP2M0  @ CCP2CON.0
#pragma bit  CCP2M1  @ CCP2CON.1
#pragma bit  CCP2M2  @ CCP2CON.2
#pragma bit  CCP2M3  @ CCP2CON.3
#pragma bit  DC2B0   @ CCP2CON.4
#pragma bit  DC2B1   @ CCP2CON.5

#pragma bit  ADON    @ ADCON0.0
#pragma bit  GO      @ ADCON0.1
#pragma bit  CHS0    @ ADCON0.2
#pragma bit  CHS1    @ ADCON0.3
#pragma bit  CHS2    @ ADCON0.4
#pragma bit  CHS3    @ ADCON0.5
#pragma bit  ADCS0   @ ADCON0.6
#pragma bit  ADCS1   @ ADCON0.7

#pragma bit  TMR1IE  @ PIE1.0
#pragma bit  TMR2IE  @ PIE1.1
#pragma bit  CCP1IE  @ PIE1.2
#pragma bit  SSPIE   @ PIE1.3
#pragma bit  TXIE    @ PIE1.4
#pragma bit  RCIE    @ PIE1.5
#pragma bit  ADIE    @ PIE1.6

#pragma bit  CCP2IE  @ PIE2.0
#pragma bit  ULPWUIE @ PIE2.2
#pragma bit  BCLIE   @ PIE2.3
#pragma bit  EEIE    @ PIE2.4
#pragma bit  C1IE    @ PIE2.5
#pragma bit  C2IE    @ PIE2.6
#pragma bit  OSFIE   @ PIE2.7

#pragma bit  BOR_    @ PCON.0
#pragma bit  POR_    @ PCON.1
#pragma bit  SBOREN  @ PCON.4
#pragma bit  ULPWUE  @ PCON.5

#pragma bit  SCS     @ OSCCON.0
#pragma bit  LTS     @ OSCCON.1
#pragma bit  HTS     @ OSCCON.2
#pragma bit  OSTS    @ OSCCON.3

#pragma bit  SEN     @ SSPCON2.0
#pragma bit  RSEN    @ SSPCON2.1
#pragma bit  PEN     @ SSPCON2.2
#pragma bit  RCEN    @ SSPCON2.3
#pragma bit  ACKEN   @ SSPCON2.4
#pragma bit  ACKDT   @ SSPCON2.5
#pragma bit  ACKSTAT @ SSPCON2.6
#pragma bit  GCEN    @ SSPCON2.7

#pragma bit  BF      @ SSPSTAT.0
#pragma bit  UA      @ SSPSTAT.1
#pragma bit  RW_     @ SSPSTAT.2
#pragma bit  S       @ SSPSTAT.3
#pragma bit  P       @ SSPSTAT.4
#pragma bit  DA_     @ SSPSTAT.5
#pragma bit  CKE     @ SSPSTAT.6
#pragma bit  SMP     @ SSPSTAT.7

#pragma bit  VR0     @ VRCON.0
#pragma bit  VR1     @ VRCON.1
#pragma bit  VR2     @ VRCON.2
#pragma bit  VR3     @ VRCON.3
#pragma bit  VRSS    @ VRCON.4
#pragma bit  VRR     @ VRCON.5
#pragma bit  VROE    @ VRCON.6
#pragma bit  VREN    @ VRCON.7

#pragma bit  TX9D    @ TXSTA.0
#pragma bit  TRMT    @ TXSTA.1
#pragma bit  BRGH    @ TXSTA.2
#pragma bit  SENDB   @ TXSTA.3
#pragma bit  SYNC    @ TXSTA.4
#pragma bit  TXEN    @ TXSTA.5
#pragma bit  TX9     @ TXSTA.6
#pragma bit  CSRC    @ TXSTA.7

#pragma bit  PRSEN   @ PWM1CON.7

#pragma bit  PSSBD0  @ ECCPAS.0
#pragma bit  PSSBD1  @ ECCPAS.1
#pragma bit  PSSAC0  @ ECCPAS.2
#pragma bit  PSSAC1  @ ECCPAS.3
#pragma bit  ECCPASE @ ECCPAS.7

#pragma bit  STRA    @ PSTRCON.0
#pragma bit  STRB    @ PSTRCON.1
#pragma bit  STRC    @ PSTRCON.2
#pragma bit  STRD    @ PSTRCON.3
#pragma bit  STRSYNC @ PSTRCON.4

#pragma bit  VCFG0   @ ADCON1.4
#pragma bit  VCFG1   @ ADCON1.5
#pragma bit  ADFM    @ ADCON1.7

#pragma bit  SWDTEN  @ WDTCON.0

#pragma bit  C1CH0   @ CM1CON0.0
#pragma bit  C1CH1   @ CM1CON0.1
#pragma bit  C1R     @ CM1CON0.2
#pragma bit  C1POL   @ CM1CON0.4
#pragma bit  C1OE    @ CM1CON0.5
#pragma bit  C1OUT   @ CM1CON0.6
#pragma bit  C1ON    @ CM1CON0.7

#pragma bit  C2CH0   @ CM2CON0.0
#pragma bit  C2CH1   @ CM2CON0.1
#pragma bit  C2R     @ CM2CON0.2
#pragma bit  C2POL   @ CM2CON0.4
#pragma bit  C2OE    @ CM2CON0.5
#pragma bit  C2OUT   @ CM2CON0.6
#pragma bit  C2ON    @ CM2CON0.7

#pragma bit  C2SYNC  @ CM2CON1.0
#pragma bit  T1GSS   @ CM2CON1.1
#pragma bit  C2RSEL  @ CM2CON1.4
#pragma bit  C1RSEL  @ CM2CON1.5
#pragma bit  MC2OUT  @ CM2CON1.6
#pragma bit  MC1OUT  @ CM2CON1.7

#pragma bit  FVREN   @ SRCON.0
#pragma bit  PULSR   @ SRCON.2
#pragma bit  PULSS   @ SRCON.3
#pragma bit  C2REN   @ SRCON.4
#pragma bit  C1SEN   @ SRCON.5
#pragma bit  SR0     @ SRCON.6
#pragma bit  SR1     @ SRCON.7

#pragma bit  ABDEN   @ BAUDCTL.0
#pragma bit  WUE     @ BAUDCTL.1
#pragma bit  BRG16   @ BAUDCTL.3
#pragma bit  SCKP    @ BAUDCTL.4
#pragma bit  RCIDL   @ BAUDCTL.6
#pragma bit  ABDOVF  @ BAUDCTL.7

#pragma bit  RD      @ EECON1.0
#pragma bit  WR      @ EECON1.1
#pragma bit  WREN    @ EECON1.2
#pragma bit  WRERR   @ EECON1.3
#pragma bit  EEPGD   @ EECON1.7


