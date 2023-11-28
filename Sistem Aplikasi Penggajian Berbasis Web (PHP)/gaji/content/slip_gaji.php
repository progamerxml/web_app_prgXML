<?php
	include '../conect/crud.php'; 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Slip Gaji</title>
</head>
<body>
<center>
	<div class="kotak">
		<table border="1" cellspacing="0">
		 	
			<?php 
				$hs = $proses->tampil("*","pegawai,golongan,jabatan,gaji,petugas","WHERE pegawai.kode_golongan=golongan.kode_golongan AND pegawai.kode_jabatan=jabatan.kode_jabatan AND pegawai.nip=gaji.nip AND gaji.kode_petugas=petugas.kode_petugas AND gaji.nip='$_GET[nip]'");
				$dat = $hs->fetch();
			 ?>
			 <tr>
		 		<td colspan="3"><h2>PT Wikrama Jaya Abadi</h2></td>
		 	</tr>
		 	<tr>
		 		<td colspan="3">
		 			Tanggal  : <?php echo $dat['tanggal']; ?> <br>
		 			Nama 	 : <?php echo $dat['nama']; ?><br>
		 			Jabatan  : <?php echo $dat['nama_jabatan']; ?><br>
		 			Golongan : <?php echo $dat['kode_golongan']; ?><br>
		 		</td>
		 	</tr>
			<tr>
				<td>Gaji Pokok</td>
				<td>:</td>
				<td>Rp.
					<?php 
	 					echo str_replace(",", ".", number_format($dat['gaji_pokok']));
	 		 		?>
				</td>
			</tr>
			<tr>
				<td>Tunjangan Jabatan</td>
				<td>:</td>
				<td>Rp.
					<?php 
	 					echo str_replace(",", ".", number_format($dat['tunjangan_jabatan']));
	 		 		?>
				</td>
			</tr>
			<tr>
				<td>Tunjangan Istri</td>
				<td>:</td>
				<td>Rp.
					<?php 
	 					echo str_replace(",", ".", number_format($dat['tunjangan_istri']));
	 		 		?>
				</td>
			</tr>
			<tr>
				<td>Tunjangan Anak</td>
				<td>:</td>
				<td>Rp.
					<?php 
	 					echo str_replace(",", ".", number_format($dat['tun_anak']));
	 		 		?>
				</td>
			</tr>
			<tr>
				<td>Pendapatan</td>
				<td>:</td>
				<td>Rp.
					<?php 
	 					echo str_replace(",", ".", number_format($dat['pendapatan']));
	 		 		?>
				</td>
			</tr>
			<tr>
				<td>Potonga</td>
				<td>:</td>
				<td>Rp.
					<?php 
	 					echo str_replace(",", ".", number_format($dat['potongan']));
	 		 		?>
				</td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td>:</td>
				<td>Rp.
					<?php 
	 					echo str_replace(",", ".", number_format($dat['gaji_bersih']));
	 		 		?>
				</td>
			</tr>
			<tr>
				<td colspan="3">HRD <br><br><?php echo $dat['nama_petugas']; ?></td>
			</tr>
		</table>
	</div>
</center>
</body>
</html>
<script type="text/javascript">
	window.load=b_print();
	function b_print(){
		window.print();
	};
</script>