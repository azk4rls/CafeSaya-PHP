<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    echo "Session 'nama' is not set";
    header('Location: index.php');
    exit;
}
include 'config.php'; // Koneksi ke database cafesaya
$query = "SELECT * FROM menu";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu CafeSaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand text-light ms-3" href="../dashboard.php">CafeSaya</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link text-light" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="karyawan.php">Karyawan</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown" style="margin-right: 6rem;">
          <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['username']; ?>
          </a>
          <ul class="dropdown-menu bg-dark">
            <li><a class="dropdown-item text-light" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
    <h1 class="text-center"><b>Halaman Menu CafeSaya</b></h1>
    <!-- Tambah tombol dan tabel -->
    
    <table class="table table-striped">
      <thead>
        <tr>
          <th class="text-center">No</th>
          <th class="text-center">Gambar</th>
          <th class="text-center">Nama Menu</th>
          <th class="text-center">Harga</th>
          <th class="text-center">Stok</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <div class="text-end mb-3">
            <a href="tambah_menu.php" class="btn btn-primary">Tambah Menu</a>
        </div>
        <?php
            include 'config.php';
            $query = "SELECT * FROM menu";
            $result = mysqli_query($conn, $query);
            $no = 1;
            
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td class='text-center'>" . $no++ . "</td>";
              echo "<td class='text-center'>
                      <img src='uploads/" . $row['gambar'] . "' 
                          width='45' height='45'
                          alt='Menu Image' 
                          class='img-thumbnail' 
                          onclick='showImage(this.src)' 
                          style='cursor: pointer;'>
                    </td>";
              echo "<td class='text-center'>" . $row['nama_menu'] . "</td>";
                echo "<td class='text-center'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                echo "<td class='text-center'>" . $row['stok'] . "</td>";
                echo "<td class='text-center'>
                <a href='edit_menu.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                <a href='hapus_menu.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                </td>";
                echo "</tr>";
              }
              ?>
        </tbody>
      </table>
    </div>
    
    <!-- Tambahkan kode modal di bagian bawah sebelum closing body tag -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center">
            <img src="" id="modalImage" class="img-fluid" alt="Menu Image">
          </div>
        </div>
      </div>
    </div>

    <!-- Tambahkan script JavaScript sebelum closing body tag -->
    <script>
    function showImage(src) {
        document.getElementById('modalImage').src = src;
        var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
        myModal.show();
    }
    </script>

    <!-- Pastikan Bootstrap JS sudah diinclude -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
