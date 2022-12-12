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
if (isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
	if (mysqli_num_rows($result) == 1) {
		//cek passowrd
		$row = mysqli_fetch_assoc($result);
		if(password_verify($password, $row["password"])){
			// set cooki
			if (isset($_POST["remember"])) {
				setcookie("id", $row["id"], time()+60);
				setcookie("key",hash(sha256, $_POST["username"]), time()+60);
			}
			// set session
			$_SESSION["login"] = true;
			header("Location:index.php");
			exit;
		}

	}
	$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
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
						<ul>
							<a href="index.html">
								<li style="margin-left: -90px;margin-top: -1px;">Home</li>
							</a>
							<a href="login.php">
								<li style="margin-left: -90px;margin-top: -1px;">Login</li>
							</a>
							<a href="registration.php">
								<li style="margin-left: -90px;margin-top: -1px;">Signup</li>
							</a>							
						</ul>
					</li>
				</ul>
			</nav>
		</header>
<div class="login-box">
	<h1>Login</h1>
	<?php if(isset($error)): ?>
		<p style="color: red;font-style: italic;">username/password error</p>
	<?php endif; ?>
	<form action="" method="POST">
		<div class="textbox">
			<img src="img/svg/user.svg" width="15">
			<input type="text" name="username" placeholder="username" autocomplete="off" autofocus required>
		</div>
		<div class="textbox">
			<img src="img/svg/lock.svg" width="15">
			<input type="password" id="password" name="password" placeholder="Password" required>
		</div>
		<div id="checkbox">
			<input type="checkbox" id="remember" name="remember" placeholder="remember">
			<label for="remember">Remember me</label>
		</div>
		<button type="submit" name="login">Login</button>
	</form>
	<br>
	<p>Not have an account? <a href="registration.php" style="color: #398635">Register</a></p>
</div>
</body>
<footer>
		<h5>Rizem Mahendra || copyright 2020</h5>
</footer>
</html>