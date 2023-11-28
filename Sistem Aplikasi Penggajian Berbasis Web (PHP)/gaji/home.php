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
	<title>Administrator</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
	<div class="header">
		<h1>Sistem Penggajian PT Wikrama Jaya Abadi</h1>
		<a href="proses/p_logout.php"><button class="logout">Logout</button></a>
	</div>
	<div class="side-menu">
		<ul>
			<a href="home.php?p=home_dir"><li>Home</li></a>
			<a id="sebelum" style="cursor: pointer;"><li>Laporan</li></a>
			<div id="box">
				<a href="home.php?p=tam_gaji_dir">Laporan Gaji</a>
				<a href="home.php?p=tam_pegawai_dir">Laporan Pegawai</a>
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
	#box{
		width: 100%;
		height: auto;
		display: none;
		text-indent: 20px;
	}
	.logout{
		color: #fff;
		float: right;
		width: 70px;
		height: 30px;
		margin-top:-25px;
		margin-right: 10px;
		background-color: transparent;
		border: 1px solid #fff;
		cursor: pointer;
		border-radius: 3px;
		transition-property: all;
		transition-duration: 0.3s;
	}
	.logout:hover{
		background-color: #efefef;
		color: #0a0a0a;
		transition-property: all;
		transition-duration: 0.3s;
	}
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sebelum").click(function(){
			$("#box").animate({
				height: 'toggle'
			});
		});
	});
</script>