<?php
include 'config.php';
session_start(); // Start the session

if (!isset($_SESSION['logged_in'])) {
    echo "Session 'nama' is not set. Redirecting to login.";
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
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
    <h2 class="mb-4"><b>Daftar Karyawan CafeSaya</b></h2>

    <!-- Tombol Tambah Karyawan -->
    <a href="tambah_karyawan.php" class="btn btn-primary mb-3" >Tambah Karyawan</a>

    <!-- Tabel Data Karyawan -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Penjualan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM karyawan");

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . htmlspecialchars($row['nik']) . "</td>
                    <td>" . htmlspecialchars($row['nama']) . "</td>
                    <td>" . htmlspecialchars($row['jabatan']) . "</td>
                    <td>" . htmlspecialchars($row['penjualan']) . "</td>
                    <td>
                        <a href='edit_karyawan.php?nik=" . $row['nik'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='hapus_karyawan.php?nik=" . $row['nik'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus karyawan ini?')\">Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Link Bootstrap JS and dependencies (Optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap 5 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
<?php
$conn->close();
?>

