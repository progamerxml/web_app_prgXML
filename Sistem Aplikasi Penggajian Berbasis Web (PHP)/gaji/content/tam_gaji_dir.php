<h1>Daftar Gaji</h1>
<hr>
<table class="t_all" cellspacing="0">
	<tr>
		<th>No</th>
		<th>No Slip</th>
		<th>Tanggal</th>
		<th>Pendapatan</th>
		<th>Potongan</th>
		<th>Gaji Bersih</th>
		<th>NIP</th>
		<th>Nama</th>
		<th>Petugas</th>
	</tr>
	<?php 
		$no=1;
		$hsl = $proses->tampil("*","pegawai,golongan,jabatan,gaji,petugas","WHERE pegawai.kode_golongan=golongan.kode_golongan AND pegawai.kode_jabatan=jabatan.kode_jabatan AND pegawai.nip=gaji.nip AND gaji.kode_petugas=petugas.kode_petugas");
		foreach ($hsl as $data) {
		
	 ?>
	 <tr>
	 	<td><?php echo $no++; ?></td>
	 	<td><?php echo $data[16]; ?></td>
	 	<td><?php echo $data[17]; ?></td>
	 	<td>Rp.
	 		<?php 
	 			echo str_replace(",", ".", number_format($data[18]));
	 		 ?>
	 	</td>
	 	<td>Rp.
	 		<?php 
	 			echo str_replace(",", ".", number_format($data[19]));
	 		 ?>
	 	</td>
	 	<td>Rp.
	 		<?php 
	 			echo str_replace(",", ".", number_format($data[20]));
	 		 ?>
	 	</td>
	 	<td><?php echo $data[0]; ?></td>
	 	<td><?php echo $data['nama']; ?></td>
	 	<td><?php echo $data[24]; ?></td>
	 </tr>
	 <?php } ?>
</table>