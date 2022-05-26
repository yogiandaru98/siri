<?php
 include("../db/func.php");

$pdo = pdo_connect_mysql();
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$role_id   = $_POST['role_id'];

$sqlCek = "SELECT username, password, id_akun, role_id FROM akun WHERE username=:username";
$data = $pdo->prepare($sqlCek);
$data->bindValue(':username', $username);
$data->execute();
$row = $data->fetch(PDO::FETCH_ASSOC);

if(!empty($row)){
    $hash = $row['password'];
    if(password_verify($password, $hash)){
        $_SESSION['username'] = $row['username'];
        $_SESSION['role_id'] = $row['role_id'];
        $_SESSION['id_akun'] = $row['id_akun'];

        

        header("Location: ../index.php");
    }else{
        echo "<script>
        alert('Username atau password salah');
        window.location.href='./fmasuk.php';
        </script>";
    }
}else{
    echo "<script>
    alert('Username atau password salah');
    window.location.href='./fmasuk.php';
    </script>";
}