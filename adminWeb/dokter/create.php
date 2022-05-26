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
							<a class="nav-link mr-10 menu active" id="keloladokter" href="./read.php"><i class=""></i>Kelola Data Dokter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="kelolaakun" href="../akun/read.php"><i class=""></i>Kelola Akun</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="kelolakamar" href="./adminWeb/kamar/read.php"><i class=""></i>Kelola Biaya</a>
						</li>
						<li class="nav-item">
							<a class="nav-link menu" id="inputobat" href="./adminWeb/obat/inputobat.php"><i class=""></i>Input Data Obat</a>
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

		<div id="content">

		</div>
		<script src="assets/js/jquery-3.6.0.min.js"></script>

<?php
include("../../db/func.php");

$pdo = pdo_connect_mysql();
// session_start();
$msg = '';

if (!empty($_POST)) {

    $kd_dokter = isset($_POST['kd_dokter']) && !empty($_POST['kd_dokter']) && $_POST['kd_dokter'] != 'auto' ? $_POST['kd_dokter'] : NULL;

    $akun_id = isset($_POST['akun_id']) && !empty($_POST['akun_id']) && $_POST['akun_id'] != 'auto' ? $_POST['akun_id'] : NULL;
    $nama_dokter = $_POST['nama_dokter'];
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $no_telepon = isset($_POST['no_telepon']) ? $_POST['no_telepon'] : '';
    $resep_dokter = isset($_POST['resep_dokter']) ? $_POST['resep_dokter'] : '';
    $jenis_dokter = isset($_POST['jenis_dokter']) ? $_POST['jenis_dokter'] : '';


    $sqlInsert = "INSERT INTO dokter(kd_dokter, akun_id, nama_dokter, alamat, no_telepon, resep_dokter, jenis_dokter) 
    VALUES('{$kd_dokter}', '{$akun_id}', '{$nama_dokter}', '{$alamat}', '{$no_telepon}', '{$resep_dokter}', '{$jenis_dokter}')";
    $execute = $pdo->query($sqlInsert);

    $msg = header('Location: read.php');
}
?>



<div class="content update">
    <h2>Tambah Dokter</h2>
    <form action="create.php" method="post">
        <!-- <label></label> -->
        <label for="kd_dokter">KODE DOKTER</label>
        <label for="akun_id">ID Akun</label>
        <input type="text" name="kd_dokter" value="auto" id="kd_dokter">
        <input type="text" name="akun_id" value="auto" id="akun_id">
        <label for="nama_dokter">Nama</label>
        <label for="alamat">Alamat</label>
        <input type="text" name="nama_dokter" id="nama_dokter">
        <input type="text" name="alamat" id="alamat">
        <label for="no_telepon">No. Telp</label>
        <label for="resep_dokter">Resep Dokter</label>
        <input type="number" name="no_telepon" id="no_telepon">
        <input type="text" name="resep_dokter" id="resep_dokter">
        <label for="jenis_dokter">Jenis Dokter</label>
        
        <label></label>
        <input type="text" name="jenis_dokter" id="jenis_dokter">
        <label></label>

        <input type="submit" value="Create">
    </form>
</div>
<script>
    
</script>
<?php
}
?>