<?php
// Koneksi ke database
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    // Proses upload gambar
    $target_dir = "uploads/"; // Ubah path ke folder uploads
    
    // Buat folder jika belum ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $gambar = $_FILES['gambar']['name'];
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    
    // Cek apakah file adalah gambar
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $allowed_types = array('jpg','jpeg','png','gif');
    
    if(in_array($imageFileType, $allowed_types)) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Query untuk insert data
            $query = "INSERT INTO menu (nama_menu, harga, stok, gambar) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("siis", $nama_menu, $harga, $stok, $gambar);
            
            if ($stmt->execute()) {
                header("Location: menu.php");
                exit();
            } else {
                echo "Gagal menambahkan menu.";
            }
        } else {
            echo "Gagal mengupload gambar. Error: " . $_FILES["gambar"]["error"];
        }
    } else {
        echo "Hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
    }
}

?>
