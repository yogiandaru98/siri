<nav class="navtop">
    	<div>
    		<h1>Sistem Informasi Rawat Inap</h1>
            <a href=""><i class="fas solid fa-home nav-link active"></i>Home</a>

            <!-- admin web -->
    		<a href=""><i class="fa-solid fa-address-book"></i>Kelola Data Dokter</a>
            <a href=""><i class=""></i>Kelola Akun</a>
            <a href=""><i class=""></i>Input Data Obat</a>

            <!-- administrasi -->
            <a href=""><i class=""></i>Kelola Pendaftaran Pasien</a>

            <!-- pasien  -->
            <a href=""><i class=""></i>Pendaftaran Rawat Inap</a>
            <a href=""><i class=""></i>Pembayaran Rawat Inap</a>
            <a href=""><i class=""></i>Pendaftaran Akun</a>

            <!-- perawat -->
            <a href=""><i class=""></i>Kelola Medical Record</a>
            <a href=""><i class=""></i>Penggunaan Obat</a>

            <!-- dokter -->
            <a href=""><i class=""></i>Tindakan</a>
            <a href=""><i class=""></i>Resep Obat</a>

            <!-- kasir -->
            <a href=""><i class=""></i>Validasi Pembayaran</a>

            <!-- pimpinan puskesmas  -->
            <a href=""><i class=""></i>Cetak Laporan Keuangan</a>
            <a href=""><i class=""></i>Cetak Penggunaan Obat</a>

    	</div>
    </nav>

    // var kd_dokter= '//<?php echo $dokter['kd_dokter'];?>//';
    delete.php?kd_dokter=<?=$dokter['kd_dokter']?>&confirm=yes

    <script>
$(document).ready(function(){ //
    // $('#content').load('adminWeb/dokter/read.php?page=1');
    // $("p").hide();
	$(".menu").on('click',function(){
		 var currentRow=$(this).closest("tr");
		 var col1=currentRow.find("td:eq(0)").html();
		 var col2=currentRow.find("td:eq(1)").html();
		 var col3=currentRow.find("td:eq(2)").html();
		//  var data=col1+"\n"+col2+"\n"+col3;
		//  alert(data);
        $('.menu').click(function(e){ //
            e.preventDefault();
    
            var menu = $(this).attr('id');
    
    
            if(menu == "hapus"){
                // $('.nav-link').removeClass('active');
                // $(this).addClass('active');
                var urldelet="adminWeb/dokter/delete.php?kd_dokter="+col1;
                $('#content').load(urldelet);
    
            }else if(menu == "edit"){
                var urledit="adminWeb/dokter/update.php?kd_dokter="+col1;
                $('#content').load(urledit);
                // $('.nav-link').removeClass('active');
                // $(this).addClass('active');
                // $('#content').load('cart.php');
            }
    
    
        });
	});


	});

    



</script>