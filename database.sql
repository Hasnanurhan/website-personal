CREATE DATABASE IF NOT EXISTS iotdb;
USE iotdb;

CREATE TABLE IF NOT EXISTS sensor_data(
    id INT AUTO_INCREMENT PRIMARY KEY,
    Soil FLOAT,
    temperature FLOAT,
    humidity FLOAT,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS riwayat(
    id INT AUTO_INCREMENT PRIMARY KEY,
    aksi VARCHAR(100),
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS jadwal_tanam(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_tanaman VARCHAR(100),
    tanggal_mulai DATE
);
CREATE TABLE IF NOT EXISTS jadwal_panen(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_tanaman VARCHAR(100),
    tanggal_panen DATE
);
CREATE TABLE IF NOT EXISTS penyiraman(
    id INT AUTO_INCREMENT PRIMARY KEY,
    waktu DATETIME DEFAULT CURRENT_TIMESTAMP,
    jenis VARCHAR(50)
);
CREATE TABLE kontrol (
  id INT PRIMARY KEY,
  manual_siram INT
);
