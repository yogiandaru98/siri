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
							<a class="nav-link menu " id="inputobat" href="./read.php"><i class=""></i>Kelola Obat</a>
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
							<a class="nav-link menu" id="kelolamedicalrecord" href="../rekapmedis/read.php"><i class=""></i>Kelola Medical Record</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu active" id="penggunaanobat" href="./read.php"><i class=""></i>Penggunaan Obat</a>
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

		if (isset($_GET['id_penggunaan_obat'])) {
			if (!empty($_POST)) {

				$id_penggunaan_obat = isset($_POST['id_penggunaan_obat']) && !empty($_POST['id_penggunaan_obat']) && $_POST['id_penggunaan_obat'] != 'auto' ? $_POST['id_penggunaan_obat'] : NULL;

				$kd_obat = isset($_POST['kd_obat']) && !empty($_POST['kd_obat']) && $_POST['kd_obat'] != 'auto' ? $_POST['kd_obat'] : '';
				$jumlah = isset($_POST['jumlah']) && !empty($_POST['jumlah']) && $_POST['jumlah'] != 'auto' ? $_POST['jumlah'] : '';
				$no_rekap_medis = isset($_POST['no_rekap_medis']) ? $_POST['no_rekap_medis'] : '';
				
				$stmt1 = $pdo->prepare('SELECT * FROM obat WHERE kd_obat = ?');
				$stmt1->execute([$kd_obat]);
				$obat = $stmt1->fetch(PDO::FETCH_ASSOC);
				$hargaSatuan = $obat['harga'];
				$harga = $jumlah * $hargaSatuan;
				// $harga = $_POST['harga'];
				$stmt1 = $pdo->prepare('SELECT * FROM penggunaan_obat WHERE kd_obat = ?');
				$stmt1->execute([$kd_obat]);
				$be_jumlah = $stmt1->fetch(PDO::FETCH_ASSOC);

				$stmt2 = $pdo->prepare('UPDATE obat SET stok = stok + ? WHERE kd_obat = ?');
				$stmt2->execute([$be_jumlah['jumlah'], $kd_obat]);

				
				$stmt = $pdo->prepare('UPDATE penggunaan_obat SET id_penggunaan_obat = ?, kd_obat = ?, harga = ?, no_rekap_medis = ?, jumlah = ? WHERE id_penggunaan_obat = ?');
				$stmt->execute([$id_penggunaan_obat, $kd_obat, $harga, $no_rekap_medis, $jumlah, $_GET['id_penggunaan_obat']]);
				$stmt3 = $pdo->prepare('UPDATE obat SET stok = stok - ? WHERE kd_obat = ?');
				$stmt3->execute([$jumlah, $kd_obat]);
				$msg = header('Location: ./read.php');;
			}

			$stmt = $pdo->prepare('SELECT * FROM penggunaan_obat WHERE id_penggunaan_obat = ?');
			$stmt->execute([$_GET['id_penggunaan_obat']]);
			$obat = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!$obat) {
				exit('dokter doesn\'t exist with that id_penggunaan_obat!');
			}
		} else {
			exit('No id_penggunaan_obat specified!');
		}
		?>


		<div class="content update">
			<h2>Update Kamar</h2>
			<form action="./update.php?id_penggunaan_obat=<?= $obat['id_penggunaan_obat'] ?>" method="post">
			<label for="id_penggunaan">ID PENGGUNAAN</label>
				<label for="kd_obat">KODE OBAT</label>
				<input type="text" name="id_penggunaan_obat" value="<?= $obat['id_penggunaan_obat'] ?>" id="id_penggunaan_obat">
				<select name="kd_obat" id="kd_obat" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT * FROM obat ORDER BY kd_obat ASC";
					$data = $pdo->query($sql);
					foreach ($data as $row) {
						if($obat['kd_obat'] ==$row['kd_obat']){

							echo "<option selected='selected' value=$row[kd_obat] >$row[kd_obat]-$row[nm_obat]</option>";
						}else{
							
							echo "<option value=$row[kd_obat] >$row[kd_obat]-$row[nm_obat]</option>";
						}
					}
					?>
				</select>

				<label for="no_rekap_medis">NO REKAP MEDIS</label>
				<label for="tanggal_pemberian">TANGGAL PEMBERIAN</label>
				<select name="no_rekap_medis" id="no_rekap_medis" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;margin-bottom: 15px;">
				<?php
				$sql2 = "SELECT * FROM rekap_medis ORDER BY no_rekap_medis ASC";
				$date2 = $pdo->query($sql2);
				foreach ($date2 as $row2) {
					if ($row2['no_rekap_medis']==$obat['no_rekap_medis']) {
						# code...
						
						echo "<option selected='selected' value=$row2[no_rekap_medis]> $row2[no_rekap_medis]</option>";
					}else{

						echo "<option value=$row2[no_rekap_medis]> $row2[no_rekap_medis]</option>";
					}
				}
				?>
				</select>
				<input type="date" name="tanggal_pemberian" id="tanggal_pemberian" value="<?= $obat['tanggal_pemberian'] ?>">
				<label for="no_rekap_medis">JUMLAH</label>
				<label></label>
				<input type="text" name="jumlah" id="jumlah" value="<?= $obat['jumlah'] ?>">
				<label></label>
				<input onclick="myFunction()" type="submit" value="Update">
			</form>

		</div>
	<?PHP
}
	?>