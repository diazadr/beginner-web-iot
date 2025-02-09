# Beginner Web

![Project Status](https://img.shields.io/badge/status-completed-brightgreen) [![License](https://img.shields.io/badge/license-MIT-blue)](./LICENSE) [![Certificate](https://img.shields.io/badge/Certificate-Available-blue)](https://github.com/user-attachments/files/18722930/Sertifikat.pdf)

Beginner project IoT using MQTT protocol with a PHP-based website. This project is a basic Internet of Things (IoT) training project organized by **Nusabot**.

## **Illustrations**
<img src="https://github.com/user-attachments/assets/88b4315f-1696-49f0-b915-1de6f4ca06d6" alt="Illustration" style="width: 600px; height: auto;">

Explanation of the MQTT protocol, consisting of an MQTT Client publishing, MQTT Broker, and an MQTT Client subscribing.

## **Technologies Used**
- **Shiftr Io**
- **MQTT Protocol**
- **Wokwi**
- **PHP**

## **Features**
- **Real-time Data Storage**: Stores real-time data from microcontrollers into an SQL database.
- **Device Identification**: Captures device serial numbers such as ESP32.
- **Sensor Data Handling**: Logs and monitors sensor readings.
- **Servo Control & LCD Display**: Controls a servo motor and displays temperature sensor readings on an LCD.
- **Web Monitoring & Control**: Allows users to monitor and control components via a web interface.

## **Demo**

### **Wokwi Simulation**
<img src="https://github.com/user-attachments/assets/f31b77b3-9dc6-4cef-829d-3b04919eae21" alt="Wokwi Simulation" style="width: 600px; height: auto;">

### **Website Interface**
<img src="https://github.com/user-attachments/assets/a3157250-4706-472b-aa3e-479ffc4ccfeb" alt="Website Interface" style="width: 600px; height: auto;">
<img src="https://github.com/user-attachments/assets/e3437fcc-1aef-43c4-9f91-068b62505dd6" alt="Website Interface" style="width: 600px; height: auto;">
<img src="https://github.com/user-attachments/assets/258601e1-3300-4cca-8057-500cdfa6ee6e" alt="Website Interface" style="width: 600px; height: auto;">
<img src="https://github.com/user-attachments/assets/bd386fc7-8aaa-420c-a008-a5c9dfb7512e" alt="Website Interface" style="width: 600px; height: auto;">
<img src="https://github.com/user-attachments/assets/5589b00e-75a9-4123-8cdc-32317eb6e3f1" alt="Website Interface" style="width: 600px; height: auto;">

### **Shiftr Io Dashboard**
<img src="https://github.com/user-attachments/assets/80d5727a-7884-4e89-b2be-e00a36b7a507" alt="Shiftr Io Dashboard" style="width: 600px; height: auto;">

## **Installation and Setup**
1. **Clone the Repository**:
   ```sh
   git clone https://github.com/your-username/beginner-web.git
   cd beginner-web
   ```
2. **Set Up a Local Server**:
   - Use **XAMPP** or **Laragon** to run a local server.
   - Move the project files to the `htdocs` or `www` directory.
3. **Import Database**:
   - Open **phpMyAdmin**.
   - Create a new database.
   - Import the provided SQL file.
4. **Configure `config.php`**:
   - Update database credentials in `config.php`.
5. **Run the Project**:
   - Open a web browser and go to `http://localhost/beginner-web/`.

## **Usage**
1. Connect an ESP32 device to the MQTT broker.
2. Use the web dashboard to monitor sensor data and control devices.
3. Send MQTT messages to control servo motors and other peripherals.

## **Project Status**
This project is **completed** and will not be further developed.

## **Contributions**
Contributions are welcome! Feel free to open issues or submit pull requests.

## **License**
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
