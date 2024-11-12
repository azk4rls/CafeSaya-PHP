-- Gunakan database_milikmu sebagai pengganti cafekita
USE cafesaya;

-- Tabel untuk menyimpan data pengguna
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    jabatan ENUM('admin', 'kasir', 'staff') NOT NULL
);

-- Tabel untuk menyimpan data menu
CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(100) NOT NULL,
    kategori ENUM('makanan', 'minuman', 'snack', 'dessert') NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    gambar VARCHAR(255)
);

-- Tabel untuk menyimpan data karyawan
CREATE TABLE karyawan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(50) NOT NULL,
    jabatan ENUM('admin', 'kasir', 'koki') NOT NULL,
    password VARCHAR(255) NOT NULL,
    penjualan INT DEFAULT 0 
);

let hasil = "Sekian Terima Gaji Yang Ga Bilang Terimakasih Yteam"
console.log(hasil);
