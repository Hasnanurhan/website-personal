<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_tanaman'];
    $tanggal = $_POST['tanggal_panen'];
    $stmt = $conn->prepare("INSERT INTO jadwal_panen (nama_tanaman, tanggal_panen) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $tanggal);
    $stmt->execute();
    $stmt->close();
    header("Location: jadwal_panen.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Panen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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
<div class="container">
    <div class="card-glow">
        <h2 class="mb-4">Jadwal Panen</h2>
        <a href="index.php" class="btn btn-secondary mb-3"> Kembali</a>

        <form method="post" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="nama_tanaman" class="form-control" placeholder="Nama Tanaman" required>
                </div>
                <div class="col-md-4">
                    <input type="date" name="tanggal_panen" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-glow w-100">Tambah</button>
                </div>
            </div>
        </form>

        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tanaman</th>
                    <th>Tanggal Panen</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM jadwal_panen ORDER BY tanggal_panen DESC";
            $result = $conn->query($sql);
            $no = 1;
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama_tanaman'] . "</td>";
                    echo "<td>" . $row['tanggal_panen'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Gagal mengambil data: " . $conn->error . "</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
