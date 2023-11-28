<?php 
	include '../conect/crud.php';
	$simpan = $proses->simpan("pegawai","'$_POST[nip]',
											'$_POST[nama]',
											'$_POST[tempat_lahir]',
											'$_POST[tanggal_lahir]',
											'$_POST[kode_golongan]',
											'$_POST[kode_jabatan]',
											'$_POST[status]',
											'$_POST[jumlah_anak]'");
	echo "<script>alert('Berhasil Menyimpan')</script>";
	echo "<script>document.location='../index.php?p=tam_pegawai'</script>";
 ?>