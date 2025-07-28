<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>MaFlush</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="style_dark_blur.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="container py-5">
    <h2 class="text-center text-light mb-4"><i class="bi bi-droplet-half"></i> MaFlush Dashboard</h2>
    <h5 class="text-center text-light mb-4">"Smart Farming, Smart Future" </h5>

    <!-- Tombol Navigasi -->
    <div class="text-center mb-4">
      <a href="monitoring.php" class="btn btn-outline-info mx-2">Monitoring</a>
      <a href="jadwal_tanam.php" class="btn btn-outline-primary mx-2">Jadwal Tanam</a>
      <a href="jadwal_panen.php" class="btn btn-outline-warning mx-2">Jadwal Panen</a>
      <a href="riwayat.php" class="btn btn-outline-success mx-2">Riwayat Penyiraman</a>
      <a href="riwayat_sensor.php" class="btn btn-outline-danger">Riwayat Sensor</a>
    </div>

    <!-- Tombol Siram -->
    <div class="row mb-4">
      <div class="col-md-6">
        <div class="card-glow p-3 text-center">
          <form method="POST" action="manual_siram.php">
            <button type="submit" class="btn btn-primary">Siram Manual</button>
          </form>
        </div>
      </div>
    <!-- Riwayat penyiraman -->
      <div class="col-md-6">
        <div class="card-glow p-3">
          <h5>Riwayat Penyiraman</h5>
          <ul class="list-unstyled text-light" style="max-height: 150px; overflow-y: auto;">
            <?php
            $q = $conn->query("SELECT * FROM riwayat ORDER BY waktu DESC LIMIT 5");
            while ($r = $q->fetch_assoc()) {
              echo "<li>{$r['waktu']} - {$r['aksi']}</li>";
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
    <!-- Sensor Akhir -->
    <div class="row mb-4">
      <div class="col-md-6">
        <div class="card-glow p-3">
          <h5>Sensor Terakhir</h5>
          <?php
          include 'config.php';
          $query = $conn->query("SELECT * FROM sensor_data ORDER BY waktu DESC LIMIT 1");
          if ($query) {
            $data = $query->fetch_assoc();
            echo "Kelembaban Tanah: " . $data['Soil'] . "%<br>";
            echo "Suhu Udara: " . $data['temperature'] . "°C<br>";
            echo "Kelembaban Udara: " . $data['humidity'] . "%<br>";
            echo "Waktu: " . $data['waktu'] . "<br>";
          } else {
            echo "Query gagal: " . $conn->error;
          }
          ?>
          </div>
        </div>
      <!-- Status -->
      <div class="col-md-6">
        <div class="card-glow p-3">
          <h5>Status Sistem</h5>
          <p>Sistem berjalan normal. Menyiram otomatis jika kelembaban &lt; 40%.</p>
        </div>
      </div>
    </div>
 <!-- Jadwal Tanam -->
<div class="row mb-4">
  <div class="col-md-6">
    <div class="card-glow p-3">
      <h5>Jadwal Tanam</h5>
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Tanaman</th>
            <th>Tanggal Tanam</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'config.php';
          $sql = "SELECT * FROM jadwal_tanam ORDER BY tanggal_mulai DESC";
          $result = $conn->query($sql);
          $no = 1;
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $no++ . "</td>";
              echo "<td>" . $row['nama_tanaman'] . "</td>";
              echo "<td>" . $row['tanggal_mulai'] . "</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Jadwal Panen -->
  <div class="col-md-6">
    <div class="card-glow p-3">
      <h5>Jadwal Panen</h5>
      <table class="table table-dark table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Tanaman</th>
            <th>Tanggal Panen</th> 
          </tr>
        </thead>
        <tbody>
          <?php
          include 'config.php';
          $sql = "SELECT * FROM jadwal_panen ORDER BY tanggal_panen DESC";
          $result = $conn->query($sql);
          $no = 1;
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $no++ . "</td>";
              echo "<td>" . $row['nama_tanaman'] . "</td>";
              echo "<td>" . $row['tanggal_panen'] . "</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

    <!-- Grafik -->
    <div class="card-glow p-4">
      <h5 class="text-center mb-4">Grafik Kelembaban dan Suhu</h5>
      <canvas id="chartSensor"></canvas>
    </div>
  </div>
<!-- Grafik  -->
  <script>
   fetch("grafik_data.php")
  .then(res => res.json())
  .then(data => {
    const waktu = data.map(d => d.waktu);
    const soil = data.map(d => d.soil);      
    const suhu = data.map(d => d.suhu);
    const kelembaban = data.map(d => d.kelembaban);

    const ctx = document.getElementById('chartSensor').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: waktu,
        datasets: [
          {
            label: 'Kelembaban Tanah (%)',
            data: soil,
            borderColor: '#00FFCC',
            backgroundColor: 'rgba(0,255,204,0.2)',
            fill: true,
            tension: 0.4
          },
          {
            label: 'Suhu Udara (°C)',
            data: suhu,
            borderColor: '#AA88FF',
            backgroundColor: 'rgba(170,136,255,0.2)',
            fill: true,
            tension: 0.4
          },
          {
            label: 'Kelembaban Udara (%)',
            data: kelembaban,
            borderColor: '#b22222',
            backgroundColor: 'rgba(255,0,0,0.2)',
            fill: true,
            tension: 0.4
          }
        ]
      },
      options: {
        responsive: true,
        scales: {
          x: {
            ticks: { color: '#fff' },
            grid: { color: '#444' }
          },
          y: {
            beginAtZero: true,
            ticks: { color: '#fff' },
            grid: { color: '#444' }
          }
        },
        plugins: {
          legend: { labels: { color: '#fff' } }
        }
      }
    });
  });
  </script>

  <div class="container text-center">
    <div class="text-center text-light mb-4">
       <h6>© 2025 by Hasna Nur Hanifah|Universitas Persatuan Islam </h6>
  </div>
   </div>
   <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
   <script>
    const client = mqtt.connect('wss://broker.emqx.io:8084/mqtt');
    client.on('connect', function (){
      console.log('MQTT terhubung!');
      client.subscribe('iot/tanaman/data')
    });
    client.on('message', function (topic, message){
      const data = JSON.parse(message.toString());
      document.getElementById('temperature').innerText = data.temperature + "C";
      document.getElementById('humidity').innerText = data.khumidity + "%";
      document.getElementById('Soil').innerText = data.Soil + "%";
    });
    </script>
</body>
</html>

