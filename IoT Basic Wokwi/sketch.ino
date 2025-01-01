#include <WiFi.h>
#include <MQTT.h>
#include <DHTesp.h>
#include <LiquidCrystal_I2C.h>
#include <ESP32Servo.h>

WiFiClient net;
MQTTClient client;
Servo servo;

String serialNumber = "12345678";

const char ssid[] = "Wokwi-GUEST";
const char pass[] = "";

DHTesp dhtSensor;
LiquidCrystal_I2C lcd(0x27, 16, 2);

const int pinButton = 25;
const int pinServo = 18;
const int pinDHT = 26;
const int pinLED = 33;

float temperature = 0.0;
float oldTemperature = 0.0;

bool proses = false;
bool prosesSelesai = false;

void setup() {
  lcd.init();
  lcd.backlight();
  dhtSensor.setup(pinDHT, DHTesp::DHT22);
  pinMode(pinButton, INPUT_PULLUP);
  pinMode(pinLED, OUTPUT);

  Serial.begin(9600);
  servo.attach(pinServo, 500, 2400);

  WiFi.begin(ssid, pass);
  client.begin("petfeeder.cloud.shiftr.io", net);
  client.onMessage(subscribe);

  connect();
}

void loop() {
  if (!client.connected()) {
    connect();
  }
  client.loop();

  TempAndHumidity data = dhtSensor.getTempAndHumidity();
  bool buttonState = digitalRead(pinButton) == LOW;

  if (buttonState && !proses) {
    proses = true;
    digitalWrite(pinLED, HIGH);  // Nyalakan LED
    servo.write(90);  // Gerakkan servo ke 90 derajat untuk memberikan makanan
    lcd.clear();  // Bersihkan LCD
    lcd.setCursor(0, 0);
    lcd.print("Proses: Makan");
    delay(2000);  // Simulasi waktu untuk memberikan makanan
    servo.write(0);  // Kembalikan servo ke 0 derajat
    digitalWrite(pinLED, LOW);  // Matikan LED
    prosesSelesai = true;  // Tandai proses selesai
    proses = false;

    // Publish data suhu dan status makan
    publish(data.temperature, true);
  } else if (!buttonState && prosesSelesai) {
    // Jika tombol dilepas setelah proses selesai, tampilkan "Pet Feeder"
    prosesSelesai = false;
    lcd.clear();  // Bersihkan LCD
    lcd.setCursor(0, 0);
    lcd.print("Pet Feeder");
  }

  // Publish hanya data suhu jika ada perubahan
  if (data.temperature != oldTemperature) {
    publish(data.temperature, false);
    oldTemperature = data.temperature;
  }

  // Tampilkan data suhu pada LCD jika tidak ada proses makan yang sedang berlangsung
  if (!proses) {
    lcd.setCursor(0, 1);
    lcd.print("Suhu: ");
    lcd.print(String(data.temperature, 2));
    lcd.print(" C");
  }

  delay(1000);  // Delay setiap detik
}

void connect() {
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
  }
  while (!client.connect("ESP32", "petfeeder", "2BV7aBDzdnEsfSMF")) {
    delay(500);
  }
  client.subscribe("petfeeder/12345678/control");
}

void publish(float temperature, bool publishStatusMakan) {
  // Publish data suhu
  client.publish("petfeeder/" + serialNumber + "/temperature", String(temperature), false, 1);

  // Publish status makan jika diperlukan
  if (publishStatusMakan) {
    client.publish("petfeeder/" + serialNumber + "/status", "Makan", false, 1);
  }
}

void subscribe(String &topic, String &payload) {
  Serial.println("Received: " + topic + " - " + payload);
  if (topic == "petfeeder/"+ serialNumber +"/control") {
    if (payload == "nyala") {
      digitalWrite(pinLED, HIGH);
      servo.write(90); 
    } else if (payload == "mati") {
      digitalWrite(pinLED, LOW);
       servo.write(0); 
    }
  }
}
