//   ***********************************************
//      IQRF - definitions file for OS ver. 3.00
//        generated: Sat Oct 30 20:40:44 2010    
//   ***********************************************
//      compiled for: modules TR-5xB (PIC16F886)    
//   ***********************************************
 
#pragma optimize 0
#pragma update_PAGE 0
#pragma update_RP 0

#pragma origin 0x1800
void dummyP3()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1802
void reset()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1804
void iqrfSleep()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1806
void debug()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1808
void moduleInfo()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x180a
void appInfo()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x180c
void pulsingLEDR()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x180e
void pulseLEDR()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1810
void stopLEDR()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1812
void pulsingLEDG()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1814
void pulseLEDG()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1816
void stopLEDG()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1818
void setOnPulsingLED(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x181a
void setOffPulsingLED(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x181c
uns8 eeReadByte(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x181e
void eeReadData(uns8 adr@param2, char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1820
void eeWriteByte(uns8 adr@param2, char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1822
void eeWriteData(uns8 adr@param2, char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1824
uns8 readFromRAM(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1826
void writeToRAM(uns8 adr@FSR, char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1828
void clearBufferINFO()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x182a
void swapBufferINFO()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x182c
bit compareBufferINFO2RF(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x182f
void copyBufferINFO2COM()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1831
void copyBufferINFO2RF()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1833
void copyBufferRF2COM()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1835
void copyBufferRF2INFO()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1837
void copyBufferCOM2RF()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1839
void copyBufferCOM2INFO()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x183b
void copyMemoryBlock(uns16 from@param3, uns16 to@param4, char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x183d
void startDelay(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x183f
void startLongDelay(uns16 delay@param3)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1841
bit isDelay()
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1844
void waitDelay(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1846
void waitMS(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1848
void startCapture()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x184a
void captureTicks()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x184c
void calibrateTimer()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x184e
void waitNewTick()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1850
void enableSPI()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1852
void disableSPI()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1854
void startSPI(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1856
void stopSPI()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1858
void restartSPI()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x185a
bit getStatusSPI()
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x185d
void setTXpower(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x185f
void setRFband(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1861
void setRFchannel(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1863
void setRFmode(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1865
void setRFspeed(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1867
void setRFsleep()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1869
void setRFready()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x186b
void RFTXpacket()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x186d
bit RFRXpacket()
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1870
bit checkRF(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1873
bit bondRequest()
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1876
bit amIBonded()
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1879
void removeBond()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x187b
bit bondNewNode(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x187e
bit isBondedNode(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1881
void removeBondedNode(char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1883
bit rebondNode(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1886
void clearAllBonds()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1888
void setNonetMode()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x188a
void setCoordinatorMode()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x188c
void setNodeMode()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x188e
void setNetworkFilteringOn()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1890
void setNetworkFilteringOff()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1892
uns8 getNetworkParams()
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x1894
void setRoutingOn()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1896
void setRoutingOff()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x1898
void setUserAddress(uns16 myAddress@param3)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x189a
void answerSystemPacket()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x189c
uns8 discovery(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x189e
bit wasRouted()
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x18a1
void optimizeHops( unsigned char W)
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x18a3
uns8 getSupplyVoltage()
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}

#pragma origin 0x18a5
void getTemperature()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x18a7
void clearBufferRF()
{
  #asm
    DW 0x2000
  #endasm
}

#pragma origin 0x18a9
bit isDiscoveredNode(char W)
{
  #asm
    DW 0x2000
  #endasm
  return 1;
}



#pragma optimize 1
#pragma update_RP 1
#pragma update_PAGE 1
#pragma origin 0x1C00
