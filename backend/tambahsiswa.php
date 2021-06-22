<?php
session_start();

include '../koneksi.php';
$sekolah = $_POST['id_sekolah'];
$id_admin = $_SESSION['id_user'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql_sekolah = mysqli_query($conn, "INSERT INTO siswa (email, username, password, id_sekolah, id_admin) VALUES ('$email', '$username', '$password','$sekolah','$id_admin')");

if ($sql_sekolah) {
?>
    <script type="text/javascript">
        alert("Berhasil menambahkan siswa!");
        window.location.href = "../siswa.php"
    </script>
<?php

} else {
    echo "Gagal";
};
