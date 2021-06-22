<?php
include '../koneksi.php';
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = 'admin';

$sql_register = mysqli_query($conn, "INSERT INTO users (username, email, password, role) VALUES ('$username','$email','$password','$role')");

if ($sql_register) {
?>
    <script type="text/javascript">
        alert("Pendaftaran Berhasil, Silahkan login!");
        window.location.href = "../auth/login.php"
    </script>
<?php

} else {
    echo "Gagal";
};
?>