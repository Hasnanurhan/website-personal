<?php
include 'config.php';
$data = json_decode(file_get_contents("php://input"), true);
if ($data){
    $Soil = $data['Soil'];
    $temperature = $data['temperature'];
    $humidity = $data['humidity'];
    $query = "INSERT INTO sensor_data (Soil, temperature, humidity) VALUES ('$Soil', '$temperature', '$humidity')";
    mysqli_query($conn, $query);
    echo json_encode(["status" => "berhasil"]);
} else {
    echo json_encode(["status" => "gagal"]);
}
?>