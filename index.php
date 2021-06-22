<?php
session_start();
if (!isset($_SESSION["id_user"])) {
    header("Location:./auth/login.php");
}

include 'koneksi.php';
include 'layouts/header.php';
?>
<div class="content-wrapper">
    <div class="container-fluid">

        <?php if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'administrator') { ?>
            <div class="row">
                <div class="main-header">
                    <h4>Dashboard</h4>
                </div>
            </div>
            <!-- 4-blocks row start -->
            <div class="row dashboard-header">
                <div class="col-lg-3 col-md-6">
                    <div class="card dashboard-product">
                        <span>Siswa</span>
                        <h2 class="dashboard-total-products">
                            <?php
                            $row = mysqli_query($conn, "SELECT * FROM siswa");
                            $data = mysqli_num_rows($row);

                            echo $data;
                            ?>
                        </h2>
                        <span class="label label-warning">Seluruh Sekolah</span>
                        <div class="side-box">
                            <i class="ti-user text-warning-color"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card dashboard-product">
                        <span>Total Sarana Prasarana</span>
                        <h2 class="dashboard-total-products">
                            <?php
                            $row = mysqli_query($conn, "SELECT SUM(total_sarpras) FROM sarpras");
                            while ($data = mysqli_fetch_row($row)) {
                                echo $data[0];
                            }
                            ?>
                        </h2>
                        <span class="label label-primary">Buah</span>
                        <div class="side-box ">
                            <i class="ti-package text-primary-color"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card dashboard-product">
                        <span>Sarana Prasarana Tersedia</span>
                        <h2 class="dashboard-total-products"><span>
                                <?php
                                $row = mysqli_query($conn, "SELECT SUM(total_sarpras) FROM sarpras");
                                while ($data = mysqli_fetch_row($row)) {
                                    $row_pinjam = mysqli_query($conn, "SELECT SUM(total) FROM peminjaman WHERE status = 'y'");
                                    while ($data_pinjam = mysqli_fetch_row($row_pinjam)) {
                                        echo $data[0] - $data_pinjam[0];
                                    }
                                }
                                ?>
                            </span></h2>
                        <span class="label label-success">Buah</span>
                        <div class="side-box">
                            <i class="ti-control-shuffle text-success-color"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card dashboard-product">
                        <span>Sarana Prasarana Disewa</span>
                        <h2 class="dashboard-total-products"><span>
                                <?php
                                $row = mysqli_query($conn, "SELECT SUM(total) FROM peminjaman WHERE status = 'y'");
                                while ($data = mysqli_fetch_row($row)) {
                                    if ($data[0] == 0) {
                                        echo "0";
                                    } else {
                                        echo $data[0];
                                    }
                                }
                                ?>
                            </span></h2>
                        <span class="label label-danger">Buah</span>
                        <div class="side-box">
                            <i class="ti-archive text-danger-color"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 4-blocks row end -->
            <div class="row">
                <div class="main-header">
                    <h4>Daftar Pinjam</h4>
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
                                            <th>Nama Siswa</th>
                                            <th>Sekolah</th>
                                            <th>Pinjam</th>
                                            <th>Total Pinjam</th>
                                            <th>Awal Pinjam</th>
                                            <th>Akhir Pinjam</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $row = mysqli_query($conn, "SELECT * FROM peminjaman");
                                        while ($data = mysqli_fetch_assoc($row)) {
                                            $id_siswa = $data['id_siswa'];
                                        ?>
                                            <tr>
                                                <th>
                                                    <?php echo $data['id_siswa'] ?>
                                                </th>
                                                <td>
                                                    <?php
                                                    $row_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$id_siswa'");
                                                    while ($data_siswa = mysqli_fetch_assoc($row_siswa)) {
                                                        echo $data_siswa['username'];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $row_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$id_siswa'");
                                                    while ($data_siswa = mysqli_fetch_assoc($row_siswa)) {
                                                        $sekolah = $data_siswa['id_sekolah'];
                                                        $row_sekolah = mysqli_query($conn, "SELECT * FROM sekolah WHERE id = '$sekolah'");
                                                        while ($data_sekolah = mysqli_fetch_assoc($row_sekolah)) {
                                                            echo $data_sekolah['nama_sekolah'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $sarpras = $data['id_sarpras'];
                                                    $row_sarpras = mysqli_query($conn, "SELECT * FROM sarpras WHERE id = '$sarpras'");
                                                    while ($data_sarpras = mysqli_fetch_assoc($row_sarpras)) {
                                                        echo $data_sarpras['sarpras'];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['total'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['tgl_awal'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['tgl_akhir'] ?>
                                                </td>
                                                <td>
                                                    <?php if ($data['status'] == 'p') {
                                                    ?>
                                                        <span class="badge badge-warning">Pending</span>
                                                    <?php
                                                    } elseif ($data['status'] == 'y') {
                                                    ?>
                                                        <span class="badge badge-success">Disetujui</span>
                                                    <?php
                                                    } elseif ($data['status'] == 'n') {
                                                    ?>
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    <?php
                                                    } elseif ($data['status'] == 'done') {
                                                    ?>
                                                        <span class="badge badge-primary">Selesai</span>
                                                    <?php
                                                    } ?>
                                                </td>
                                                <td>
                                                    <?php if ($data['status'] == 'p') {
                                                    ?>
                                                        <a href="./backend/setuju.php?id=<?php echo $data['id'] ?>&id_sarpras=<?php echo $data['id_sarpras'] ?>" class="btn btn-success">Setujui</a>
                                                        <a href="./backend/tolak.php?id=<?php echo $data['id'] ?>" class="btn btn-danger">Tolak</a>
                                                    <?php
                                                    } elseif ($data['status'] == 'y') {
                                                    ?>
                                                        <a href="./backend/selesai.php?id=<?php echo $data['id'] ?>" class="btn btn-success">Pinjam Selesai</a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="row">
                <div class="main-header">
                    <?php
                    $id_siswa = $_SESSION['id_user'];
                    $sql_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$id_siswa'");
                    while ($data_sekolah = mysqli_fetch_assoc($sql_siswa)) {
                        $id_sekolah = $data_sekolah['id_sekolah'];
                        $sql_sekolah = mysqli_query($conn, "SELECT * FROM sekolah WHERE id = '$id_sekolah'");
                        while ($data = mysqli_fetch_assoc($sql_sekolah)) {
                    ?>
                            <h4>Daftar Pinjam - <?php echo $data['nama_sekolah'] ?></h4>
                    <?php
                        }
                    }
                    ?>

                    <a href="#" data-toggle="modal" data-target="#tambahpinjam" class="btn btn-success">Tambah Pinjam</a>
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
                                            <th>Nama Siswa</th>
                                            <th>Sekolah</th>
                                            <th>Pinjam</th>
                                            <th>Total Pinjam</th>
                                            <th>Awal Pinjam</th>
                                            <th>Akhir Pinjam</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id_siswa = $_SESSION['id_user'];
                                        $row = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_siswa = '$id_siswa'");
                                        while ($data = mysqli_fetch_assoc($row)) {
                                        ?>
                                            <tr>
                                                <th>
                                                    <?php echo $data['id_siswa'] ?>
                                                </th>
                                                <td>
                                                    <?php
                                                    $row_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$id_siswa'");
                                                    while ($data_siswa = mysqli_fetch_assoc($row_siswa)) {
                                                        echo $data_siswa['username'];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $row_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$id_siswa'");
                                                    while ($data_siswa = mysqli_fetch_assoc($row_siswa)) {
                                                        $sekolah = $data_siswa['id_sekolah'];
                                                        $row_sekolah = mysqli_query($conn, "SELECT * FROM sekolah WHERE id = '$sekolah'");
                                                        while ($data_sekolah = mysqli_fetch_assoc($row_sekolah)) {
                                                            echo $data_sekolah['nama_sekolah'];
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $sarpras = $data['id_sarpras'];
                                                    $row_sarpras = mysqli_query($conn, "SELECT * FROM sarpras WHERE id = '$sarpras'");
                                                    while ($data_sarpras = mysqli_fetch_assoc($row_sarpras)) {
                                                        echo $data_sarpras['sarpras'];
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['total'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['tgl_awal'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $data['tgl_akhir'] ?>
                                                </td>
                                                <td>
                                                    <?php if ($data['status'] == 'p') {
                                                    ?>
                                                        <span class="badge badge-warning">Pending</span>
                                                    <?php
                                                    } elseif ($data['status'] == 'y') {
                                                    ?>
                                                        <span class="badge badge-success">Disetujui</span>
                                                    <?php
                                                    } elseif ($data['status'] == 'n') {
                                                    ?>
                                                        <span class="badge badge-danger">Ditolak</span>
                                                    <?php
                                                    } elseif ($data['status'] == 'done') {
                                                    ?>
                                                        <span class="badge badge-primary">Selesai</span>
                                                    <?php
                                                    } ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" role="dialog" id="tambahpinjam">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <form action="./backend/tambahpinjam.php" method="POST">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Pinjam</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nama Sarpras</label>
                                    <?php
                                    $id_siswa = $_SESSION['id_user'];
                                    $sql_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$id_siswa'");
                                    while ($data_siswa = mysqli_fetch_assoc($sql_siswa)) {
                                        $id_sekolah = $data_siswa['id_sekolah'];
                                        $sql_sekolah = mysqli_query($conn, "SELECT * FROM sekolah WHERE id = '$id_sekolah'");
                                        while ($data_sekolah = mysqli_fetch_assoc($sql_sekolah)) {
                                    ?>
                                            <input type="hidden" class="form-control" name="id_sekolah" value="<?php echo $data_sekolah['id'] ?>">
                                    <?php
                                        }
                                    }
                                    ?>
                                    <select class="form-control" id="exampleFormControlSelect1" name="nama_sarpras">
                                        <option value="">Pilih Sarpras</option>
                                        <!-- WHERE ID SEKOLAH -->
                                        <?php
                                        $id_siswa = $_SESSION['id_user'];
                                        $sql_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id = '$id_siswa'");
                                        while ($data_siswa = mysqli_fetch_assoc($sql_siswa)) {
                                            $id_sekolah = $data_siswa['id_sekolah'];
                                            $sql_sarpras = mysqli_query($conn, "SELECT * FROM sarpras WHERE id_sekolah = '$id_sekolah'");
                                            while ($data_sarpras = mysqli_fetch_assoc($sql_sarpras)) {
                                        ?>
                                                <option value="<?php echo $data_sarpras['id'] ?>"><?php echo $data_sarpras['sarpras'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Total Pinjam</label>
                                    <input type="number" class="form-control" placeholder="Total Pinjam" name="total_sarpras">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Awal Pinjam</label>
                                    <input type="date" class="form-control" name="tgl_awal">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Akhir Pinjam</label>
                                    <input type="date" class="form-control" name="tgl_akhir">
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
        <?php } ?>
    </div>
</div>
<?php
include 'layouts/footer.php';
