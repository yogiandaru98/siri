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
							<a class="nav-link menu active" id="kelolakamar" href="./read.php"><i class=""></i>Kelola kamar</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="inputobat" href="../obat/read.php"><i class=""></i>Kelola Obat</a>
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

		if (isset($_GET['no_kamar'])) {
			if (!empty($_POST)) {

				$no_kamar = isset($_POST['no_kamar']) && !empty($_POST['no_kamar']) && $_POST['no_kamar'] != 'auto' ? $_POST['no_kamar'] : NULL;

				$kelas_kamar = isset($_POST['kelas_kamar']) && !empty($_POST['kelas_kamar']) && $_POST['kelas_kamar'] != 'auto' ? $_POST['kelas_kamar'] : NULL;
				$harga_kamar = $_POST['harga_kamar'];
				$status = isset($_POST['status']) ? $_POST['status'] : '';

				$stmt = $pdo->prepare('UPDATE kamar SET no_kamar = ?, kelas_kamar = ?, harga_kamar = ?, status = ? WHERE no_kamar = ?');
				$stmt->execute([$no_kamar, $kelas_kamar, $harga_kamar, $status, $_GET['no_kamar']]);
				$msg = header('Location: ./read.php');;
			}

			$stmt = $pdo->prepare('SELECT * FROM kamar WHERE no_kamar = ?');
			$stmt->execute([$_GET['no_kamar']]);
			$kamar = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!$kamar) {
				exit('dokter doesn\'t exist with that no_kamar!');
			}
		} else {
			exit('No no_kamar specified!');
		}
		?>


		<div class="content update">
			<h2>Update Kamar</h2>
			<form action="./update.php?no_kamar=<?= $kamar['no_kamar'] ?>" method="post">
				<label for="no_kamar">NO KAMAR</label>
				<label for="kelas_kamar">KELAS KAMAR</label>
				<input type="text" name="no_kamar" value="<?= $kamar['no_kamar'] ?>" id="no_kamar">
				<input type="text" name="kelas_kamar" value="<?= $kamar['kelas_kamar'] ?>" id="kelas_kamar">
				<label for="harga_kamar">Nama Dokter</label>
				<label for="status">KETERSEDIAAN</label>
				<input type="text" name="harga_kamar" value="<?= $kamar['harga_kamar'] ?>" id="harga_kamar">
				<select name="status" id="status" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;
    margin-bottom: 15px;">

					<?php
					if ($kamar['status']=="TERSEDIA"){
						echo "<option selected='selected' value=$kamar[status]>$kamar[status]</option>";
						echo "<option value='TIDAK'>TIDAK</option>";
					}else{
						echo "<option value='TERSEDIA'>TERSEDIA</option>";
						echo "<option selected='selected' value=$kamar[status]>$kamar[status]</option>";						
					}

					?>

				</select>
				<label></label>
				<label></label>
				<input onclick="myFunction()" type="submit" value="Update">
			</form>

		</div>
	<?PHP
}
	?>