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
							<a class="nav-link menu active" id="kelolamedicalrecord" href="./read.php"><i class=""></i>Kelola Medical Record</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu " id="penggunaanobat" href="../penggunaanObat/read.php"><i class=""></i>Penggunaan Obat</a>
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

		<div id="content">

		</div>
		<script src="assets/js/jquery-3.6.0.min.js"></script>

		<?php
		include("../../db/func.php");

		$pdo = pdo_connect_mysql();
		// session_start();
		$msg = '';

		if (!empty($_POST)) {


			$no_rekap_medis = isset($_POST['no_rekap_medis']) && !empty($_POST['no_rekap_medis']) && $_POST['no_rekap_medis'] != 'auto' ? $_POST['no_rekap_medis'] : NULL;
			$id_pasien =  $_POST['id_pasien'];
			$kd_dokter = $_POST['kd_dokter'] ;
			$kd_tindakan = $_POST['kd_tindakan'];
			$tanggal_periksa = date('Y-m-d', strtotime($_POST['tanggal_periksa']));
			$riwayat_penyakit = $_POST['riwayat_penyakit'];
			$diagnose = $_POST['diagnose'];
			$biaya = '50000';

			$sqlInsert = "INSERT INTO rekap_medis(no_rekap_medis, tanggal_periksa, riwayat_penyakit, diagnose, kd_tindakan, biaya, kd_dokter, id_pasien) 
			VALUES('{$no_rekap_medis}', '{$tanggal_periksa}', '{$riwayat_penyakit}', '{$diagnose}', '{$kd_tindakan}', '{$biaya}', '{$kd_dokter}', '{$id_pasien}')";
// 			$sqlInsert = "INSERT INTO rekap_medis(no_rekap_medis, kd_tindakan,  id_pasien, kd_dokter, tanggal_periksa, diagnose, riwayat_penyakit, biaya)
// VALUES('{$no_rekap_medis}', '{$kd_tindakan}', '{$kd_dokter}', '{$tanggal_periksa}', '{$diagnose}', '{$riwayat_penyakit}', '{$biaya}')";
			$execute = $pdo->query($sqlInsert);

			$msg = header('Location: read.php');
		}
		?>



		<div class="content update">
			<h2>Tambah Data Rekap Medis</h2>
			<form action="create.php" method="post">
				<!-- <label></label> -->
				<label for="no_rekap_medis">NO REKAP MEDIS</label>
				<label for="kd_dokter">KODE DOKTER</label>
				<input type="text" name="no_rekap_medis" value="auto" id="no_rekap_medis">
				<select name="kd_dokter" id="kd_dokter" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT * FROM dokter ORDER BY kd_dokter ASC";
					$data = $pdo->query($sql);
					foreach ($data as $row1) {

						echo "<option value=$row1[kd_dokter] >$row1[kd_dokter] - $row1[nama_dokter]</option>";
					}
					?>
				</select>
				<label for="id_pasien">ID PASIEN</label>
				<label for="kd_tindakan">KODE TINDAKAN</label>
				<select name="id_pasien" id="id_pasien" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT * FROM pasien ORDER BY id_pasien ASC";
					$data = $pdo->query($sql);
					foreach ($data as $row2) {

						echo "<option value=$row2[id_pasien] >$row2[id_pasien]-$row2[nama]</option>";
					}
					?>
				</select>
				<select name="kd_tindakan" id="kd_tindakan" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT * FROM tindakan ORDER BY kd_tindakan ASC";
					$data = $pdo->query($sql);
					foreach ($data as $row3) {

						echo "<option value=$row3[kd_tindakan] >$row3[kd_tindakan]-$row3[nama_tindakan]</option>";
					}
					?>
				</select>
				<label for="tanggal_periksa">TANGGAL PERIKSA</label>
				<label for="riwayat_penyakit">RIWAYAT PENYAKIT</label>

				</select>
				<input type="date" name="tanggal_periksa" id="tanggal_periksa">
				<input type="text" name="riwayat_penyakit" id="riwayat_penyakit">
				<label for="diagnose">DIAGNOSA</label>
				<label></label>
				<input type="text" name="diagnose" id="diagnose">

				<label></label>



				<input type="submit" value="Create">
			</form>
		</div>
		<script>

		</script>
	<?php
}
	?>