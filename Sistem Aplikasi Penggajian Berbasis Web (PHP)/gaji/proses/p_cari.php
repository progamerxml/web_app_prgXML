<?php 
	include "../conect/crud.php";
	$tm = $proses->tampil("*","pegawai,golongan,jabatan","WHERE pegawai.kode_golongan=golongan.kode_golongan AND pegawai.kode_jabatan=jabatan.kode_jabatan AND nip='$_POST[nip]'");
	$hs = $tm->fetch();
	$ar = array(
				"gaji_pokok" 		=>	$hs['gaji_pokok'],
				"tunjangan_jabatan"	=>	$hs['tunjangan_jabatan'],
				"tunjangan_istri"	=>	$hs['tunjangan_istri'],
				"tunjangan_anak"	=>	$hs['tunjangan_anak'],
				"jumlah_anak"		=>	$hs['jumlah_anak']);
	echo json_encode($ar);
 ?>