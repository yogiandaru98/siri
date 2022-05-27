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
							<a class="nav-link mr-10 menu " id="keloladokter" href="./read.php"><i class=""></i>Kelola Data Dokter</a>
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
							<a class="nav-link menu" id="penggunaanobat" href="../penggunaanObat/read.php"><i class=""></i>Penggunaan Obat</a>
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
		$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

		$records_per_page = 8;



		$stmt = $pdo->prepare('SELECT * FROM penggunaan_obat ORDER BY id_penggunaan_obat LIMIT :current_page, :record_per_page');
		$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
		$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
		$stmt->execute();

		$Penggunaans = $stmt->fetchAll(PDO::FETCH_ASSOC);



		$num_kamars = $pdo->query('SELECT COUNT(*) FROM penggunaan_obat')->fetchColumn();
		?>

		<div class="content read">
			<h2>Data Penggunaan Obat</h2>
			<a href="./create.php" class="menu create-dokter" id="tambahDokter">Tambah Data Penggunaan Obat</a>
			<table>
				<thead>
					<tr>
						<td>ID</td>
						<td>KODE OBAT</td>
						<td>NO REKAPMEDIS</td>
						<td>TANGGAL PEMBERIAN</td>
						<td>JUMLAH</td>
						<td>HARGA</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($Penggunaans as $penggunaan) : ?>
						<tr>
							<td><?= $penggunaan['id_penggunaan_obat'] ?></td>
							<td><?= $penggunaan['kd_obat'] ?></td>
							<td><?= $penggunaan['no_rekap_medis'] ?></td>
							<td><?= $penggunaan['tanggal_pemberian'] ?></td>
							<td><?= $penggunaan['jumlah'] ?></td>
							<td><?= rupiah($penggunaan['harga']) ?></td>
							<td class="actions">
								<a href="update.php?id_penggunaan_obat=<?= $penggunaan['id_penggunaan_obat'] ?>" class="menu edit" id="edit"><i class="fas fa-pen fa-xs"></i></a>
								<a href="delete.php?id_penggunaan_obat=<?= $penggunaan['id_penggunaan_obat'] ?>" class="menu trash" id="hapus"><i class="fas fa-trash fa-xs"></i></a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="pagination">
				<?php if ($page > 1) : ?>
					<a href="read.php?page=<?= $page - 1 ?>"> <i class="fas fa-angle-double-left fa-sm"></i></a>
				<?php endif; ?>
				<?php if ($page * $records_per_page < $num_kamars) : ?>
					<a href="read.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
				<?php endif; ?>
			</div>
		</div>

	<?php
}
	?>