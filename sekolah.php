<?php
session_start();
if (!isset($_SESSION["id_user"])) {
    header("Location:./auth/login.php");
}

include './koneksi.php';
include './layouts/header.php';

$admin = $_SESSION['id_user'];
$sql_sekolah = mysqli_query($conn, "SELECT * FROM sekolah WHERE id_admin = '$admin'");
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- 4-blocks row end -->
        <div class="row">
            <div class="main-header">
                <h4>Daftar Sekolah</h4>
                <a href="#" data-toggle="modal" data-target="#tambahsekolah" class="btn btn-success">Tambah Sekolah</a>
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
                                        <th>Total Siswa</th>
                                        <th>Total Sarana Prasarana</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($sql_sekolah)) {
                                        $sql_id_sekolah = $data['id'];
                                        $sql_total_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id_admin = '$admin' AND id_sekolah = '$sql_id_sekolah'");
                                        $sql_total_sarpras = mysqli_query($conn, "SELECT SUM(total_sarpras) FROM sarpras WHERE id_admin = '$admin' AND id_sekolah = '$sql_id_sekolah'");
                                        $data_siswa = mysqli_num_rows($sql_total_siswa);
                                    ?>
                                        <tr>
                                            <th>
                                                <?php echo $data['id'] ?>
                                            </th>
                                            <td>
                                                <?php echo $data['nama_sekolah'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data_siswa; ?>
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
                                                <a href="" data-toggle="modal" data-target="#editsekolah<?php echo $data['id'] ?>" class="btn btn-mini btn-primary waves-effect waves-light">Edit Sekolah
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal" tabindex="-1" role="dialog" id="editsekolah<?php echo $data['id'] ?>">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form action="./backend/editsekolah.php" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Sekolah</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Nama Sekolah</label>
                                                                <input type="hidden" class="form-control" name="id" value="<?php echo $data['id'] ?>">
                                                                <input type="text" class="form-control" placeholder="Nama Sekolah" name="sekolah" value="<?php echo $data['nama_sekolah'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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

<div class="modal" tabindex="-1" role="dialog" id="tambahsekolah">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="./backend/tambahsekolah.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sekolah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Sekolah</label>
                        <input type="text" class="form-control" placeholder="Nama Sekolah" name="sekolah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include './layouts/footer.php';
