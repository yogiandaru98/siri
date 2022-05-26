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
							<a class="nav-link mr-10 menu " id="keloladokter" href="../dokter/read.php"><i class=""></i>Kelola Data Dokter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" id="kelolaakun" href="./read.php"><i class=""></i>Kelola Akun</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="kelolabiaya" href="../biaya/read.php"><i class=""></i>Kelola Biaya</a>
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
						<a class="nav-link menu" id="logout" href=../../auth/sLogout.php"><i class=""></i>Logout</a>
					</li>
				</ul>
			</div>
		</nav>
		<?php

		include("../../db/func.php");

		$pdo = pdo_connect_mysql();
		//  session_start();
		$msg = '';

		if (isset($_GET['id_akun'])) {
			if (!empty($_POST)) {
				$id_akun = isset($_POST['id_akun']) && !empty($_POST['id_akun']) && $_POST['id_akun'] != 'auto' ? $_POST['id_akun'] : NULL;

				$username = isset($_POST['username']) ? $_POST['username'] : '';
				$password = isset($_POST['password']) ? $_POST['password'] : '';
				$role_id = isset($_POST['role_id']) ? $_POST['role_id'] : '';
				$password = password_hash($password, PASSWORD_DEFAULT);


				$stmt = $pdo->prepare('UPDATE akun SET id_akun = ?, username = ?, password = ?, role_id = ? WHERE id_akun = ?');
				$stmt->execute([$id_akun, $username, $password, $role_id, $_GET['id_akun']]);
				$msg = header('Location: ./read.php');;
			}

			$stmt = $pdo->prepare('SELECT * FROM akun WHERE id_akun = ?');
			$stmt->execute([$_GET['id_akun']]);
			$akun = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!$akun) {
				exit('akun doesn\'t exist with that id_akun!');
			}
		} else {
			exit('No id_akun specified!');
		}
		?>


		<div class="content update">
			<h2>Update Akun</h2>
			<form action="./update.php?id_akun=<?= $akun['id_akun'] ?>" method="post">
				<label for="id_akun">ID AKUN</label>
				<!-- <label for="akun_id">ID Akun</label> -->
				<label for="username">USERNAME</label>
				<input type="text" name="id_akun" value="<?= $akun['id_akun'] ?>" id="id_akun">

				<input type="text" name="username" value="<?= $akun['username'] ?>" id="username">
				<label>ROLE</label>
				<label for="password">PASSWORD</label>
				<select name="role_id" id="role_id" class="form-select" aria-label="Default select example" style="width: 400px;margin-right: 25px;margin-bottom: 15px;">
					<?php

					include("../db/func.php");
					$pdo = pdo_connect_mysql();
					// $msg = '';
					$sql = "SELECT * FROM roles ORDER BY id_role ASC";
					$data = $pdo->query($sql);
					foreach ($data as $row) {
						if ($row['id_role'] == $akun['role_id']) {
							echo "<option selected='selected' value=$akun[role_id] >$akun[role_id]-$row[role_name]</option>";
						} else {
							echo "<option value=$row[id_role] >$row[id_role]-$row[role_name]</option>";
						}
					}
					?>

				</select>
				<input type="password" name="password" value="<?= $akun['password'] ?>" id="password">
				<label></label>

				<label></label>
				<input onclick="myFunction()" type="submit" value="Update">
			</form>

		</div>
	<?PHP
}
	?>