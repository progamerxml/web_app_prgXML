<?php 
	include "../conect/crud.php";
	$hapus = $proses->hapus("pegawai","nip='$_GET[nip]'");
	echo "<script>alert('Berhasil Menghapus Data')</script>";
	echo "<script>document.location='../index.php?p=tam_pegawai'</script>";
 ?>