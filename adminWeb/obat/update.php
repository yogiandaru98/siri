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
							<a class="nav-link mr-10 menu" id="keloladokter" href="../dokter/read.php"><i class=""></i>Kelola Data Dokter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="kelolaakun" href="../akun/read.php"><i class=""></i>Kelola Akun</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="kelolakamar" href="../kamar/read.php"><i class=""></i>Kelola Kamar</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu active" id="inputobat" href="./read.php"><i class=""></i>Kelola Obat</a>
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
						<a class="nav-link menu" id="logout" href="../../auth/sLogout.php"><i class=""></i>Logout</a>
					</li>
				</ul>
			</div>
		</nav>
		<?php

		include("../../db/func.php");

		$pdo = pdo_connect_mysql();
		//  session_start();
		$msg = '';

		if (isset($_GET['kd_obat'])) {
			if (!empty($_POST)) {

				$kd_obat = isset($_POST['kd_obat']) && !empty($_POST['kd_obat']) && $_POST['kd_obat'] != 'auto' ? $_POST['kd_obat'] : NULL;

				$nm_obat = isset($_POST['nm_obat']) && !empty($_POST['nm_obat']) && $_POST['nm_obat'] != 'auto' ? $_POST['nm_obat'] : '';
				$satuan = isset($_POST['satuan']) && !empty($_POST['satuan']) && $_POST['satuan'] != 'auto' ? $_POST['satuan'] : '';
				$stok = isset($_POST['stok']) ? $_POST['stok'] : '';
				$harga = $_POST['harga'];

				$stmt = $pdo->prepare('UPDATE obat SET kd_obat = ?, nm_obat = ?, harga = ?, stok = ?, satuan = ? WHERE kd_obat = ?');
				$stmt->execute([$kd_obat, $nm_obat, $harga, $stok, $satuan, $_GET['kd_obat']]);
				$msg = header('Location: ./read.php');;
			}

			$stmt = $pdo->prepare('SELECT * FROM obat WHERE kd_obat = ?');
			$stmt->execute([$_GET['kd_obat']]);
			$obat = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!$obat) {
				exit('dokter doesn\'t exist with that kd_obat!');
			}
		} else {
			exit('No kd_obat specified!');
		}
		?>


		<div class="content update">
			<h2>Update Kamar</h2>
			<form action="./update.php?kd_obat=<?= $obat['kd_obat'] ?>" method="post">
			<label for="kd_obat">KODE OBAT</label>
				<label for="nm_obat">NAMA OBAT</label>
				<input type="text" name="kd_obat" value="<?= $obat['kd_obat'] ?>" id="kd_obat">
				<input type="text" name="nm_obat" value="<?= $obat['nm_obat'] ?>" id="nm_obat">
				<label for="stok">STOK</label>
				<label for="harga">HARGA SATUAN OBAT</label>
				<input type="text" name="stok" value="<?= $obat['stok'] ?>" id="stok">
				<input type="text" name="harga" value="<?= $obat['harga'] ?>" id="harga">
				<label for="stok">SATUAN</label>
				<label></label>
				<input type="text" name="satuan" id="satuan" value="<?= $obat['satuan'] ?>">
				<label></label>
				<input onclick="myFunction()" type="submit" value="Update">
			</form>

		</div>
	<?PHP
}
	?>