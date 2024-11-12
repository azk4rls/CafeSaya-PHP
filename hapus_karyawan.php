<?php
include 'config.php';

$nik = $_GET['nik'];
$sql = "DELETE FROM karyawan WHERE nik=$nik";

if ($conn->query($sql) === TRUE) {
    echo "Karyawan berhasil dihapus";
    header('Location: karyawan.php');
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
