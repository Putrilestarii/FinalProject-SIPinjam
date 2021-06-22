<?php
session_start();
if (!isset($_SESSION["id_user"])) {
    header("Location:./auth/login.php");
}
include './koneksi.php';
include './layouts/header.php';
$jumlah = 0;
$rating = "";
$admin = $_SESSION['id_user'];
$sql_sekolah = mysqli_query($conn, "SELECT * FROM sekolah WHERE id_admin = '$admin'");

$sql = "SELECT id_sarpras, COUNT(*) as 'total' from rating  WHERE rating = 1 GROUP by id_sarpras LIMIT 0,10";
$hasil = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($hasil)) {
    $idsarpras = $data['id_sarpras'];
    $sql_sarpras = mysqli_query($conn, "SELECT * FROM sarpras WHERE id = '$idsarpras'");

    while ($id_art = mysqli_fetch_assoc($sql_sarpras)) {
        //Mengambil nilai rating dari database
        $rat = $id_art['sarpras'];
        $rating .= "'$rat'" . ", ";
    }
    //Mengambil nilai total dari database
    $jum = $data['total'];
    $jumlah .= "$jum" . ", ";
}
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- 4-blocks row end -->
        <div class="row">
            <div class="main-header">
                <h4>laporan Peminjaman</h4>
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
                                                <a href="./laporan_detail.php?id=<?php echo $data['id'] ?>" class="btn btn-mini btn-primary waves-effect waves-light">Lihat Laporan
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
        <div class="row">
            <div class="main-header">
                <h4>Grafik</h4>
            </div>
        </div>
        <div class="row p-3">
        <div class="row mb-5">
            <div class="col-9 container mr-auto ml-auto">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        </div>
        <br><br><br>
    </div>
</div>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: [<?php echo $rating; ?>],
            datasets: [{
                label: ['RATING'],
                backgroundColor: ['rgb(26, 188, 156)', 'rgb(230, 126, 34)', 'rgb(231, 76, 60)', 'rgb(142, 68, 173)', 'rgb(44, 62, 80)', 'rgb(230, 126, 34)', 'rgb(211, 84, 0)', 'rgb(189, 195, 199)', 'rgb(52, 73, 94)', 'rgb(243, 156, 18)', 'rgb(155, 89, 182)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [<?php echo $jumlah; ?>]
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<?php
include './layouts/footer.php';
