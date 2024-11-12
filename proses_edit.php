<?php
include 'config.php';

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
$penjualan = $_POST['penjualan'];

$sql = "UPDATE karyawan SET nik='$nik', nama='$nama', jabatan='$jabatan', penjualan='$penjualan'";

if ($conn->query($sql) === TRUE) {
    echo "Data karyawan berhasil diperbarui";
    header('Location: karyawan.php');
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
