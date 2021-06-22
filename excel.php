<?php
session_start();
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Peminjaman.xls");
include './koneksi.php';
$id_laporan = $_GET['id'];
$admin = $_SESSION['id_user'];

?>

<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <center>
        <h1>Laporan Peminjaman <br /> SI Pinjam</h1>
    </center>

    <table class="table">
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
            $row = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id_sekolah = '$id_laporan' AND (status = 'y' OR status = 'n' OR status = 'done')");
            while ($data = mysqli_fetch_assoc($row)) {
                $id_siswa = $data['id_siswa'];
            ?>
                <tr>
                    <th>
                        <?php echo $data['id'] ?>
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
</body>

</html>