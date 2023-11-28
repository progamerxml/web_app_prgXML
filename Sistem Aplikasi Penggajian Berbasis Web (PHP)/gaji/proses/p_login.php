<?php 
	session_start();
	if (isset($_POST['login'])) {
		$user = $_POST['username'];
		$pass = md5($_POST['password']);
		$qr = $proses->tampil("*","petugas","WHERE BINARY nama_petugas='$user' AND password_petugas='$pass' AND status='Petugas'");
		$data = $qr->fetch();
		$rows = $qr->rowCount();
		if($rows == 0){
			$qrs = $proses->tampil("*","petugas","WHERE BINARY nama_petugas='$user' AND password_petugas='$pass' AND status='Direktur'");
			$datas = $qrs->fetch();
			$rowss = $qrs->rowCount();
			if($rowss == 0){
				echo "<script>alert('Login Gagal')</script>";
				echo "<script>document.location = 'login.php'</script>";
			}else{
				$_SESSION['id'] = $datas[0];
				echo "<script>alert('Anda Login Sebagai Direktur')</script>";
				echo "<script>document.location = 'home.php'</script>";
			}
		}else{
			$_SESSION['id'] = $data[0];
			echo "<script>alert('Anda Login Sebagai Petugas')</script>";
			echo "<script>document.location = 'index.php'</script>";
		}
	}
 ?>