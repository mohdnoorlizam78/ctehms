//rujukan web : https://www.electronicwings.com/esp32/temperature-alert-on-whatsapp-using-esp32
#include <WiFi.h>   // konfigur library WiFi ESP32. Boleh guna "WiFi.h"
#include <HTTPClient.h> // Panggil library HTTPClient.h untuk menggunakan web browser. Boleh guna "HTTPClient.h"
#include <UrlEncode.h> // Panggil UrlEncoder untuk encode mesej yang dihantar.
#include "DHT.h" //masukkan library DHT 22

#define DHTPIN 4 // konfigur DHT 22 dengan menggunakan GPIO 4 
#define DHTTYPE DHT22 // konfigur DHT jenis 22 

// isytihar objek dht 
DHT dht(DHTPIN, DHTTYPE);

//isytiharkan pembolehubah untuk WiFi
const char* ssid = "zamnik-2.4GHz@unifi";
const char* password = "Abc@2021";

//isytiharkan pembolehubah alamat IP localhost/server untuk aplikasi web dan pangkalan data
const char* localhost = "192.168.0.147"; // ubah jika ip localhost berlainan

//isytiharkan pembolehubah untuk whatsapp dari callmebot(https://www.callmebot.com/)
String MobileNumber = "+60172699960";
String APIKey = "5884001";

// buat function sendmessage untuk hantar mesej
void sendMessage(String mesejAmaran){
  String url = "https://api.callmebot.com/whatsapp.php?phone=" + MobileNumber + "&apikey=" + APIKey + "&text=" + urlEncode(mesejAmaran);   
  HTTPClient http;
  http.begin(url);

  // Tentukan content-type header
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
 
  int httpResponseCode = http.POST(url);
  if (httpResponseCode == 200){
    Serial.print("Mesej berjaya dihantar.");
  }
  else{
    Serial.println("Mesej tidak berjaya dihantar.");
    Serial.print("HTTP response code: ");
    Serial.println(httpResponseCode);
  }
  http.end();
}

void setup() {
  Serial.begin(115200); // aktifkan serial monitor
  dht.begin(); // aktifkan sensor DHT 22
  WiFi.mode(WIFI_STA); // fungsi untuk menyembunyikan ESP dari dilihat sebagai wifi hotspot
  
  // periksa sambungan ke WiFi
  WiFi.begin(ssid, password);
  Serial.println("Sambungan ke WiFi");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print("."); // jika WiFi tidak sambung, paparan akan menjadi '.........'
  }

  //jika Wifi bersambung
  Serial.println("");
  Serial.print("Disambungkan ke WiFi: ");
  Serial.println(ssid);
  Serial.print("Alamat IP ESP32: ");
  Serial.println(WiFi.localIP());
  delay(500);
  sendMessage("\n Mesej dari ESP32!"); // mesej 'Mesej dari ESP32!' akan ke whatapps untuk pengesahan.
}

void loop() {
 
  // baca nilai suhu dan kelembapan
  float suhu = dht.readTemperature();
  int kelembapan = dht.readHumidity();

  // Periksa jika ada pembacaan yang gagal dan keluar
  if (isnan(kelembapan) || isnan(suhu)) {
  Serial.println(F("Gagal baca bacaan dari DHT22!"));
  return;
  }
  //paparkan nilai sensor di serial monitor
  Serial.println("\n Bacaan suhu sekarang      : " + String(suhu) + "°C");
  Serial.println("Bacaan kelembapan sekarang: " + String(kelembapan) + "%");
  Serial.println("Selesai");
 
 //suhu di antara 19°C hingga 24°C dengan kelembapan pada tahap 60% hingga 70% (kementerian kesihatan malaysia)
        if(suhu >= 33 || kelembapan >= 90) {
          String mesejAmaran = "Suhu atau kelembapan melebihi paras normal!\n";
          mesejAmaran += "Suhu sekarang: " + String(suhu, 2) + "°C \n" + "Kelembapan sekarang: " + String(kelembapan) + "%";
          sendMessage(mesejAmaran);
        }
  
  // menghantar data ke server
  WiFiClient client;

  // kenalpasti port web server 80 / 8080
  const int httpPort = 80;
  if(!client.connect(localhost,httpPort))
  {
    Serial.println("Sambungan ke web server gagal.");
    return;
  }

  // jika bersambung dengan web server, data dihantar ke pangkalan data.
  String Sambungan;
  HTTPClient http;

  // hantar data ke local web server 'localhost/php_iot_multi_penderia'
  Sambungan = "http://" + String(localhost) + "/php_iot_multi_penderia/hantardata.php?suhu=" + String(suhu) + "&kelembapan=" + String(kelembapan);

  // laksanakan alamat sambungan
  http.begin(Sambungan);
  http.GET();
  
  // paparkan tindak balas dari web server apabila data berjaya disimpan.
  String makluman = http.getString();
  Serial.println(makluman);
  http.end();

  delay(3000); // bacaan setiap 5 saat

}

