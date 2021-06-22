<?php
include '../koneksi.php';
$sarpras = $_POST['sarpras'];
$total = $_POST['total'];
$id = $_POST['id'];

$sql_pinjam = mysqli_query($conn, "UPDATE sarpras SET sarpras = '$sarpras', total_sarpras = '$total' WHERE id = '$id'");

if ($sql_pinjam) {
?>
    <script type="text/javascript">
        alert("Berhasil Mengubah");
        window.location.href = "../sarpras.php"
    </script>
<?php

} else {
    echo "Gagal";
};
