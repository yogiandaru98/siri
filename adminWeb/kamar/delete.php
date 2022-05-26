
<?php
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
							<a class="nav-link mr-10 menu " id="keloladokter" href="./read.php"><i class=""></i>Kelola Data Dokter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu active" id="kelolaakun" href="../akun/read.php"><i class=""></i>Kelola Akun</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu active" id="kelolakamar" href="./adminWeb/kamar/kelolakamar.php"><i class=""></i>Kelola kamar</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="inputobat" href="./inputobat.php"><i class=""></i>Input Data Obat</a>
						</li>

					<?PHP } ?>


					<?PHP if ($_SESSION['role_id'] == 2) { ?>
						<li class="nav-item">
							<a class="nav-link menu" id="kelolapasien" href="./administrasi/kelolapasien.php"><i class=""></i>Kelola Pendaftaran Pasien</a>
						</li>
					<?PHP } ?>

					<?PHP if ($_SESSION['role_id'] == 1) { ?>
						<li class="nav-item">
							<a class="nav-link menu" id="daftarrawatinap" href="./pasien/daftarrawatinap.php"><i class=""></i>Pendaftaran Rawat Inap</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="bayarrawatinap" href="./pasien/bayarrawatinap.php"><i class=""></i>Pembayaran Rawat Inap</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="daftarakun" href="./pasien/daftarakun.php"><i class=""></i>Pendaftaran Akun</a>
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
							<a class="nav-link menu" id="tindakan" href="./dokter/tindakan.php"><i class=""></i>Tindakan</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="resepobat" href="./dokter/resepobat.php"><i class=""></i>Resep Obat</a>
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
						<a class="nav-link menu" id="logout" href="./auth/sLogout.php"><i class=""></i>Logout</a>
					</li>
				</ul>
			</div>
		</nav>
<?php
 include("../../db/func.php");
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['kd_dokter'])) {

    $stmt = $pdo->prepare('SELECT * FROM dokter WHERE kd_dokter = ?');
    $stmt->execute([$_GET['kd_dokter']]);
    $dokter = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$dokter) {
        exit('Dokter doesn\'t exist with that kd_dokter!');
    }

    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {

            $stmt = $pdo->prepare('DELETE FROM dokter WHERE kd_dokter = ?');
            $stmt->execute([$_GET['kd_dokter']]);
            // header("Refresh:0");
            header('Location: ./read.php');
            // $msg = header('Location: index.php');
        } else {

            // header('Location: ../../index.php');
            exit;
        }
    }
} else {
    exit('No kd_dokter specified!');
}
?>


<!--  -->

<div class="content delete">
	<h2>Delete Dokter #<?=$dokter['kd_dokter']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Anda yakin ingin menghapus dokter <?=$dokter['nama_dokter']?>?</p>
    <div class="yesno">
    <a  href="delete.php?kd_dokter=<?=$dokter['kd_dokter']?>&confirm=yes">Yes</a>
    <a href="delete.php?kd_dokter=<?=$dokter['kd_dokter']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>
<?php
} ?>