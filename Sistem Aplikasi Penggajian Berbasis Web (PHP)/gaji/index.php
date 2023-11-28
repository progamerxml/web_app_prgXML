<?php
	session_start();
	include "conect/crud.php";
	if (isset($_SESSION['id'])) {
		
	}else{
		echo "<script>document.location='login.php'</script>";
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>PT Wikrama Jaya Abadi</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
	<div class="header">
		<h1>Sistem Penggajian PT Wikrama Jaya Abadi</h1>
		<a href="proses/p_logout.php"><button class="logout" ">Logout</button></a>
	</div>
	<div class="side-menu">
		<ul>
			<a href="index.php?p=home"><li>Beranda</li></a>
			<a href="index.php?p=tam_pegawai"><li>Daftar Pegawai</li></a>
			<a href="index.php?p=tam_gaji"><li>Daftar Gaji</li></a>
			<a id="sebelum" style="cursor: pointer;"><li>Laporan <span style="float: right;">></span></li></a>
			<div id="box">
				<a href="index.php?p=tam_gaji_dir">Laporan Gaji</a>
				<a href="index.php?p=tam_pegawai_dir">Laporan Pegawai</a>
			</div>
		</ul>
	</div>
	<div class="content">
		<div class="main-content">
			<?php 
				if (isset($_GET['p'])) {
					include "content/".$_GET['p'].".php";
				}else{
					include "content/home.php";
				}
		?>
		</div>
	</div>
</body>
</html>
<style type="text/css">
.active{
	display: block;
	background-color: #757a7c;
	border-left:5px solid #87acc1;
}
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sebelum").click(function(){
			$("#box").slideToggle();
		});
	});

	var url = window.location.href;
	$('ul a[href="'+ url +'"]').addClass('active');
	$('ul a').filter(function() {
	    return this.href == url;
	}).addClass('active');

	$(document).ready(function(){
		if(!$.browser.webkit){
			$('.content').jScrollPanel();
		}
	});
</script>