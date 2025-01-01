<?php

include "../config/database.php";

$webhookResponse = json_decode(file_get_contents('php://input'), true);

$topic = $webhookResponse['topic'];
$payload = $webhookResponse['payload'];

$hasilExplode = explode("/", $topic);

$jenis_sensor = $hasilExplode[2];
$data_sensor = $payload;
$serial_number = $hasilExplode[1];

$sql = "INSERT INTO sensor (jenis_sensor, data_sensor, serial_number)
        VALUES ('$jenis_sensor', '$data_sensor', '$serial_number')";

mysqli_query($conn, $sql);

?>