<?php
session_start();

include '../koneksi.php';
$id_siswa = $_SESSION['id_user'];
$id_sarpras = $_POST['nama_sarpras'];
$id_sekolah = $_POST['id_sekolah'];
$total_sarpras = $_POST['total_sarpras'];
$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];
$status = "p";
$rating = 0;

$sql_peminjaman = mysqli_query($conn, "INSERT INTO peminjaman (id_siswa, id_sarpras, id_sekolah, total, tgl_awal, tgl_akhir, status) VALUES ('$id_siswa','$id_sarpras', '$id_sekolah','$total_sarpras','$tgl_awal','$tgl_akhir','$status')");
$sql_rating = mysqli_query($conn, "INSERT INTO rating (id_sarpras, total_sarpras, rating) VALUES ('$id_sarpras', '$total_sarpras', '$rating')");

if ($sql_peminjaman && $sql_rating) {
?>
    <script type="text/javascript">
        alert("Berhasil Request Peminjaman");
        window.location.href = "../index.php"
    </script>
<?php

} else {
    echo "Gagal";
};
