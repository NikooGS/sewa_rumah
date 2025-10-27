-- Database: sewa_rumah_db
CREATE DATABASE IF NOT EXISTS sewa_rumah_db;
USE sewa_rumah_db;

-- Table users
CREATE TABLE IF NOT EXISTS users (
  id_user INT(11) NOT NULL AUTO_INCREMENT,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','pemilik','penyewa') NOT NULL DEFAULT 'penyewa',
  PRIMARY KEY (id_user),
  UNIQUE KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table rumah
CREATE TABLE IF NOT EXISTS rumah (
  id_rumah INT(11) NOT NULL AUTO_INCREMENT,
  id_pemilik INT(11) DEFAULT NULL,
  alamat VARCHAR(255),
  harga DECIMAL(12,2),
  deskripsi TEXT,
  gambar VARCHAR(255),
  status ENUM('tersedia','disewa') DEFAULT 'tersedia',
  PRIMARY KEY (id_rumah),
  KEY (id_pemilik),
  CONSTRAINT fk_pemilik FOREIGN KEY (id_pemilik) REFERENCES users(id_user) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table sewa
CREATE TABLE IF NOT EXISTS sewa (
  id_sewa INT(11) NOT NULL AUTO_INCREMENT,
  id_rumah INT(11) DEFAULT NULL,
  id_penyewa INT(11) DEFAULT NULL,
  tanggal_mulai DATE,
  tanggal_selesai DATE,
  total_bayar DECIMAL(12,2) DEFAULT 0,
  status_pembayaran ENUM('belum','lunas') DEFAULT 'belum',
  PRIMARY KEY (id_sewa),
  KEY (id_rumah),
  KEY (id_penyewa),
  CONSTRAINT fk_rumah FOREIGN KEY (id_rumah) REFERENCES rumah(id_rumah) ON DELETE SET NULL,
  CONSTRAINT fk_penyewa FOREIGN KEY (id_penyewa) REFERENCES users(id_user) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Initial users (passwords stored in plaintext for initial import; login page upgrades to hashed on first login)
INSERT INTO users (nama, email, password, role) VALUES
('Admin','admin@gmail.com','admin123','admin'),
('User Penyewa','user@gmail.com','user123','penyewa');

-- Example rumah (optional)
INSERT INTO rumah (id_pemilik, alamat, harga, deskripsi, gambar, status) VALUES
(NULL, 'Jl. Contoh No.1, Kota', 2000000.00, 'Rumah nyaman di pusat kota', '', 'tersedia');
