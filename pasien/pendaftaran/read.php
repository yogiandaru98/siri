<?php
// include 'db/func.php';


// HOME.PHP

session_start();

if ($_SESSION['id_akun'] == '') {
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
                            <a class="nav-link mr-10 menu" id="keloladokter" href="../dokter/read.php"><i class=""></i>Kelola Data Dokter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu active" id="kelolaakun" href="./read.php"><i class=""></i>Kelola Akun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="kelolakamar" href="./kamar/read.php"><i class=""></i>Kelola Kamar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="inputobat" href="./obat/read.php"><i class=""></i>Kelola Obat</a>
                        </li>

                    <?PHP } ?>


                    <?PHP if ($_SESSION['role_id'] == 2) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu" id="kelolapasien" href="./administrasi/kelolapasien.php"><i class=""></i>Kelola Pendaftaran Pasien</a>
                        </li>
                    <?PHP } ?>

                    <?PHP if ($_SESSION['role_id'] == 1) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu active" id="daftarrawatinap" href="./read.php"><i class=""></i>Pendaftaran Rawat Inap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="bayarrawatinap" href="../pembayaran/read.php"><i class=""></i>Pembayaran Rawat Inap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="daftarakun" href="../rekapMedis/read.php"><i class=""></i>Rekap Medis</a>
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
                            <a class="nav-link menu" id="tindakan" href="./akun/tindakan.php"><i class=""></i>Tindakan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu" id="resepobat" href="./akun/resepobat.php"><i class=""></i>Resep Obat</a>
                        </li>
                    <?PHP } ?>

                    <?PHP if ($_SESSION['role_id'] == 6) { ?>
                        <li class="nav-item">
                            <a class="nav-link menu" id="validasipembayaran" href="./kasir/validasipembayaran.php"><i class=""></i>Validasi Pembayaran</a>
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

        $pdo = pdo_connect_mysql();
        // session_start();
        $msg = '';

        if (!empty($_POST)) {

            $id_akun = isset($_POST['id_akun']) && !empty($_POST['id_akun']) && $_POST['id_akun'] != 'auto' ? $_POST['id_akun'] : NULL;
            $id_pasien = isset($_POST['id_pasien']) && !empty($_POST['id_pasien']) && $_POST['id_pasien'] != 'auto' ? $_POST['id_pasien'] : NULL;

            $jk = isset($_POST['jk']) ? $_POST['jk'] : '';
            $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
            $tgl_lahir = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : '';
            $tanggal_masuk = isset($_POST['tanggal_masuk']) ? $_POST['tanggal_masuk'] : '';
            $pekerjaan = isset($_POST['pekerjaan']) ? $_POST['pekerjaan'] : '';
            $alamat_rumah = isset($_POST['alamat_rumah']) ? $_POST['alamat_rumah'] : '';
            $telepon = isset($_POST['telepon']) ? $_POST['telepon'] : '';
            // $password = password_hash($password, PASSWORD_DEFAULT);
            $umur = getAge($tgl_lahir);
            
            $_SESSION['id_pasien'] = $id_pasien;

            $sqlInsert = "INSERT INTO pasien(id_pasien, akun_id, nama, tgl_lahir, umur, jk, pekerjaan, alamat_rumah, telepon, tanggal_masuk) 
    VALUES('{$id_pasien}', '{$id_akun}', '{$nama}', '{$tgl_lahir}', '{$umur}', '{$jk}', '{$pekerjaan}', '{$alamat_rumah}', '{$telepon}', '{$tanggal_masuk}')";
            $execute = $pdo->query($sqlInsert);

            $msg = header('Location: dataMasuk.php');
        }
        ?>
        <!-- <?php

        //  session_start();
        // $msg = '';

        // if (isset($_SESSION['id_akun'])) {
        //     if (!empty($_SESSION['id_akun'])) {
        //         // $msg .=      
        //         $stmt1 = $pdo->prepare('SELECT * FROM pasien WHERE id_akun = ?');
        //         $stmt1->execute([$_SESSION['id_akun']]);
        //         $akun = $stmt1->fetch(PDO::FETCH_ASSOC);
        //     }

        //     $stmt = $pdo->prepare('SELECT * FROM akun WHERE id_akun = ?');
        //     $stmt->execute([$_GET['id_akun']]);
        //     $akun = $stmt->fetch(PDO::FETCH_ASSOC);
        //     if (!$akun) {
        //         exit('akun doesn\'t exist with that id_akun!');
        //     }
        // } else {
        //     exit('No id_akun specified!');
        // }
        ?> -->



        <div class="content update" id="replace">
            <h2>Pendaftaran Rawat Inap</h2>
            <form action="read.php" method="post">
                <!-- <label></label> -->

                <label for="id_pasien">ID PASIEN</label>
                <label for="id_akun">ID AKUN</label>
                <input type="text" class="form-control" name="id_pasien" value="auto" id="id_pasien" readonly>
                <input type="text" class="form-control" name="id_akun" value="<?= $_SESSION['id_akun'] ?>" id="id_akun" readonly>
                <label for="jk">JENIS KELAMIN</label>
                <label for="nama">NAMA LENGKAP</label>
                <select id="jk" name="jk" class="form-control-select" aria-label="Default select example">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
                <input type="text" name="nama" id="nama">
                <label for="tgl_lahir">TANGGAL LAHIR</label>
                <label for="tanggal_masuk">TANGGAL MASUK</label>
                <input type="date" name="tgl_lahir" id="tgl_lahir">
                <input type="date" name="tanggal_masuk" id="tanggal_masuk">
                <label for="pekerjaan">PEKERJAAN</label>
                <label for="alamat_rumah">ALAMAT</label>
                <input type="text" name="pekerjaan" id="pekerjaan">
                <input type="text" name="alamat_rumah" id="alamat_rumah">
                <label for="telepon">NO TELEPON</label>
                <label></label>
                <!-- <label></label> -->
                <input type="number" name="telepon" id="telepon">
                <label></label>


                <input type="submit" value="Daftar">
            </form>
        </div>
        <?PHP if (isset($_SESSION['id_pasien'])) { ?>
        <script>
                $(document).ready(function() { //
				$('#replace').load('dataMasuk.php');
				// $("h2").hide();

			});
        </script>
        <?PHP } ?>
        <?php
    }
    ?>