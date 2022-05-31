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
							<a class="nav-link menu" id="inputrawa$rawatInap" href="./adminWeb/rawa$rawatInap/inputrawa$rawatInap.php"><i class=""></i>Input Data rawa$rawatInap</a>
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
							<a class="nav-link menu" id="daftarpasien" href="./pasien/daftarpasien.php"><i class=""></i>Pendaftaran pasien</a>
						</li>
					<?PHP } ?>

					<?PHP if ($_SESSION['role_id'] == 4) { ?>
						<li class="nav-item">
							<a class="nav-link menu" id="kelolamedicalrecord" href="./perawat/kelolamedicalrecord.php"><i class=""></i>Kelola Medical Record</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="penggunaanrawa$rawatInap" href="./perawat/penggunaanrawa$rawatInap.php"><i class=""></i>Penggunaan rawa$rawatInap</a>
						</li>
					<?PHP } ?>

					<?PHP if ($_SESSION['role_id'] == 5) { ?>
						<li class="nav-item">
							<a class="nav-link menu" id="tindakan" href="./pasien/tindakan.php"><i class=""></i>Tindakan</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="reseprawa$rawatInap" href="./pasien/reseprawa$rawatInap.php"><i class=""></i>Resep rawa$rawatInap</a>
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
							<a class="nav-link menu" id="cetakrawa$rawatInap" href="./pimpinan/cetakrawa$rawatInap.php"><i class=""></i>Cetak Penggunaan rawa$rawatInap</a>
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
		//  session_start();
		$msg = '';

		if (isset($_GET['no_rawatinap'])) {
			if (!empty($_POST)) {
				$no_rawatinap = isset($_POST['no_rawatinap']) && !empty($_POST['no_rawatinap']) && $_POST['no_rawatinap'] != 'auto' ? $_POST['no_rawatinap'] : NULL;
				$no_rekap_medis = isset($_POST['no_rekap_medis']) ? $_POST['no_rekap_medis'] : '';

				$tanggal_keluar = date('Y-m-d', strtotime($_POST['tanggal_keluar']));
				$status = isset($_POST['status']) ? $_POST['status'] : '';
				$no_kamar = isset($_POST['no_kamar']) ? $_POST['no_kamar'] : '';
				$no_kamar2 = isset($_POST['no_kamar2']) ? $_POST['no_kamar2'] : '';

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


				$stmt6 = $pdo->prepare('UPDATE kamar SET status = "TERSEDIA" WHERE no_kamar = ?');
				$stmt6->execute([$no_kamar2]);

				$stmt8 = $pdo->prepare('UPDATE kamar SET status = "TIDAK" WHERE no_kamar = ?');
				$stmt8->execute([$no_kamar]);


				$stmt = $pdo->prepare('UPDATE rawat_inap SET no_rawatinap = ?, no_rekap_medis = ?, id_pasien = ?, no_kamar = ?, tanggal_keluar = ?, status = ?, biaya_obat = ?, biaya_tindakan = ?, biaya_kamar = ? WHERE no_rawatinap = ?');
				$stmt->execute([$no_rawatinap, $no_rekap_medis, $rekap_medis['id_pasien'], $no_kamar, $tanggal_keluar, $status, $penggunaan_obat['harga'], $tindakan['biaya'], $kamar['harga_kamar'], $_GET['no_rawatinap']]);
				$msg = header('Location: ./read.php');
				$totalKamar = dateDiffInDays($tanggal_keluar, $pasien['tanggal_masuk']) * $kamar['harga_kamar'];
				$totalBiaya = $penggunaan_obat['harga']+$tindakan['biaya']+$totalKamar;

				$stmt = $pdo->prepare('UPDATE keuangan SET periode_transaksi = ?, total_biaya = ? WHERE no_rawatinap = ?');
				$stmt->execute([$tanggal_keluar, $totalBiaya, $_GET['no_rawatinap']]);
				$msg = header('Location: ./read.php');
			}

			$stmt = $pdo->prepare('SELECT * FROM rawat_inap WHERE no_rawatinap = ?');
			$stmt->execute([$_GET['no_rawatinap']]);
			$rawatInap = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!$rawatInap) {
				exit('rawatInap doesn\'t exist with that no_rawatinap!');
			}
		} else {
			exit('No no_rawatinap specified!');
		}
		?>


		<div class="content update">
			<h2>Update Data Rawat Inap</h2>
			<form action="./update.php?no_rawatinap=<?= $rawatInap['no_rawatinap'] ?>" method="post">
				<label for="no_rawatinap">NO RAWAT INAP</label>
				<label for="no_rekap_medis">NO REKAP MEDIS</label>
				<input type="text" name="no_rawatinap" value="<?= $rawatInap['no_rawatinap'] ?>" id="no_rawatinap">
				<select name="no_rekap_medis" id="no_rekap_medis" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;
    margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT rekap_medis.no_rekap_medis, pasien.nama FROM rekap_medis LEFT JOIN pasien ON rekap_medis.id_pasien=pasien.id_pasien ORDER BY rekap_medis.no_rekap_medis ASC";
					$data = $pdo->query($sql);
					foreach ($data as $row) {
						if ($rawatInap['no_rekap_medis'] == $row['no_rekap_medis']) {

							echo "<option selected='selected' value=$row[no_rekap_medis] >$row[no_rekap_medis] - $row[nama] </option>";
						} else {
							echo "<option value=$row[no_rekap_medis]>$row[no_rekap_medis] - $row[nama] </option>";
						}
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
					$sql = "SELECT * FROM kamar ORDER BY no_kamar ASC";
					$data2 = $pdo->query($sql);
					$sql3 = "SELECT * FROM kamar WHERE status = 'TERSEDIA' ORDER BY no_kamar ASC";
					$data3 = $pdo->query($sql3);
					foreach ($data2 as $row2) {
						$harga_kamar = rupiah($row2['harga_kamar']);
						if ($rawatInap['no_kamar'] == $row2['no_kamar']) {
							echo "<option selected='selected' value=$row2[no_kamar]>$row2[no_kamar] - $row2[kelas_kamar] - $harga_kamar</option>";
							
						} else{
							foreach ($data3 as $row3){
								echo "<option value=$row3[no_kamar]>$row3[no_kamar] - $row3[kelas_kamar] - $harga_kamar</option>";
							}
						}
					}
					?>

				</select>
				<input type="text" name="no_kamar2" value="<?= $rawatInap['no_kamar'] ?>" id="no_kamar2" readonly hidden>
				<input type="date" name="tanggal_keluar" id="tanggal_keluar" value="<?= $rawatInap['tanggal_keluar'] ?>">
				<label for="status">STATUS</label>
				<label></label>
				<select name="status" id="status" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;
				margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT * FROM rawat_inap ORDER BY no_rawatinap ASC";
					$data2 = $pdo->query($sql);
					foreach ($data2 as $row2) {
						// $harga_kamar = rupiah($row2['harga_kamar']);
						if ($rawatInap['no_rawatinap'] == $row['no_rawatinap']) {

							echo "<option selected='selected' value=$row2[status]>$row2[status]</option>";
						} else {

							echo "<option value=$row2[status]>$row2[status]</option>";
						}
					}
					?>

				</select>

				<label></label>
				<input onclick="myFunction()" type="submit" value="Update">
			</form>

		</div>
	<?PHP
}
	?>