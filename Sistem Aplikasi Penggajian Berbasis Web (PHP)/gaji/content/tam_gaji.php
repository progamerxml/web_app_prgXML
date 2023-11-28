<h1>Daftar Gaji</h1>
<hr>
<a href="index.php?p=input_penggajian"><button id="tmb-data">Tambah Data</button></a>
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
		<th>Action</th>
	</tr>
	<?php 
		$no=1;
		$hsl = $proses->tampil("*","pegawai,golongan,jabatan,gaji,petugas","WHERE pegawai.kode_golongan=golongan.kode_golongan AND pegawai.kode_jabatan=jabatan.kode_jabatan AND pegawai.nip=gaji.nip AND gaji.kode_petugas=petugas.kode_petugas");
		foreach ($hsl as $data) {
		
	 ?>
	 <tr>
	 	<td><?php echo $no++; ?></td>
	 	<td><?php echo $data['no_slip']; ?></td>
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
	 	<td><?php echo $data['nip']; ?></td>
	 	<td><?php echo $data['nama']; ?></td>
	 	<td><?php echo $data[24]; ?></td>
	 	<td>
			<a id="slip" href="http://localhost/penggajian/content/slip_gaji.php?nip=<?php echo $data[0]; ?>" target="_blank">Print Slip</a>
			<a href="proses/p_hapus_gaji.php?no_slip=<?php echo $data['no_slip']; ?>">Hapus</a>
	 	</td>
	 </tr>
	 <?php } ?>
</table>