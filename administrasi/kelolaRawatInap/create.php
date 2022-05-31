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
							<a class="nav-link menu active" id="kelolaakun" href="./read.php"><i class=""></i>Kelola Akun</a>
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

			$no_rawatinap = isset($_POST['no_rawatinap']) && !empty($_POST['no_rawatinap']) && $_POST['no_rawatinap'] != 'auto' ? $_POST['no_rawatinap'] : NULL;
			$no_transaksi = isset($_POST['no_transaksi']) && !empty($_POST['no_transaksi']) && $_POST['no_transaksi'] != 'auto' ? $_POST['no_transaksi'] : NULL;
			$no_rekap_medis = isset($_POST['no_rekap_medis']) ? $_POST['no_rekap_medis'] : '';

			$tanggal_keluar = date('Y-m-d', strtotime($_POST['tanggal_keluar']));
			$status = isset($_POST['status']) ? $_POST['status'] : '';
			$no_kamar = isset($_POST['no_kamar']) ? $_POST['no_kamar'] : '';

			$stmt2 = $pdo->prepare('SELECT * FROM rekap_medis WHERE no_rekap_medis = ?');
			$stmt2->execute([$no_rekap_medis]);
			$rekap_medis = $stmt2->fetch(PDO::FETCH_ASSOC);

			$stmt3 = $pdo->prepare('SELECT * FROM pasien WHERE id_pasien = ?');
			$stmt3->execute([$rekap_medis['id_pasien']]);
			$pasien = $stmt3->fetch(PDO::FETCH_ASSOC);

			$stmt4 = $pdo->prepare('SELECT * FROM tindakan WHERE kd_tindakan = ?');
			$stmt4->execute([$rekap_medis['kd_tindakan']]);
			$tindakan = $stmt4->fetch(PDO::FETCH_ASSOC);

			$stmt5 = $pdo->prepare('SELECT SUM(harga) as harga FROM penggunaan_obat WHERE no_rekap_medis = ?');
			$stmt5->execute([$no_rekap_medis]);
			$penggunaan_obat = $stmt5->fetch(PDO::FETCH_ASSOC);

			$stmt7 = $pdo->prepare('SELECT * FROM kamar WHERE no_kamar = ?');
			$stmt7->execute([$no_kamar]);
			$kamar = $stmt7->fetch(PDO::FETCH_ASSOC);
			
			$stmt6 = $pdo->prepare('UPDATE kamar SET status = "TIDAK" WHERE no_kamar = ?');
			$stmt6->execute([$no_kamar]);
			// $penggunaan_obat = $stmt5->fetch(PDO::FETCH_ASSOC);



			$sqlInsert = "INSERT INTO rawat_inap(no_rawatinap, no_rekap_medis, id_pasien, no_kamar, tanggal_masuk, tanggal_keluar, status, biaya_obat, biaya_tindakan, biaya_kamar)
    VALUES('{$no_rawatinap}', '{$no_rekap_medis}', '{$rekap_medis['id_pasien']}', '{$no_kamar}', '{$pasien['tanggal_masuk']}','{$tanggal_keluar}', '{$status}', '{$penggunaan_obat['harga']}','{$tindakan['biaya']}','{$kamar['harga_kamar']}')";
			$execute = $pdo->query($sqlInsert);

			$stmt9 = $pdo->prepare('SELECT * FROM rawat_inap WHERE id_pasien = ?');
			$stmt9->execute([$rekap_medis['id_pasien']]);
			$rawatinap = $stmt9->fetch(PDO::FETCH_ASSOC);
			$totalKamar = dateDiffInDays($tanggal_keluar, $pasien['tanggal_masuk']) * $kamar['harga_kamar'];
			$totalBiaya = $penggunaan_obat['harga']+$tindakan['biaya']+$totalKamar+$rekap_medis['biaya'];
			$statusPembayaran = "Belum";
			$sqlInsertTotal= "INSERT INTO keuangan(periode_transaksi, total_biaya, statusPembayaran, no_rawatinap, no_transaksi)
			VALUES('{$pasien['tanggal_masuk']}','{$totalBiaya}' , '{$statusPembayaran}', '{$rawatinap['no_rawatinap']}', '{$no_transaksi}')";
			$execute2 = $pdo->query($sqlInsertTotal);

			$msg = header('Location: read.php');
		}
		?>



		<div class="content update">
			<h2>Tambah Data Rawat Inap</h2>
			<form action="create.php" method="post">
				<!-- <label></label> -->
				<label for="no_rawatinap">NO RAWAT INAP</label>
				<label for="no_rekap_medis">NO REKAP MEDIS</label>
				<input type="text" name="no_rawatinap" value="auto" id="no_rawatinap">
				<input type="text" name="no_transaksi" value="auto" id="no_transaksi" hidden>
				<select name="no_rekap_medis" id="no_rekap_medis" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;
    margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT rekap_medis.no_rekap_medis, pasien.nama FROM rekap_medis LEFT JOIN pasien ON rekap_medis.id_pasien=pasien.id_pasien ORDER BY rekap_medis.no_rekap_medis ASC";
					$data = $pdo->query($sql);
					foreach ($data as $row) {
						echo "<option value=$row[no_rekap_medis]>$row[no_rekap_medis] - $row[nama] </option>";
					}
					?>

				</select>
				<label for="no_kamar">NO KAMAR</label>
				<label for="tanggal_keluar">TANGGAL KELUAR</label>

				<select name="no_kamar" id="no_kamar" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;
    margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT * FROM kamar WHERE status = 'TERSEDIA' ORDER BY no_kamar ASC";
					$data2 = $pdo->query($sql);
					foreach ($data2 as $row2) {
						$harga_kamar = rupiah($row2['harga_kamar']);
						echo "<option value=$row2[no_kamar]>$row2[no_kamar] - $row2[kelas_kamar] - $harga_kamar</option>";
					}
					?>

				</select>

				<input type="date" name="tanggal_keluar" id="tanggal_keluar">
				<label for="status">STATUS</label>
				<label></label>
				<select name="status" id="status" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;
    margin-bottom: 15px;">
				<option value="Kritis">Kritis</option>
				<option value="Stabil">Stabil</option>
				
			</select>
			<label></label>

				<input type="submit" value="Create">
			</form>
		</div>
		<div class="content update1" id="kamar">

		</div>
		<script src="../../assets/js/jquery-3.6.0.min.js"></script>
		<script>
			$(document).ready(function() { //
				$('#kamar').load('kamar.php');
				// $("h2").hide();

			});
		</script>
	<?php
}
	?>