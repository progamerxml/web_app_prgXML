<?php 
	session_start();
	include '../conect/crud.php';
	$simpan = $proses->simpan("gaji","'$_POST[no_slip]',
											'$_POST[tgl]',
											'$_POST[pendapatan]',
											'$_POST[potongan]',
											'$_POST[gaji_bersih]',
											'$_POST[nip]',
											'$_POST[tun_anak]',
											'$_POST[kode_petugas]'");
	echo "<script>document.location='../index.php?p=tam_gaji'</script>";
 ?>