<?php 
require 'database.php';
session_start();
//cek cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
	$id = $_COOKIE["id"];
	$key = $_COOKIE["key"];

	//ambil user dan id
	$result = mysqli_query($connect, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	if ($key == hash(sha265, $row["username"])) {
		$_SESSION["login"] = true;
	}
}
if (isset($_SESSION["login"])) {
	header("Location: index.php");
	exit;
}
if (isset($_POST["register"])) {
	if (register($_POST) > 0) {
		echo "<script>
				alert('Congratulation, you have register!');
		</script>";
	}
	else{
		echo "<script>
				alert('Register failed');
		</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header id="header">
			<h1>RIZEM MAHENDRA</h1>
			<nav>
				<ul>
					<a href="index.html"><li>Home</li></a>
					<li>Pemrograman
						<ul>
							<a href="#"><li>C++</li></a>
							<a href="#"><li>CSS</li></a>
							<a href="#"><li>HTML</li></a>
							<a href="#"><li>Javascript</li></a>
							<a href="#"><li>PHP</li></a>
						</ul>
					</li>
					<li>Tutorial
						<ul>
							<li>Photography
								<ul>
									<a href="#1"><li>Adobe Photoshop</li></a>
									<a href="#2"><li>Adobe Lightroom</li></a>
									<a href="#3"><li>Corel Draw</li></a>
								</ul>
							</li>
							<li>Videography
								<ul>
									<a href="#4"><li>Adobe Premiere Pro</li></a>
									<a href="#5"><li>Adobe After Effect</li></a>
									<a href="#6"><li>Sony Vegas Pro</li></a>
								</ul>
							</li>
						</ul>
					</li>
					<li>Contact
						<ul>
							<a href="#"><li>Facebook</li></a>
							<a href="#"><li>Instagram</li></a>
							<a href="#"><li>Email</li></a>
						</ul>
					</li>
					<li style="width: auto;">
						<img src="img/svg/user.svg" width="20">
					</li>
				</ul>
			</nav>
		</header>
<div class="register-box">
	<h1>Registration Form</h1>
	<form action="" method="POST">
		<div class="textbox">
			<img src="img/svg/user.svg" width="15">
			<input type="text" name="username" placeholder="username" autocomplete="off" autofocus required>
		</div>
		<div class="textbox">
			<img src="img/svg/lock.svg" width="15">
			<input type="password" id="password" name="password" placeholder="Password" required>
		</div>
		<div class="textbox">
			<img src="img/svg/lock.svg" width="15">
			<input type="password" id="re_password" name="re_password" placeholder="Re-Password" required>
		</div>
			<button type="submit" name="register">Register</button>
	</form>
	<br>
	<p>Have an account? <a href="login.php" style="color: #398635">Login</a></p>
</div>
</body>
<footer>
		<h5>Rizem Mahendra || copyright 2020</h5>
</footer>
</html>