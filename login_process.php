<?php
session_start([
    'cookie_lifetime' => 0, // Sesi akan berakhir ketika browser ditutup
]);
$host = 'localhost';
$db = 'cafesaya';
$user = 'root'; // ganti dengan username database Anda
$pass = ''; // ganti dengan password database Anda

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Password salah.";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan.";
        header("Location: index.php");
        exit();
    }
}

$conn->close();
?>
