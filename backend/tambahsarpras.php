<?php
session_start();

include '../koneksi.php';
$sekolah = $_POST['id_sekolah'];
$id_admin = $_SESSION['id_user'];
$nama_sarpras = $_POST['sarpras'];
$jumlah_sarpras = $_POST['jumlah_sarpras'];

$sql_sekolah = mysqli_query($conn, "INSERT INTO sarpras (sarpras, total_sarpras, id_sekolah, id_admin) VALUES ('$nama_sarpras', '$jumlah_sarpras', '$sekolah','$id_admin')");

if ($sql_sekolah) {
?>
    <script type="text/javascript">
        alert("Berhasil menambahkan Sarana Prasana!");
        window.location.href = "../sarpras.php"
    </script>
<?php

} else {
    echo "Gagal";
};
