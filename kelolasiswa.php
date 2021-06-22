<?php
session_start();
if (!isset($_SESSION["id_user"])) {
    header("Location:./auth/login.php");
}

include './koneksi.php';
include './layouts/header.php';

$id_admin = $_SESSION['id_user'];
$id_sekolah = $_GET['id'];
$sql_sekolah = mysqli_query($conn, "SELECT * FROM sekolah WHERE id_admin = '$id_admin' AND id = '$id_sekolah'");
$sql_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id_admin = '$id_admin' AND id_sekolah = '$id_sekolah'");
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- 4-blocks row end -->
        <div class="row">
            <div class="main-header">
                <?php while ($data = mysqli_fetch_assoc($sql_sekolah)) { ?>
                    <h4>Kelola Siswa - <?php echo $data['nama_sekolah']; ?></h4>
                    <a href="#" data-toggle="modal" data-target="#tambahsiswa" class="btn btn-success">Tambah Siswa</a>
                    <div class="modal" tabindex="-1" role="dialog" id="tambahsiswa">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form action="./backend/tambahsiswa.php" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Siswa <?php echo $data['nama_sekolah']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Email Siswa</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email">
                                            <input type="hidden" value="<?php echo $data['id']; ?>" name="id_sekolah">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Siswa</label>
                                            <input type="text" class="form-control" placeholder="Nama Siswa" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password Siswa">
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
                <?php }; ?>
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_assoc($sql_siswa)) {
                                        $sql_id_sekolah = $data['id'];
                                    ?>
                                        <tr>
                                            <th>
                                                <?php echo $data['id'] ?>
                                            </th>
                                            <td>
                                                <?php echo $data['username'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data['email'] ?>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#editsiswa<?php echo $data['id'] ?>" class="btn btn-mini btn-primary waves-effect waves-light">Edit Siswa
                                                </a>
                                            </td>
                                        </tr>
                                        <div class="modal" tabindex="-1" role="dialog" id="editsiswa<?php echo $data['id'] ?>">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form action="./backend/editsiswa.php" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Sekolah</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Nama Siswa</label>
                                                                <input type="hidden" class="form-control" name="id" value="<?php echo $data['id'] ?>">
                                                                <input type="text" class="form-control" placeholder="Nama Siswa" name="username" value="<?php echo $data['username'] ?>">
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


<?php
include './layouts/footer.php';
