<?php
include 'config.php';

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO karyawan (nik, nama, jabatan, password) VALUES ('$nik', '$nama', '$jabatan', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: karyawan.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
