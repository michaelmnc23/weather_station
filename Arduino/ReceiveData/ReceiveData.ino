#include <Printers.h>
#include <XBee.h>
#include <SoftwareSerial.h>

SoftwareSerial ESPserial(2, 3); // RX | TX
//String AP = "Bukit Sari 3-(Lorong Tengah)";       // AP NAME
String AP = "Bukit Sari Lantai 3"; 
//String PASS = "12345678"; // AP PASSWORD
String PASS = "khususanaklt3";
//String HOST = "192.168.0.101";
String HOST = "192.168.100.68";
String PORT = "80";
String field1 = "node";
String field2 = "temperature";
String field3 = "humidity";
String field4 = "pressure";
String field5 = "rain";
int temp = 1;
int temp2 = 1;
int hum = 1;
int hum2 = 1;
int pressure = 1;
int pressure2 = 1;
int pressure3 = 1;
int pressure4 = 1;
int rain = 1;
int rain2 = 1;
int rain3 = 1;
int rain4 = 1;
int nodeRec = 1;
char conTemp[4];
char conHum[4];
char conPress[8];
char conRain[8];
char node[2];

XBee xbee = XBee();
XBeeResponse response = XBeeResponse();
// create reusable response objects for responses we expect to handle 
ZBRxResponse rx = ZBRxResponse();
ModemStatusResponse msr = ModemStatusResponse();

void setup() {
  
  // start serial
  Serial.begin(9600);
  ESPserial.begin(9600);  
  xbee.begin(Serial);

//esp conf
  sendCommand("AT","OK");
  sendCommand("AT+GMR", "OK");  
  sendCommand("AT+CWMODE=1","OK");
  sendCommand("AT+CWJAP=\""+ AP +"\",\""+ PASS +"\"","OK");
}

// continuously reads packets, looking for ZB Receive or Modem Status
void loop() {
    
    xbee.readPacket();
    
    if (xbee.getResponse().isAvailable()) {
      // got something
    
      // now fill our zb rx class
      xbee.getResponse().getZBRxResponse(rx);
          
      if (rx.getOption() == ZB_PACKET_ACKNOWLEDGED) {
          // the sender got an ACK
//            flashLed(statusLed, 10, 10);
          Serial.println("receive ACK");
      } else {
          // we got it (obviously) but sender didn't get an ACK
//            flashLed(errorLed, 2, 20);
          Serial.println("not receive ACK");
      }
      // set dataLed PWM to value of the first byte in the data
        temp = (int)rx.getData()[0];
        temp2 = (int)rx.getData()[1];
        hum = (int)rx.getData()[2];
        hum2 = (int)rx.getData()[3];
        pressure = (int)rx.getData()[4];
        pressure2 = (int)rx.getData()[5];
        pressure3 = (int)rx.getData()[6];
        pressure4 = (int)rx.getData()[7];
        rain = (int)rx.getData()[8];
        rain2 = (int)rx.getData()[9];
        rain3 = (int)rx.getData()[10];
        rain4 = (int)rx.getData()[11];
        nodeRec = (int)rx.getData()[12];
        
        sprintf(conTemp, "%d%d",temp-48,temp2-48);
        sprintf(conHum, "%d%d",hum-48,hum2-48);
        sprintf(conPress, "%d%d%d%d", pressure-49,pressure2-48,pressure3-48,pressure4-48);
        sprintf(conRain, "%d%d%d%d", rain-49,rain2-48,rain3-48,rain4-48);
        sprintf(node, "%d", nodeRec-48);
        
        Serial.println();
        String getData = "GET /insert.php?"+ field1 + "=" + node +"&"+ field2 +"="+conTemp+"&"+field3+"="+conHum+"&"+field4+"="+conPress+"&"+field5+"="+conRain;
        sendCommand("AT+CIPMUX=1","OK");
        sendCommand("AT+CIPSTART=0,\"TCP\",\""+ HOST +"\","+ PORT,"OK");
        sendCommand("AT+CIPSEND=0," +String(getData.length()+4),">");
        ESPserial.println(getData);
        Serial.println(getData);
        sendCommand("AT+CIPCLOSE=0","OK");
    }
}

void sendCommand(String command, char readReply[]) {
  Serial.print(". at command => ");
  Serial.print(command);
  Serial.print(" ");
  ESPserial.println(command); //at+cipsend
  if(ESPserial.find(readReply))//ok
  {
    Serial.println("OK");
  } else {
    Serial.println("Fail! Entering while!");
    while(!ESPserial.find(readReply)){
      sendCommand(command,readReply);//at+cipsend
      break;
    }
  }
}
