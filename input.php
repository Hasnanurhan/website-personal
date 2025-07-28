<?php
include 'config.php';

$Soil = $_GET['Soil'] ?? '';
$temp = $_GET['temp'] ?? '';
$hum = $_GET['hum'] ?? '';

if ($Soil === '' || $temp === '' || $hum === '') {
    echo "Data tidak lengkap";
    exit;
}

$sql = "INSERT INTO sensor_data (Soil, temperature, humidity, waktu) 
        VALUES ('$Soil', '$temp', '$hum', NOW())";

if ($conn->query($sql) === TRUE) {
    echo "OK";
} else {
    echo "Error: " . $conn->error;
}
?>
