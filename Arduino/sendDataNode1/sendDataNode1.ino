#include <Printers.h>
#include <XBee.h>
#include <dht.h>
#include <Wire.h>
#include <SPI.h>
#include <Adafruit_BMP280.h>
#include <math.h>

#define DHT11PIN 5
#define BMP_SCK  (13)
#define BMP_MISO (12)
#define BMP_MOSI (11)
#define BMP_CS   (10)

//dht
dht DHT;

//xbee
XBee xbee = XBee();
uint8_t payload[13]={0,0,0,0,0,0,0,0,0,0,0,0,0};
XBeeAddress64 addr64 = XBeeAddress64(0x000000000, 0x000000000);
ZBTxRequest tx = ZBTxRequest(addr64, payload, sizeof(payload));

//bmp
Adafruit_BMP280 bmp; // I2C

//global var
int temp = 0;
int hum = 0;
double pCek = 0;
int p = 0;
int node = 1;
int rain = 0;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  xbee.setSerial(Serial); 

  if (!bmp.begin(0x76)) {
    Serial.println(F("Could not find a valid BMP280 sensor, check wiring!"));
    while (1);
  }

  /* Default settings from datasheet. */
  bmp.setSampling(Adafruit_BMP280::MODE_NORMAL,     /* Operating Mode. */
                  Adafruit_BMP280::SAMPLING_X2,     /* Temp. oversampling */
                  Adafruit_BMP280::SAMPLING_X16,    /* Pressure oversampling */
                  Adafruit_BMP280::FILTER_X16,      /* Filtering. */
                  Adafruit_BMP280::STANDBY_MS_500); /* Standby time. */
}

void loop() {
  // put your main code here, to run repeatedly:
  int chk = DHT.read11(DHT11PIN);

//  Serial.print("Read sensor: ");
  switch (chk)
  {
    case DHTLIB_OK: 
      Serial.println("OK"); 
      temp = (int)DHT.temperature;
      hum = (int)DHT.humidity;
      break;
    case DHTLIB_ERROR_CHECKSUM: 
      Serial.println("Checksum error"); 
      break;                                                                                                                                                                                     
    case DHTLIB_ERROR_TIMEOUT: 
      Serial.println("Time out error"); 
      break;
    default: 
      Serial.println("Unknown error"); 
      break;
  }

  Serial.print("Humidity (%): ");
  Serial.println((int)DHT.humidity);
//
  Serial.print("Temperature (°C): ");
  Serial.println((int)DHT.temperature);

  pCek = bmp.readPressure()*0.01;
  if(fmod(pCek,1) >= 0.5) {
    p = ceil(pCek)+1000; 
  } else {
    p = pCek+1000;
  }
  Serial.print("p = ");
  Serial.println(p);

  for(int i = 4; i > 0; i--) {
    payload[i+3] = (p%10)+48;
    p = p/10;
  }

  int sensorReading = analogRead(A0);
  rain = (sensorReading * -1) + 2023;
  
  Serial.print("Rain = ");
  Serial.println(rain);
  
  for(int i = 4; i > 0; i--) {
    payload[i+7] = (rain%10)+48;
    rain = rain/10;
  }
  
  payload[0]= (temp/10)+48;
  payload[1]= (temp%10)+48;
  payload[2]= (hum/10)+48;
  payload[3]= (hum%10)+48;
  payload[12]= node+48;

  Serial.println();
  xbee.send(tx);
  delay(11000);
}
