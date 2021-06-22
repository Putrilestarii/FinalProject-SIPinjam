<?php
session_start();
include '../koneksi.php';
$email = $_POST['email'];
$password = $_POST['password'];

$sql_login = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
$sql_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE email='$email' AND password='$password'");
$jumlah = mysqli_num_rows($sql_login);
$jumlah_siswa = mysqli_num_rows($sql_siswa);

if ($jumlah > 0) {
    $row = mysqli_fetch_assoc($sql_login);
    $_SESSION["id_user"] = $row["id"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["role"] = $row["role"];
    $_SESSION["email"] = $row["email"];
    header("Location: ../index.php");
} elseif ($jumlah_siswa > 0) {
    $row = mysqli_fetch_assoc($sql_siswa);
    $_SESSION["id_user"] = $row["id"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["role"] = "siswa";
    $_SESSION["email"] = $row["email"];
    header("Location: ../index.php");
} else {
    echo "Username atau password salah <br><a href='../index.php'>Kembali</a>";
};
