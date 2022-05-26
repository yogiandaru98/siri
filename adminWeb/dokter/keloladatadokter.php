<?php
session_start();

if ($_SESSION['username'] == '') {
    echo "<script>
    alert('Anda Harus Login terlebih dahulu');
    window.location.href='./auth/fmasuk.php';
    </script>";
} else {

?>
    <div id="contents">
        <p>yogi</p>

    </div>
    <!-- <script type="text/javascript" src="../../assets/js/jquery-3.6.0.min.js"></script> -->
    <script>
        $(document).ready(function() { //
            $('#contents').load('adminWeb/dokter/read.php');
            // $("h2").hide();


            // $('.menu').click(function(e) { //
            //     e.preventDefault();

            //     var menu = $(this).attr('id');
            //     switch (menu) {
            //         case "tambahDokter":
            //             // $('.nav-link').removeClass('active');
            //             // $(this).addClass('active');
            //             $('#contents').load('adminWeb/dokter/create.php');
            //     }
            //     if (menu == "menuHome") {
            //         $('.nav-link').removeClass('active');
            //         $(this).addClass('active');
            //         $('#content').load('home.php');

            //     } else if (menu == "menuCart") {
            //         $('.nav-link').removeClass('active');
            //         $(this).addClass('active');
            //         $('#content').load('cart.php');
            //     }


            // })

        });
    </script>
<?php
}
?>