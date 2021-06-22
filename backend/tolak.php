<?php
include '../koneksi.php';
$id_pinjam = $_GET['id'];

$sql_pinjam = mysqli_query($conn, "UPDATE peminjaman SET status = 'n' WHERE id = '$id_pinjam'");

if ($sql_pinjam) {
?>
    <script type="text/javascript">
        alert("Berhasil Menolak Peminjaman");
        window.location.href = "../index.php"
    </script>
<?php

} else {
    echo "Gagal";
};
