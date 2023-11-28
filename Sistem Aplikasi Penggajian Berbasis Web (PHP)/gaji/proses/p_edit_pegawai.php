<?php 
	include "../conect/crud.php";
	$edit = $proses->edit("pegawai","nip='$_POST[nip]',
										nama='$_POST[nama]',
										tempat_lahir='$_POST[tempat_lahir]',
										tanggal_lahir='$_POST[tanggal_lahir]',
										kode_golongan='$_POST[kode_golongan]',
										kode_jabatan='$_POST[kode_jabatan]',
										status='$_POST[status]',
										jumlah_anak='$_POST[jumlah_anak]'",
										"nip='$_POST[id]'");
	echo "<script>alert('Berhasil Edit')</script>";
	echo "<script>document.location='../index.php?p=tam_pegawai'</script>";
 ?>