<?php
include '../koneksi.php';
$siswa = $_POST['username'];
$id = $_POST['id'];

$sql_pinjam = mysqli_query($conn, "UPDATE siswa SET username = '$siswa' WHERE id = '$id'");

if ($sql_pinjam) {
?>
    <script type="text/javascript">
        alert("Berhasil Mengubah");
        window.location.href = "../siswa.php"
    </script>
<?php

} else {
    echo "Gagal";
};
