<?php
include '../koneksi.php';
$sekolah = $_POST['sekolah'];
$id = $_POST['id'];

$sql_pinjam = mysqli_query($conn, "UPDATE sekolah SET nama_sekolah = '$sekolah' WHERE id = '$id'");

if ($sql_pinjam) {
?>
    <script type="text/javascript">
        alert("Berhasil Mengubah");
        window.location.href = "../sekolah.php"
    </script>
<?php

} else {
    echo "Gagal";
};
