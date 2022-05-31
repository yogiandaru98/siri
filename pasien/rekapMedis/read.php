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
                            <a class="nav-link menu" id="bayarrawatinap" href="../pembayaran/read.php"><i class=""></i>Pembayaran Rawat Inap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu active" id="daftarpasien" href="./read.php"><i class=""></i>Rekap Medis</a>
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

        $stmt5 = $pdo->prepare('SELECT * FROM kamar WHERE no_kamar = ?');
        $stmt5->execute([$Trawat_inap['no_kamar']]);
        $kamar = $stmt5->fetch(PDO::FETCH_ASSOC);

        $stmt11 = $pdo->prepare('SELECT * FROM penggunaan_obat WHERE no_rekap_medis = ?');
        $stmt11->execute([$Trekap_medis['no_rekap_medis']]);

        $stmt6 = $pdo->prepare('SELECT * FROM penggunaan_obat WHERE no_rekap_medis = ?');
        $stmt6->execute([$Trekap_medis['no_rekap_medis']]);
        $pemggunaan_obatAll = $stmt6->fetchAll(PDO::FETCH_ASSOC);
        $pemggunaan_obat = $stmt11->fetch(PDO::FETCH_ASSOC);

        $stmt10 = $pdo->prepare('SELECT * FROM obat WHERE kd_obat = ?');
        $stmt10->execute([$pemggunaan_obat['kd_obat']]);
        $obat = $stmt10->fetch(PDO::FETCH_ASSOC);

        $stmt9 = $pdo->prepare('SELECT SUM(harga) as harga FROM penggunaan_obat WHERE no_rekap_medis = ?');
        $stmt9->execute([$Trekap_medis['no_rekap_medis']]);
        $pemggunaan_obat9 = $stmt9->fetch(PDO::FETCH_ASSOC);

        $stmt7 = $pdo->prepare('SELECT * FROM tindakan WHERE kd_tindakan = ?');
        $stmt7->execute([$Trekap_medis['kd_tindakan']]);
        $tindakan = $stmt7->fetch(PDO::FETCH_ASSOC);

        $stmt8 = $pdo->prepare('SELECT * FROM dokter WHERE kd_dokter = ?');
        $stmt8->execute([$Trekap_medis['kd_dokter']]);
        $dokter = $stmt8->fetch(PDO::FETCH_ASSOC);


        $stmt = $pdo->prepare('SELECT * FROM keuangan WHERE no_rawatinap = ?');
        $stmt->execute([$Trawat_inap['no_rawatinap']]);
        // $stmt->execute();
        $durasi = dateDiffInDays($Trawat_inap['tanggal_masuk'], $Trawat_inap['tanggal_keluar']);
        $rawats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $totalBiayaKamar = $Trawat_inap['biaya_kamar']*$durasi;


        // $num_dokters = $pdo->query('SELECT COUNT(*) FROM keuangan')->fetchColumn();
        ?>

        <div class="content read">
            <h2>Rawat Inap</h2>
            <!-- <a href="./create.php" class="menu create-dokter" id="tambahDokter">Tambah Data Rawat Inap</a> -->
            <table class="table-responsive">
                <thead class="table">
                    <tr>
                        <td>NO RAWAT INAP</td>
                        <td>DURASI</td>
                        <td>TANGGAL KELUAR</td>
                        <td>KONDISI</td>
                        <td>NO KAMAR</td>
                        <td>KELAS KAMAR</td>
                        <td>TOTAL HARGA KAMAR</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rawats as $rawat) : ?>
                        <tr>
                            <td><?= $Trawat_inap['no_rawatinap'] ?></td>
                            <td><?= $durasi ?> Hari</td>
                            <td><?= $Trawat_inap['tanggal_keluar'] ?></td>
                            <td><?= $Trawat_inap['status'] ?></td>
                            <td><?= $Trawat_inap['no_kamar'] ?></td>
                            <td><?= $kamar['kelas_kamar'] ?></td>
                            <td><?= rupiah($totalBiayaKamar) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="content read">
            <h2>Rekap Medis</h2>
            <!-- <a href="./create.php" class="menu create-dokter" id="tambahDokter">Tambah Data Rawat Inap</a> -->
            <table class="table-responsive">
                <thead class="table">
                    <tr>
                        <td>NO REKAP</td>
                        <td>NAMA DOKTER</td>
                        <td>TANGGAL PERIKSA</td>
                        <td>RIWAYAT PENYAKIT</td>
                        <td>DIAGNOSA</td>
                        <td>TINDAKAN</td>
                        <td>BIAYA TINDAKAN</td>
                        <td>BIAYA REKAP MEDIS</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rawats as $rawat) : ?>
                        <tr>
                            <td><?= $Trekap_medis['no_rekap_medis'] ?></td>
                            <td><?= $dokter['nama_dokter'] ?></td>
                            <td><?= $Trekap_medis['tanggal_periksa'] ?></td>
                            <td><?= $Trekap_medis['riwayat_penyakit'] ?></td>
                            <td><?= $Trekap_medis['diagnose'] ?></td>
                            <td><?= $tindakan['nama_tindakan'] ?></td>
                            <td><?= rupiah($tindakan['biaya']) ?></td>
                            <td><?= rupiah($Trekap_medis['biaya']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <div class="content read">
            <h2>Penggunaan Obat</h2>
            <!-- <a href="./create.php" class="menu create-dokter" id="tambahDokter">Tambah Data Rawat Inap</a> -->
            <table class="table-responsive">
                <thead class="table">
                    <tr>
                        <td>TANGGAL PEMBERIAN OBAT</td>
                        <td>NAMA OBAT</td>
                        <td>JUMLAH</td>
                        <td>HARGA</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pemggunaan_obatAll as $penngobat) : ?>
                        <tr>
                            <td><?= $penngobat['tanggal_pemberian'] ?></td>
                            <td><?= $obat['nm_obat'] ?></td>
                            <td><?= $penngobat['jumlah'] ?></td>
                            <td><?= rupiah($penngobat['harga']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <td>
                        Total Harga
                    </td>
                    <td></td>
                    <td></td>
                    <td><?= rupiah($pemggunaan_obat9['harga']) ?></td>
                </tbody>
            </table>

        </div>

    <?php
}
    ?>