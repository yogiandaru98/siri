<?php
// include 'db/func.php';


// HOME.PHP

session_start();

if ($_SESSION['username'] == '') {
    echo "<script>
    alert('Anda Harus Login terlebih dahulu');
    window.location.href='./auth/fmasuk.php';
    </script>";
} else {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>SIRI</title>
        <link href="../../db/style.css" rel="stylesheet" type="text/css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/9aeb2c70f0.js" crossorigin="anonymous"></script>

    </head>

    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <h4>SIRI PUSKESMAS PLAYEN </h3>
                </a>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0 d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link menu " id="menuHome" href="../../index.php">Home</a>
                    </li>


                    <?PHP if ($_SESSION['role_id'] == 3) { ?>
                        <li class="nav-item">
                            <a class="nav-link mr-10 menu " id="keloladokter" href="../dokter/read.php"><i class=""></i>Kelola Data Dokter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu " id="kelolapasien" href="./read.php"><i class=""></i>Kelola pasien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="kelolabiaya" href="./adminWeb/biaya/kelolabiaya.php"><i class=""></i>Kelola Biaya</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="inputobat" href="./adminWeb/obat/inputobat.php"><i class=""></i>Input Data Obat</a>
                        </li>

                    <?PHP } ?>


                    <?PHP if ($_SESSION['role_id'] == 2) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu active" id="kelolapasien" href="./read.php"><i class=""></i>Kelola Rawat Inap</a>
                        </li>
                    <?PHP } ?>

                    <?PHP if ($_SESSION['role_id'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu" id="daftarrawatinap" href="../pendaftaran/read.php"><i class=""></i>Pendaftaran Rawat Inap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu active" id="bayarrawatinap" href="./read.php"><i class=""></i>Pembayaran Rawat Inap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="daftarpasien" href="../rekapMedis/read.php"><i class=""></i>Rekap Medis</a>
                        </li>
                    <?PHP } ?>

                    <?PHP if ($_SESSION['role_id'] == 4) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu" id="kelolamedicalrecord" href="./perawat/kelolamedicalrecord.php"><i class=""></i>Kelola Medical Record</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="penggunaanobat" href="./perawat/penggunaanobat.php"><i class=""></i>Penggunaan Obat</a>
                        </li>
                    <?PHP } ?>

                    <?PHP if ($_SESSION['role_id'] == 5) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu" id="tindakan" href="./pasien/tindakan.php"><i class=""></i>Tindakan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="resepobat" href="./pasien/resepobat.php"><i class=""></i>Resep Obat</a>
                        </li>
                    <?PHP } ?>

                    <?PHP if ($_SESSION['role_id'] == 6) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu active" id="validasipembayaran" href="./read.php"><i class=""></i>Validasi Pembayaran</a>
                        </li>
                    <?PHP } ?>

                    <?PHP if ($_SESSION['role_id'] == 7) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu" id="cetaklaporan" href="./pimpinan/laporankeuangan.php"><i class=""></i>Cetak Laporan Keuangan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="cetakobat" href="./pimpinan/cetakobat.php"><i class=""></i>Cetak Penggunaan Obat</a>
                        </li>
                    <?PHP } ?>


                    <li class="nav-item">
                        <a class="nav-link menu" id="logout" href="../../auth/sLogout.php"><i class=""></i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="content">

        </div>
        <script src="assets/js/jquery-3.6.0.min.js"></script>

        <?php
        include("../../db/func.php");
        //  include("./lunas.php");

        $pdo = pdo_connect_mysql();
        // session_start();
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

        $records_per_page = 8;


        $stmt2 = $pdo->prepare('SELECT * FROM pasien WHERE akun_id = ?');
        $stmt2->execute([$_SESSION['id_akun']]);
        $Tpasien = $stmt2->fetch(PDO::FETCH_ASSOC);

        $stmt3 = $pdo->prepare('SELECT * FROM rekap_medis WHERE id_pasien = ?');
        $stmt3->execute([$Tpasien['id_pasien']]);
        $Trekap_medis = $stmt3->fetch(PDO::FETCH_ASSOC);

        $stmt4 = $pdo->prepare('SELECT * FROM rawat_inap WHERE no_rekap_medis = ?');
        $stmt4->execute([$Trekap_medis['no_rekap_medis']]);
        $Trawat_inap = $stmt4->fetch(PDO::FETCH_ASSOC);


        $stmt = $pdo->prepare('SELECT * FROM keuangan WHERE no_rawatinap = ?');
        $stmt->execute([$Trawat_inap['no_rawatinap']]);
        // $stmt->execute();

        $rawats = $stmt->fetchAll(PDO::FETCH_ASSOC);



        // $num_dokters = $pdo->query('SELECT COUNT(*) FROM keuangan')->fetchColumn();
        ?>

        <div class="content read">
            <h2>Data Transaksi</h2>
            <!-- <a href="./create.php" class="menu create-dokter" id="tambahDokter">Tambah Data Rawat Inap</a> -->
            <table class="table-responsive">
                <thead class="table">
                    <tr>
                        <td>NO TRANSAKSI</td>
                        <td>NO RAWAT INAP</td>
                        <td>PERIODE</td>
                        <td>TOTAL BIAYA</td>
                        <td>STATUS PEMBAYARAN</td>
                        <!-- <td style="text-align:center">VALIDASI</td> -->
                        <!-- <td>DOKUMEN</td> -->
                        <!-- <td></td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rawats as $rawat) : ?>
                        <tr>
                            <td><?= $rawat['no_transaksi'] ?></td>
                            <td><?= $rawat['no_rawatinap'] ?></td>
                            <td><?= $rawat['periode_transaksi'] ?></td>
                            <td><?= rupiah($rawat['total_biaya']) ?></td>
                            <td><?= $rawat['statusPembayaran'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h5>Tata Cara Pembayaran</h5>
            <!-- <p></p> -->
            <ol class="list-group-numbered">
                <li class="list-group-item">Informasikan ke kasir ingin membayar biaya rawat</li>
                <li class="list-group-item">Sebutkan No Transaksi yang ingin di bayar</li>
                <li class="list-group-item">Bayarkan sejumlah uang sesuai yang tertera pada menu pembayaran</li>
                <li class="list-group-item">Kasir akan memvalidasi status pembayaran anda</li>
                <li class="list-group-item">Apabila sudah tervalidasi status pembayaran anda pada No Transaksi terkait akan berubah menjadi Lunas</li>
            </ol>

        </div>

    <?php
}
    ?>