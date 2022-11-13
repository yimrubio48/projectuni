#include "HX711.h"
#include <Servo.h> 
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
#include <SoftwareSerial.h>

LiquidCrystal_I2C lcd(0x27, 16, 2);


#define calibration_factor -380000
#define line1 2
#define line2 3


Servo myservo;  

HX711 scale(A1, A0);		// parameter "gain" is ommited; the default value 128 is used by the library
SoftwareSerial ArduinoSerial(10, 11);


int count = 1;
int countt = 1;
int full = 0;
int fulll = 0;

unsigned int randNumber;



void setup() {
pinMode(6, OUTPUT);
pinMode(7, OUTPUT);
pinMode(4, OUTPUT);
pinMode(5, OUTPUT);

pinMode (line1, OUTPUT);
pinMode (line2, OUTPUT);




  lcd.begin();                           
  myservo.attach(8); 
  Serial.begin(9600);
  ArduinoSerial.begin(4800);
  Serial.println("HX711 Demo");

  Serial.println("Before setting up the scale:");
  Serial.print("read: \t\t"); 
  Serial.println(scale.read());			                // print a raw reading from the ADC

  Serial.print("read average: \t\t");
  Serial.println(scale.read_average(20));  	        // print the average of 20 readings from the ADC

  Serial.print("get value: \t\t");
  Serial.println(scale.get_value(5));		            // print the average of 5 readings from the ADC minus the tare weight (not set yet)

  Serial.print("get units: \t\t");
  Serial.println(scale.get_units(5), 1);	          // print the average of 5 readings from the ADC minus tare weight (not set) divided 
						                                        // by the SCALE parameter (not set yet)  

  scale.set_scale(calibration_factor);              // this value is obtained by calibrating the scale with known weights; see the README for details
  scale.tare();				                              // reset the scale to 0

  Serial.println("After setting up the scale:");

  Serial.print("read: \t\t");
  Serial.println(scale.read());                     // print a raw reading from the ADC

  Serial.print("read average: \t\t");
  Serial.println(scale.read_average(20));           // print the average of 20 readings from the ADC

  Serial.print("get value: \t\t");
  Serial.println(scale.get_value(5));		            // print the average of 5 readings from the ADC minus the tare weight, set with tare()

  Serial.print("get units: \t\t");
  Serial.println(scale.get_units(5), 1);            // print the average of 5 readings from the ADC minus tare weight, divided 
						                                        // by the SCALE parameter set with set_scale

  Serial.println("Readings:");

  myservo.write(110);
  lcd.print("Ready!!>_<");
 
  
  
  

}
  


void loop() {{
  delay(1000);
            Serial.print("one reading:\t");
            Serial.println(scale.get_units());
 

myservo.write(110); 

float  x = (scale.get_units()) ;
delay(500);


//case 1
  if (x >= 0.20){                            //แก้ว
    digitalWrite(7, HIGH);
          Serial.println("Glass" );
          Serial.println(x);
myservo.write(340); 
delay(1500);  
myservo.write(110); 
    digitalWrite(7, LOW);
          Serial.print("count Glass : ");
          Serial.println(count);
          lcd.setCursor(0, 0);  
          lcd.print("Glass : ");              //LCD
          lcd.println(count);
          lcd.setCursor(0, 1); 
           
          int A = randNumber = random(1000, 10000);
          Serial.println(randNumber);
          lcd.print("CODE : ");
          lcd.println(randNumber);
          ArduinoSerial.print(A);
        
         
          
delay(100); 
                                              //LINE         
  if (count <= 2){ 
    digitalWrite(line1,LOW);   
    count++;
  }else if(count == 3){
    digitalWrite(line1, HIGH);
    count = 0;
    
  } 


  if (full <= 2) {                            //ledfull
    digitalWrite(5, LOW);
    full++;
  }else { (full == 4);
   digitalWrite(5, HIGH);
   full = 0;
  }  
  
  

//case 2
  } if ( x >= 0.04 && x <= 0.20){              //พลาสติก
   digitalWrite(6, HIGH);
          Serial.println("Plastic"); 
          Serial.println(x);
myservo.write(30); 
delay(1500); 
myservo.write(110);
   digitalWrite(6, LOW);  
           Serial.print("count Plastic : ");
           Serial.println(countt);
           lcd.setCursor(0, 0); 
           lcd.print("Plastic :");                  //LCD
           lcd.print(countt);
           lcd.setCursor(0, 1); 

           int A = randNumber = random(1000, 10000);
           Serial.println(randNumber);
           lcd.print("CODE : ");
           lcd.println(randNumber);
           ArduinoSerial.print(A);
          
         
          
           
          
delay(100);
                                                   //LINE 
   if (countt <= 2){ 
    digitalWrite(line2,LOW);   
    countt++;
  }else if(countt == 3){
    digitalWrite(line2, HIGH);
    countt = 0;
   
  } 

  if (fulll <= 2) {                              //ledfulll
    digitalWrite(4, LOW);
    fulll++;
  }else { (fulll == 4);
   digitalWrite(4, HIGH);
   fulll = 0;
  }  
  
    
 }

 return 0; 
}
}
