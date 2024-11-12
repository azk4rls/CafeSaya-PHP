<?php
// Koneksi ke database
include 'config.php';

// Mendapatkan ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data gambar yang akan dihapus dari folder
    $query_select = "SELECT gambar FROM menu WHERE id = $id";
    $result_select = mysqli_query($conn, $query_select);
    if (mysqli_num_rows($result_select) > 0) {
        $menu = mysqli_fetch_assoc($result_select);
        $gambar = $menu['gambar'];

        // Hapus gambar dari folder uploads
        if (file_exists('uploads/' . $gambar)) {
            unlink('uploads/' . $gambar); // Menghapus gambar dari folder
        }

        // Query untuk menghapus data menu dari database
        $query = "DELETE FROM menu WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            echo "Menu berhasil dihapus!";
            header('Location: menu.php'); // Redirect ke halaman menu setelah penghapusan
            exit;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Menu tidak ditemukan.";
    }
} else {
    echo "ID tidak diberikan.";
}

?>
