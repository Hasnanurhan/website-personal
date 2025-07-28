<?php
include 'config.php';

// Query ambil data terakhir (misalnya 10 data terakhir)
$sql = "SELECT waktu, Soil, temperature, humidity FROM sensor_data ORDER BY waktu DESC LIMIT 10";
$result = $conn->query($sql);

// Array hasil
$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
  'waktu' => $row['waktu'],
  'soil' => (float)$row['Soil'],
  'suhu' => (float)$row['temperature'],
  'kelembaban' => (float)$row['humidity']
];

    }
}


// Keluarkan sebagai JSON
header('Content-Type: application/json');
echo json_encode(array_reverse($data)); // dibalik agar waktu terbaru terakhir

$conn->close();
?>
