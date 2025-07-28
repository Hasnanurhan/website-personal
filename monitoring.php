<?php
include 'config.php';

// Ambil data terbaru dari sensor
$sql = "SELECT * FROM sensor_data ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$data = $result ? $result->fetch_assoc() : null;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Monitoring Sensor</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="style_dark_blur.css" rel="stylesheet">
  <style>
        body {
            background: linear-gradient(135deg, #1a1a1a, #121212);
            font-family: 'Poppins', sans-serif;
            color: #f0f0f0;
            min-height: 100vh;
        }
        .container {
            padding-top: 40px;
        }
        .card-glow {
            background-color: #1f1f1f;
            border: none;
            box-shadow: 0 0 15px rgba(0, 255, 135, 0.15);
            border-radius: 15px;
            padding: 20px;
        }
        .btn-glow {
            background-color: #006eff;
            color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 110, 255, 0.5);
            transition: all 0.3s ease;
        }
        .btn-glow:hover {
            background-color: #0056c9;
            box-shadow: 0 0 15px rgba(0, 110, 255, 0.8);
        }
        table {
            background-color: #222;
            border-radius: 10px;
            overflow: hidden;
        }
        th {
            background-color: #333;
        }
        input, select {
            background-color: #222 !important;
            color: #fff !important;
            border: 1px solid #444 !important;
        }
    </style>
</head>
<body>
<div class="container mt-5">
  <div class="card-glow mb-4">
    <h2>Monitoring Sensor</h2>
    <?php if ($data): ?>
      <p><strong>Kelembaban Tanah:</strong> <?= $data['Soil'] ?>%</p>
      <p><strong>Suhu Udara:</strong> <?= $data['temperature'] ?>°C</p>
      <p><strong>Kelembaban Udara:</strong> <?= $data['humidity'] ?>%</p>
      <p><strong>Waktu:</strong> <?= $data['waktu'] ?></p>
    <?php else: ?>
      <p>Data belum tersedia.</p>
    <?php endif; ?>
    <a href="index.php" class="btn btn-glow mt-3">Kembali ke Dashboard</a>
  </div>
</div>
</body>
</html>
