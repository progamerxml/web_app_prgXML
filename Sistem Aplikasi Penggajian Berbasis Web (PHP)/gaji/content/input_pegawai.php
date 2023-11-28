<h1>Form Input Pegawai</h1>
<hr>
<?php echo $form->form("open","proses/p_simpan_pegawai.php"); ?>
<table>
	<tr>
		<td>NIP</td>
		<td>:</td>
		<td><?php echo $form->input("text","nip","","required"); ?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $form->input("text","nama","","required"); ?></td>
	</tr>
	<tr>
		<td>Tempat Tanggal Lahir</td>
		<td>:</td>
		<td><?php echo $form->input("text","tempat_lahir","","required"); ?> <?php echo $form->input("date","tanggal_lahir","","required"); ?></td>
	</tr>
	<tr>
		<td>Kode Golongan</td>
		<td>:</td>
		<td><?php echo $form->select("kode_golongan","4",array(1=>'1A',2=>'2A',3=>'3A',4=>'4A')); ?></td>
	</tr>
	<tr>
		<td>Jabatan</td>
		<td>:</td>
		<td>
			<?php 
				$p = 0;
				$hsl = $proses->tampil("*","jabatan","");
				$jml=$hsl->rowCount();
				foreach ($hsl as $data) {$p++;
				 	$dt[$p] = $data[1];
				 	$search[$p] = $data[0];
				 } 
			 ?>
			<?php echo $form->newselect("kode_jabatan",$jml,$dt,$search); ?>
		</td>
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td>
			<?php echo $form->input("radio","status","Menikah"); ?>Menikah
			<?php echo $form->input("radio","status","Belum Menikah"); ?>Belum Menikah
		</td>
	</tr>
	<tr>
		<td>Jumlah Anak</td>
		<td>:</td>
		<td><?php echo $form->select("jumlah_anak","3",array(1=>'0',2=>'1',3=>'2')); ?></td>
	</tr>
	<tr>
		<td colspan="3">
			<div class="tmb-simpan">
				<?php echo $form->input("submit","simpan","Simpan"); ?>
				<a id="tmb-batal" href="index.php?p=tam_pegawai" >Batal</a>
			</div>
		</td>
	</tr>
</table>
<?php echo $form->form("close"); ?>
<script type="text/javascript">
	function sts() {
		if (document.getElementById("status").value==="Belum Menikah") {
			document.getElementById("ja").disabled='true';
		}else{
			document.getElementById("ja").disabled='false';
		}
	}
</script>