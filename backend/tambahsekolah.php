<?php
session_start();

include '../koneksi.php';
$sekolah = $_POST['sekolah'];
$id_admin = $_SESSION['id_user'];

$sql_sekolah = mysqli_query($conn, "INSERT INTO sekolah (nama_sekolah, id_admin) VALUES ('$sekolah','$id_admin')");

if ($sql_sekolah) {
?>
    <script type="text/javascript">
        alert("Berhasil menambahkan sekolah!");
        window.location.href = "../sekolah.php"
    </script>
<?php

} else {
    echo "Gagal";
};
