<?php

?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="./auth.css">
  </head>
  <body>
    <div class="center">
      <h1>SIRI</h1>
      <div id="form">

      </div>

      <div class="menu signup_link signup" id="signup">
          Belum punya akun? <a href="fDaftarAkun.php">Daftar Akun Pasien</a>
      </div>
      <div class="menu signup_link login" id="login">
          sudah punya akun? <a href="fLogin.php">Login</a>
      </div>
    </div>

  </body>

  <script type="text/javascript">


$(document).ready(function(){ //
  $('#form').load('flogin.php');
  $('.login').hide();

  $('.menu').click(function(e){ //
    e.preventDefault();

    var menu = $(this).attr('id');

    if(menu == "login"){
      $('.signup').show();
      $('.login').hide();
      // $(this).addClass('active');
      $('#form').load('fLogin.php');

    }else if(menu == "signup"){
      $('.login').show();
      $('.signup').hide();
      // $(this).addClass('active');
      $('#form').load('fDaftarAkun.php');
    }


  })

});

</script>
</html>

