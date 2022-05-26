<?php
 include("../db/func.php");

$pdo = pdo_connect_mysql();
$username = $_POST['username'];
$password = $_POST['password'];
$role_id = $_POST['role_id'];
$password = password_hash($password, PASSWORD_DEFAULT);

$sqlInsert = "INSERT INTO akun(username, password, role_id) 
              VALUES('{$username}', '{$password}', '{$role_id}')";
$execute = $pdo->query($sqlInsert);

if(!$execute){
    echo "Gagal";
}else{
    echo "<script>
          alert('Anda Telah Terdaftar');
          window.location.href='./fmasuk.php';
          </script>";
}
