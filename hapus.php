<?php
error_reporting (E_ALL);
ini_set('display_errors', 1);

// konek ke database
include 'config.php';

$hapus = $conn->query("DELETE FROM riwayat");

if($hapus) {
    echo "menghapus data...<br>";
    header("Location: riwayat.php");
    exit();
} else {
    echo "<p style='color:red;'>Gagal menghapus: ". $conn->error."</p>";
}
?>
