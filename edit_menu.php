<?php
session_start(); // Start the session
include 'config.php';
if (!isset($_SESSION['logged_in'])) {
    echo "Session 'nama' is not set. Redirecting to login.";
    header('Location: index.php');
    exit;
}

// Mendapatkan ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data menu berdasarkan ID
    $query = "SELECT * FROM menu WHERE id = $id";
    $result = mysqli_query($conn, $query);

    // Jika data ditemukan
    if (mysqli_num_rows($result) > 0) {
        $menu = mysqli_fetch_assoc($result);
    } else {
        echo "Menu tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak diberikan.";
    exit;
}

// Proses update data menu
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_menu = $_POST['nama_menu'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Cek apakah pengguna meng-upload gambar baru
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($gambar);

        // Cek apakah file adalah gambar
        $check = getimagesize($tmp_name);
        if ($check !== false) {
            if (move_uploaded_file($tmp_name, $target_file)) {
                // Update data dengan gambar baru
                $query = "UPDATE menu SET nama_menu = '$nama_menu', kategori = '$kategori', harga = '$harga', stok = '$stok', gambar = '$gambar' WHERE id = $id";
            } else {
                echo "Gagal mengupload gambar baru.";
                exit;
            }
        } else {
            echo "File yang diupload bukan gambar.";
            exit;
        }
    } else {
        // Jika gambar tidak diganti
        $query = "UPDATE menu SET nama_menu = '$nama_menu', kategori = '$kategori', harga = '$harga', stok = '$stok' WHERE id = $id";
    }

    if (mysqli_query($conn, $query)) {
        echo "Menu berhasil diperbarui!";
        header('Location: menu.php'); // Redirect ke halaman menu setelah update
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand text-light ms-3" href="dashboard.php">CafeSaya</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link text-light" href="../dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="../karyawan/karyawan.php">Karyawan</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown" style="margin-right: 6rem;">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['username']; ?>
          </a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-light" href="../index.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
    <h1 class="text-center">Edit Menu</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="<?php echo $menu['nama_menu']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
                <option value="Makanan" <?php if ($menu['kategori'] == 'Makanan') echo 'selected'; ?>>Makanan</option>
                <option value="Minuman" <?php if ($menu['kategori'] == 'Minuman') echo 'selected'; ?>>Minuman</option>
                <option value="Snack" <?php if ($menu['kategori'] == 'Snack') echo 'selected'; ?>>Snack</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $menu['harga']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $menu['stok']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Menu (Biarkan kosong jika tidak ingin mengganti)</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Menu</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
