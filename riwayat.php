<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Penyiraman</title>
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
        .btn-hapus{
            background-color: #b22222;
            color:#fff ;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
        }
    </style>
                 </head>
                 <body>
                    <div class="container mt-5">
                        <h2 class="mb-4">Riwayat Penyiraman</h2>
                        <a href="index.php" class="btn btn-secondary mb-3"> Kembali </a>
                            <form action="hapus.php" method="post" onsubmit="return confirm('Yakin ingin menghapus semua riwayat?');">
                            <button type="submit" name="hapus" class="btn-hapus"> Hapus Semua Riwayat</button>
                        </form>
                        <table class="table table-dark table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Waktu</th>
                              </tr>
                         </thead>
                <tbody>
                    <?php
                    $sql ="SELECT * FROM riwayat ORDER BY waktu DESC";
                    $result = $conn->query($sql);
                    $no = 1;
                    while($row = $result->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>". $no++ . "</td>";
                        echo "<td>". $row['aksi']. "</td>";
                        echo "<td>". $row['waktu']."</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </body>
            </html>