<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'siri';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	
    	exit('DATABASE CONNECTION FAILED: ' . $exception->getMessage());
    }
}
function rupiah($angka){
    $hasil = "Rp" . number_format($angka, '2', ',', '.');
    return $hasil;
}
function getAge($dob){
    $bday = new DateTime($dob);
    $today = new Datetime(date('m.d.y'));
    if($bday>$today){
      return '0';
    }
    $diff = $today->diff($bday);
    return $diff->y;
  }
function dateDiffInDays($date1, $date2) 
{
    // Calculating the difference in timestamps
    $diff = strtotime($date2) - strtotime($date1);

    // 1 day = 24 hours
    // 24 * 60 * 60 = 86400 seconds
    return abs(round($diff / 86400));
}

function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="./db/style.css" rel="stylesheet" type="text/css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
		<script src="https://kit.fontawesome.com/9aeb2c70f0.js" crossorigin="anonymous"></script>
        
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Sistem Informasi Rawat Inap</h1>
            <a href=""><i class="fas solid fa-home"></i>Home</a>

    		<a href=""><i class="fa-solid fa-address-book"></i>Kelola Data Dokter</a>
            <a href=""><i class=""></i>Kelola Akun</a>
            <a href=""><i class=""></i>Input Data Obat</a>

            <a href=""><i class=""></i>Kelola Pendaftaran Pasien</a>

            <a href=""><i class=""></i>Pendaftaran Rawat Inap</a>
            <a href=""><i class=""></i>Pembayaran Rawat Inap</a>
            <a href=""><i class=""></i>Pendaftaran Akun</a>

            <a href=""><i class=""></i>Kelola Medical Record</a>
            <a href=""><i class=""></i>Penggunaan Obat</a>

            <a href=""><i class=""></i>Tindakan</a>
            <a href=""><i class=""></i>Resep Obat</a>

            <a href=""><i class=""></i>Validasi Pembayaran</a>

            <a href=""><i class=""></i>Cetak Laporan Keuangan</a>
            <a href=""><i class=""></i>Cetak Penggunaan Obat</a>
    	</div>
    </nav>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>