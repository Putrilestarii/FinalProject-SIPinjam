<?php
session_start();
if (!isset($_SESSION["id_user"])) {
    header("Location:./auth/login.php");
}

include './koneksi.php';
include './layouts/header.php';

$admin = $_SESSION['id_user'];
$sql_sarpras = mysqli_query($conn, "SELECT * FROM sekolah WHERE id_admin = '$admin'");
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- 4-blocks row end -->
        <div class="row">
            <div class="main-header">
                <h4>Daftar Sarpras</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table m-b-0 photo-table">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Nomor</th>
                                        <th>Sekolah</th>
                                        <th>Total Sarana Prasarana</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($sql_sarpras)) {
                                        $sql_id_sekolah = $data['id'];
                                        $sql_total_sarpras = mysqli_query($conn, "SELECT SUM(total_sarpras) FROM sarpras WHERE id_admin = '$admin' AND id_sekolah = '$sql_id_sekolah'");
                                        $data_sarpras = mysqli_num_rows($sql_total_sarpras);
                                    ?>
                                        <tr>
                                            <th>
                                                <?php echo $data['id'] ?>
                                            </th>
                                            <td>
                                                <?php echo $data['nama_sekolah'] ?>
                                            </td>
                                            <td>
                                                <?php while ($data_sarpras  = mysqli_fetch_row($sql_total_sarpras)) {
                                                    if ($data_sarpras[0] == 0) {
                                                        echo "0";
                                                    } else {
                                                        echo $data_sarpras[0];
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <a href="kelolasarpras.php?id=<?php echo $data['id']; ?>" class="btn btn-mini btn-primary waves-effect waves-light">Kelola Sarpras
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include './layouts/footer.php';
