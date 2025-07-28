<?php
include 'config.php';
if (isset($_GET['Soil']) && isset($_GET['temperature']) && isset($_GET['humdity'])){
    $Soil = floatval($_GET['Soil']);
    $temperature = floatval($_GET['temperature']);
    $humidity = floatval($_GET['humidity']);

    $stmt = $conn->prepare("INSERT INTO sensor_data (Soil,temperature,humdity) VALUES (?,?,?)");
    $stmt->bind_param("ddd", $Soil, $temperature, $humidity);
    $stmt->execute();
    $stmt->close();

    if ($soil < 40){
        $aksi = "Siram Otomatis";
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date ("Y-m-d H:i:s");

        $conn->query("INSERT INTO riwayat (aksi) VALUES ('$aksi')");
        $conn->query("INSERT INTO penyiraman (waktu,jenis) VALUES ('$waktu', 'otomatis')");
    }
    echo "Data berhasil disimpan";
} else{
    echo "Parameter tidak lengkap";
}
$conn->close();
?>