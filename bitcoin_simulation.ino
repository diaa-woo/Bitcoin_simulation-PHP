#include <ESP8266WiFi.h>

#include <ArduinoJson.h>
#include <ArduinoJson.hpp>


//#include <WiFi.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#define BTN_1 24
#define BTN_2 23
#define MAX_DATA_COUNT 10

#ifndef STASSID
#define STASSID "bssm_free" //와이파이 검색했을때 뜨는 이름
#define STAPSK  "bssm_free" //패스워드
#endif

const char* ssid = STASSID;
const char* password = STAPSK;

const char* host = "10.150.151.188";
const int httpsPort = 4433;

uint8_t mod = 0;
uint8_t max_v = 1;
uint8_t count = 0;

LiquidCrystal_I2C lcd(0x27, 16, 2);

String dataNames[MAX_DATA_COUNT];
String dataValues[MAX_DATA_COUNT];

void get_data() {
   // client가 서버에 접속하는 단계
  // Use WiFiClientSecure class to create TLS connection
  const int httpsPort = 4433;
  Serial.print("connecting to ");
  Serial.println(host);
  
  String url = "/bitcoin_simulation/backend/send_price.php";
  Serial.print("requesting URL: ");
  Serial.println(url);

  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;

    if (client.connect(host, httpsPort)) {
      // HTTP 요청 보내기
      client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                   "Host: " + host + "\r\n" +
                   "Connection: close\r\n\r\n");

      // 응답 받기
      String response;
      while (client.connected()) {
        if (client.available()) {
          char c = client.read();
          response += c;
        }
      }

      // JSON 데이터 처리
      int bodyIndex = response.indexOf("\r\n\r\n") + 4;
      String payload = response.substring(bodyIndex);

      // 전체 JSON 데이터 인코딩
      StaticJsonDocument<1024> doc;
      deserializeJson(doc, payload);

      // 전체 JSON 데이터를 문자열로 인코딩
      String encodedData;
      serializeJson(doc, encodedData);
      
      // 데이터 이름 배열과 값 배열 초기화
      int dataCount = 0;

      // JSON 객체 순회하며 데이터 이름과 값을 추출하여 배열에 저장
      for (const JsonPair& pair : doc.as<JsonObject>()) {
        if (dataCount < MAX_DATA_COUNT) {
          dataNames[dataCount] = pair.key().c_str();
          dataValues[dataCount] = pair.value().as<String>();
          dataCount++;
        }
      }

      // 데이터 이름과 값을 시리얼 모니터에 출력
      Serial.println("Received data:");
      for (int i = 0; i < dataCount; i++) {
        Serial.print("Name: ");
        Serial.print(dataNames[i]);
        Serial.print(", Value: ");
        Serial.println(dataValues[i]);
      }

      max_v = sizeof(dataNames) / sizeof(dataNames[0]);
      
      Serial.println("Received data: " + encodedData);
    } else {
      Serial.println("Connection failed");
    }

    client.stop();
  }
}

void setup() {
  Serial.begin(115200);

  lcd.begin();

  Serial.print("Connecting to");
  Serial.println(ssid);

  // Connect Wifi
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());

  get_data();
}

void price() {
  lcd.clear();
  lcd.print(dataNames[mod]);
  lcd.setCursor(0,1);
  lcd.print(dataValues[mod]);
}

void result() {
  String url = "/bitcoin_simulation/backend/change_value.php?coin_name=BSSM&coin_count="+count;

  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;

    if (client.connect(host, httpsPort)) {
      // HTTP 요청 보내기
      client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                   "Host: " + host + "\r\n" +
                   "Connection: close\r\n\r\n");
    }

    client.stop();
  }  

  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Complete!");
  delay(2000);
  get_data();
}

void buy() {
  delay(1000);
  count = 0;
  while(!digitalRead(BTN_2)) {
    if(digitalRead(BTN_1)) {
      count++;
      lcd.clear();
      lcd.setCursor(0,0);
  	  lcd.print("How much?");
  	  lcd.setCursor(0,1);
      lcd.print(count);
    }
  }
  result();
}
  

void btn_wait() {
  while(!digitalRead(BTN_1) && !digitalRead(BTN_2));
  if(digitalRead(BTN_1)) {
    if(mod == max_v) {
      mod = 0;
    }
    else mod++;
  }
  else {
    buy();
  }
}

void loop() {
  price();
  btn_wait();
}