<?php
include "conect/crud.php";
include "proses/p_login.php";
if (isset($_SESSION['id'])) {
	echo "<script>document.location='index.php'</script>";
} else {
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
	<div class="body">
		<div class="sim">
			<h1>Sistem Penggajian</h1>
			<p>PT Wikrama Jaya Abadi</p>
			<p>Repost by <a href="https://stokcoding.com/" title="StokCoding.com" target="_blank">StokCoding.com</a></p>
		</div>
		<form action="" method="POST">
			<div class="kotak">
				<h1>Form Login</h1>
				<hr>
				<?php echo $form->input("text", "username", "", "placeholder='Username' required autofocus"); ?>
				<?php echo $form->input("password", "password", "", "placeholder='Password' required"); ?>
				<?php echo $form->input("submit", "login", "Sign In"); ?>
			</div>
		</form>
	</div>
</body>

</html>