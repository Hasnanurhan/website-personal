<?php
include 'config.php';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="riwayat_sensor.csv"');

$output = fopen("php://output", "w");
fputcsv($output, ['Waktu', 'Kelembaban Tanah', 'Suhu Udara', 'Kelembaban Udara']);

$query = $conn->query("SELECT * FROM sensor_data WHERE waktu >= NOW() - INTERVAL 7 DAY ORDER BY waktu DESC");
while ($row = $query->fetch_assoc()) {
    fputcsv($output, [$row['waktu'], $row['Soil'], $row['temperature'], $row['humidity']]);
}
fclose($output);
exit;
?>
