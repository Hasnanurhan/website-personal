<?php
include 'config.php';
$esp_ip = "192.168.249.45"; 
file_get_contents("http://$esp_ip/manual_siram");


$aksi = "Siram Manual";
$sql = "INSERT INTO riwayat (aksi) VALUES ('$aksi')";
$conn->query($sql);

date_default_timezone_set('Asia/Jakarta');
$waktu = date("y-m-d H:i:s");
$jenis = "manual";

$sql2 = "INSERT INTO penyiraman (waktu,jenis) VALUES ('$waktu', '$jenis')";
$conn->query($sql2);

$sql3 = "UPDATE kontrol SET manual_siram = 1 WHERE id = 1";
$conn->query($sql3);
$conn->close();
header("location: index.php");
exit();
?>