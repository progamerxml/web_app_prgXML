<?php 
	$qw=$proses->tampil("*","pegawai","WHERE nip='$_GET[nip]'");
	$dat=$qw->fetch();
 ?>
<h1>Form Edit Pegawai</h1>
<hr>
<?php echo $form->form("open","proses/p_edit_pegawai.php"); ?>
<table>
	<?php echo $form->input("hidden","id","$dat[0]"); ?>
	<tr>
		<td>NIP</td>
		<td>:</td>
		<td><?php echo $form->input("text","nip","$dat[0]"); ?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:</td>
		<td><?php echo $form->input("text","nama","$dat[1]"); ?></td>
	</tr>
	<tr>
		<td>Tempat Tanggal Lahir</td>
		<td>:</td>
		<td><?php echo $form->input("text","tempat_lahir","$dat[2]"); ?> <?php echo $form->input("date","tanggal_lahir","$dat[3]"); ?></td>
	</tr>
	<tr>
		<td>Kode Golongan</td>
		<td>:</td>
		<td><?php echo $form->select("kode_golongan","4",array(1=>'1A',2=>'2A',3=>'3A',4=>'4A'),"","$dat[4]"); ?></td>
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
			<?php echo $form->newselect("kode_jabatan",$jml,$dt,$search,"","$dat[5]"); ?>
		</td>
	</tr>
	<tr>
		<td>Status</td>
		<td>:</td>
		<td>
			<?php 
				$M="";
 				$BM="";
 				if($dat[6] == "Menikah"){
 					$M="checked";
 				}elseif($dat[6] == "Belum Menikah"){
 					$BM= "checked";
 				}
			 ?>
			<?php echo $form->input("radio","status","Menikah","$M"); ?>Menikah
			<?php echo $form->input("radio","status","Belum Menikah","$BM"); ?>Belum Menikah
		</td>
	</tr>
	<tr>
		<td>Jumlah Anak</td>
		<td>:</td>
		<td><?php echo $form->select("jumlah_anak","3",array(1=>'0',2=>'1',3=>'2'),"","$dat[7]"); ?></td>
	</tr>
	<tr>
		<td colspan="3">
			<div class="tmb-simpan">
				<?php echo $form->input("submit","simpan","Simpan"); ?>
				<a id="tmb-batal" href="index.php?p=tam_pegawai">Batal</a>
			</div>
		</td>
	</tr>
</table>
<?php echo $form->form("close"); ?>