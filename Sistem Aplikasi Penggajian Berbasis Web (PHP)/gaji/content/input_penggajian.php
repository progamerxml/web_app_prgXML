<h1>Form input Penggajian Karyawan</h1>
<hr>
<?php echo $form->form("open","proses/p_simpan_gaji.php");?>
<?php
	mysql_connect("localhost","root","");
	mysql_select_db("db_penggajian");

	$qr = "SELECT max(no_slip) as maxKode FROM gaji";
	$hs	= mysql_query($qr);
	$dt = mysql_fetch_array($hs);
	$kb	= $dt['maxKode'];

	$nu = (int) substr($kb, 2,3);
	$nu++;

	$char = "GJ";
	$newid = $char . sprintf("%03s",$nu);
 ?>
<table>
	<tr>
		<td>No Slip</td>
		<td>:</td>
		<td><?php echo $form->input("text","no_slip","$newid","readonly"); ?></td>
	</tr>
	<tr>
	<?php 
		date_default_timezone_set("Asia/Jakarta");
		$time = date ('Y-m-d');
	 ?>
		<td>Tanggal</td>
		<td>:</td>
		<td><?php echo $form->input("date","tgl","$time","readonly"); ?></td>
	</tr>
	<tr>
		<td>NIP</td>
		<td>:</td>
		<td><?php echo $form->input("text","nip","","required id='nip' onkeyup='cari()'"); ?></td>
	</tr>
	<tr>
		<td>Gaji Pokok</td>
		<td>:</td>
		<td><?php echo $form->input("text","gaji_pokok","","readonly id='gaji_pokok'"); ?></td>
	</tr>
	<tr>
		<td>Tunjangan Jabatan</td>
		<td>:</td>
		<td><?php echo $form->input("text","tunjangan_jabatan","","readonly id='tunjangan_jabatan'"); ?></td>
	</tr>
	<tr>
		<td>Tunjangan Istri</td>
		<td>:</td>
		<td><?php echo $form->input("text","tunjangan_istri","","readonly id='tunjangan_istri'"); ?></td>
	</tr>
	<tr>
		<td>Tunjangan Anak</td>
		<td>:</td>
		<td>
			<?php echo $form->input("text","tunjangan_anak","","readonly id='tunjangan_anak'" ); ?>
			<?php echo $form->input("hidden","tun_anak","","readonly id='tun_anak'" ); ?>
		</td>
	</tr>
	<tr>
		<td>Jumlah Anak</td>
		<td>:</td>
		<td><?php echo $form->input("text","jumlah_anak","","readonly id='jumlah_anak'"); ?></td>
	</tr>
	<tr>
		<td>Pendapatan</td>
		<td>:</td>
		<td><?php echo $form->input("text","pendapatan","","readonly id='pendapatan'"); ?></td>
	</tr>
	<tr>
		<td>Potongan</td>
		<td>:</td>
		<td><?php echo $form->input("text","pot","5%","readonly id='pot'"); ?><?php echo $form->input("hidden","potongan","","readonly id='potongan'"); ?></td>
	</tr>
	<tr>
		<td>Gaji Bersih</td>
		<td>:</td>
		<td><?php echo $form->input("text","gaji_bersih","","readonly id='gaji_bersih'"); ?></td>
	</tr>
	<tr>
		<td>Kode Petugas</td>
		<td>:</td>
		<td><?php echo $form->input("text","kode_petugas","$_SESSION[id]","readonly"); ?></td>
	</tr>
	<tr>
		<td>
			<div class="tmb-simpan">
				<?php echo $form->input("submit","simpan","Simpan","onclick='b_print()'"); ?>
				<a id="tmb-batal" href="index.php?p=tam_gaji">Batal</a>
			</div>
		</td>
	</tr>
</table>
<script type="text/javascript" src="js/jquery.js"></script>
<?php echo $form->form("close"); ?>
<script type="text/javascript">
	function cari(){
		$.ajax({
			url : "http://localhost/penggajian/proses/p_cari.php",
			type : "POST",
			dataType :"json",
			data : {
				nip:$("#nip").val()
			},
			success:function(hasil){
				$("#gaji_pokok").val(hasil.gaji_pokok);
				$("#tunjangan_jabatan").val(hasil.tunjangan_jabatan);
				$("#tunjangan_istri").val(hasil.tunjangan_istri);
				$("#tunjangan_anak").val(hasil.tunjangan_anak);
				$("#jumlah_anak").val(hasil.jumlah_anak);

				var a = $("#tunjangan_anak").val();
				var b = $("#jumlah_anak").val();
				c = a * b;
				$("#tun_anak").val(c);

				var t1 = document.getElementById('tunjangan_anak').value;
				var t2 = document.getElementById('jumlah_anak').value;
				var t3 = document.getElementById('gaji_pokok').value;
				var t4 = document.getElementById('tunjangan_jabatan').value;
				var t5 = document.getElementById('tunjangan_istri').value;
				var hsl = parseInt(t1) * parseInt(t2) + parseInt(t3) + parseInt(t4) + parseInt(t5);
				if (hsl) {
					document.getElementById('pendapatan').value = hsl;
				}

				var t1 = document.getElementById('pendapatan').value;
				var t2 = document.getElementById('pot').value;
				var hsl = parseInt(t1) * parseInt(t2)/100;
				if (hsl) {
					document.getElementById('potongan').value = hsl;
				}

				var t6 = document.getElementById('pendapatan').value;
				var t7 = document.getElementById('potongan').value;
				var hsl = parseInt(t6) - parseInt(t7);
				if (hsl) {
					document.getElementById('gaji_bersih').value = hsl;
				}
			}
		});
	}
	function b_print(){
		var x  = document.getElementById('nip').value;
		window.open("http://localhost/penggajian/content/slip_gaji.php?nip="+x,"_blank");
	};
</script>