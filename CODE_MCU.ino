//void Line_Notify(String message) ;
#include <SoftwareSerial.h>
#include <ESP8266WiFi.h>
#include <WiFiClientSecureAxTLS.h> 
SoftwareSerial NodeSerial(D5, D6); // RX | TX
// Config connect WiFi

const char* ssid = "TP-LINK_A21CD4"; //"OPPO A7";  // สร้างตัวแปรไว้เก็บชื่อ ssid ของ AP ของเรา
const char* pass = "84779373";    //"12345678";  //สร้างตัวแปรไว้เก็บชื่อ password ของ AP ของเรา

//#define WIFI_SSID    "TP-LINK_A21CD4"    // "OPPO A7"   
//#define WIFI_PASSWORD   "84779373"        //"12345678"


const char* host = "it2.sut.ac.th";   //ใส่ IP หรือ Host ของเครื่อง Database ก็ได้
  
String randNumber; //ตัวแปรที่ต้องการจะส่ง



// Line config
#define LINE_TOKEN "WaPY3qxOUgEyEHW5CMhlAt1N9rjv4dtR5BB3YVrCvwa"

#define SW1 D2 //เเก้ว
#define SW2 D3 //พลาสติก

String message = "%E0%B9%80%E0%B9%80%E0%B8%81%E0%B9%89%E0%B8%A7%E0%B9%80%E0%B8%95%E0%B9%87%E0%B8%A1"; // ArduinoIDE เวอร์ชั่นใหม่ ๆ ใส่ภาษาไทยลงไปได้เลย
String message2 = "%E0%B8%9E%E0%B8%A5%E0%B8%B2%E0%B8%AA%E0%B8%95%E0%B8%B4%E0%B8%81%E0%B9%80%E0%B8%95%E0%B9%87%E0%B8%A1";

void setup() {

pinMode(SW1,OUTPUT);
pinMode(SW2,OUTPUT);  
pinMode(D5, INPUT);
pinMode(D6, OUTPUT);
Serial.begin(9600);
NodeSerial.begin(4800);

WiFi.begin(ssid, pass); //ทำการเชื่อมต่อไปยัง AP

  while (WiFi.status() != WL_CONNECTED) { //รอจนกว่าจะเชื่อมต่อสำเร็จ 
    Serial.print("."); //แสดง ... ไปเรื่อยๆ จนกว่าจะเชื่อมต่อได้
    delay(500);
  } //ถ้าเชื่อมต่อสำเร็จก็จะหลุก loop while 
  Serial.println(""); 
  Serial.println("Wi-Fi connected"); //แสดงว่าเชื่อมต่อ Wi-Fi ได้แล้ว
  Serial.print("IP Address : ");
  Serial.println(WiFi.localIP()); //แสดง IP ของบอร์ดที่ได้รับแจกจาก AP

}
////////////////////////// loop ////////////////////////////////////
void loop() {


  while (NodeSerial.available() > 0) {
randNumber = String(NodeSerial.parseInt()); 
  Serial.println(randNumber);
  connectToLocalhost(); 
   }
delay(100);

 
                                                   //LINE
   if (digitalRead(SW1) == HIGH) {
    while(digitalRead(SW1) == HIGH) 
    delay(10);

    Serial.println("LINE Enter1 GO!");
    Line_Notify(message);
  }
   if (digitalRead(SW2) == HIGH) {
    while(digitalRead(SW2) == HIGH) 
    delay(10);

    Serial.println("LINE Enter2 GO!");
    Line_Notify(message2);
   }
  delay(10); 

}

/////////////////////////ส่งเข้า line//////////////////////////////
void Line_Notify(String message) {
  axTLS::WiFiClientSecure client; // กรณีขึ้น Error ให้ลบ axTLS:: ข้างหน้าทิ้ง

  if (!client.connect("notify-api.line.me", 443)) {
    Serial.println("connection failed");
    return;   
  }

  String req = "";
  req += "POST /api/notify HTTP/1.1\r\n";
  req += "Host: notify-api.line.me\r\n";
  req += "Authorization: Bearer " + String(LINE_TOKEN) + "\r\n";
  req += "Cache-Control: no-cache\r\n";
  req += "User-Agent: ESP8266\r\n";
  req += "Connection: close\r\n";
  req += "Content-Type: application/x-www-form-urlencoded\r\n";
  req += "Content-Length: " + String(String("message=" + message).length()) + "\r\n";
  req += "\r\n";
  req += "message=" + message;
  // Serial.println(req);
  client.print(req);
    
  delay(20);

  while(client.connected()) {
    String line = client.readStringUntil('\n');
    if (line == "\r") {
      break;
    }
  }
}

///////////////////////////ส่งเข้าdatabase///////////////////////////

void connectToLocalhost(){
  delay(1000);

  Serial.print("connecting to ");
  Serial.println(host);

  WiFiClient client;
  const int httpPort = 80;

  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  }
  String url = "/project61_g9/garbag/add_code.php?code=";      //ชุด Directory ที่เก็บไฟล์ และตัวแปรที่ต้องการจะฝาก
  url += randNumber; //ส่งค่าตัวแปร คะแนน
 

  Serial.print("Requesting URL: ");
  Serial.println(url);

  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" + 
               "Connection: close\r\n\r\n");
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }

  // Read all the lines of the reply from server and print them to Serial
  while(client.available()){
    String line = client.readStringUntil('\r');
    Serial.print(line);
  }

  Serial.println();
  Serial.println("closing connection");
}
