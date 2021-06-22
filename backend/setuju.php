<?php
include '../koneksi.php';
$id = $_GET['id'];
$id_sarpras = $_GET['id_sarpras'];

$sql_pinjam = mysqli_query($conn, "UPDATE peminjaman SET status = 'y' WHERE id = '$id'");
$sql_rating = mysqli_query($conn, "UPDATE rating SET rating = 1 WHERE id_sarpras = '$id_sarpras'");

if ($sql_pinjam && $sql_rating) {
?>
    <script type="text/javascript">
        alert("Berhasil Menyetujui Peminjaman");
        window.location.href = "../index.php"
    </script>
<?php

} else {
    echo "Gagal";
};
