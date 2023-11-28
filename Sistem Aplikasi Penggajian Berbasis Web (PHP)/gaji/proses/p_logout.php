<?php 
	session_start();
	session_destroy();
	echo "<script>alert('Logout Berhasil')</script>";
	echo "<script>document.location = '../login.php'</script>";
 ?>