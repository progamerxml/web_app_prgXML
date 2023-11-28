<h1>Daftar Pegawai</h1>
<hr>
<table class="t_all" cellspacing="0">
	<tr>
		<th>No</th>
		<th>NIP</th>
		<th>Nama</th>
		<th>Tempat Lahir</th>
		<th>Tanggal Lahir</th>
		<th>Kode Golongan</th>
		<th>Kode Jabatan</th>
		<th>Status</th>
		<th>Jumlah Anak</th>
	</tr>
	<?php 
		$no=1;
		$hsl = $proses->tampil("*","pegawai","");
 		foreach ($hsl as $data) {
	?>
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $data[0]; ?></td>
		<td><?php echo $data[1]; ?></td>
		<td><?php echo $data[2]; ?></td>
		<td><?php echo $data[3]; ?></td>
		<td><?php echo $data[4]; ?></td>
		<td><?php echo $data[5]; ?></td>
		<td><?php echo $data[6]; ?></td>
		<td><?php echo $data[7]; ?></td>
	</tr>
	<?php } ?>
</table>