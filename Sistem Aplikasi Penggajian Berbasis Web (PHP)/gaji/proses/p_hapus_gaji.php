<?php 
	include "../conect/crud.php";
	$hapus = $proses->hapus("gaji","gaji.no_slip='$_GET[no_slip]'");
	echo "<script>alert('Berhasil Menghapus Data')</script>";
	echo "<script>document.location='../index.php?p=tam_gaji'</script>";
 ?>