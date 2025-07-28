<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Riwayat Sensor</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-light">
  <div class="container py-5">
    <h2 class="mb-4 text-center">Riwayat Sensor Mingguan</h2>
<div class="mb-3 text-center">
  <button onclick="window.print()" class="btn btn-outline-light me-2">Print</button>
  <a href="export_sensor_csv.php" class="btn btn-outline-success">Download CSV</a>
</div>
<table class="table table-bordered table-dark table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Waktu</th>
      <th>Kelembaban Tanah (%)</th>
      <th>Suhu Udara (°C)</th>
      <th>Kelembaban Udara (%)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $query = $conn->query("SELECT * FROM sensor_data WHERE waktu >= NOW() - INTERVAL 7 DAY ORDER BY waktu DESC");
    while ($row = $query->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row['waktu'] . "</td>";
        echo "<td>" . $row['Soil'] . "</td>";
        echo "<td>" . $row['temperature'] . "</td>";
        echo "<td>" . $row['humidity'] . "</td>";
        echo "</tr>";
    }
    ?>
  </tbody>
</table>
  </div>
</body>
</html>
