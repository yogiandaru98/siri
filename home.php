<?php
session_start();
if ($_SESSION['username'] == '') {
  echo "<script>
    alert('Anda Harus Login terlebih dahulu');
    window.location.href='./auth/fmasuk.php';
    </script>";
} else {
    ?>
<div class="text-center ">
	<h2>Hello  <?PHP echo $_SESSION['username'];?> !</h2>
	<p>Selamat datang di home page web SIRI</p>
</div>

<style>
div.text-center {
    margin-top: 200px;
}
</style>
<?php
}
?>