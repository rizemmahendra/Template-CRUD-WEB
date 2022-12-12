<?php
require 'database.php';
session_start();

if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

// cek submit sudah ditekan
if (isset($_POST["submit"])) {
	//cek keberhasilan data
	if ( add($_POST) > 0 ) {
		echo "
		<script>
			alert('Data Berhasil Ditambahkan');
			document.location.href = 'index.php';
		</script>
		";
	}
	else{
		echo "
		<script>
			alert('Data Gagal Ditambahkan');
			document.location.href = 'index.php';
		</script>
		";
	}

};



?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Tambah Data Mahasiswa</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style type="text/css">
		ul, li{
			list-style: square;
		}
	</style>
</head>
<body>
		<header id="header" style="background-color: rgba(54,54,54,1);">
			<h1>RIZEM MAHENDRA</h1>
			<nav>
				<ul>
					<a href="#"><li>Home</li></a>
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
							<a href="index.php">
								<li style="margin-left: -90px;margin-top: -1px;">Dashboard</li>
							</a>
							<a href="logout.php">
								<li style="margin-left: -90px;margin-top: -1px;">Logout</li>
							</a>
						</ul>
					</li>
				</ul>
			</nav>
		</header>
		<div class="add">
			<h1>Tambah Data Mahasiswa</h1>
			<form action="" method="POST" enctype="multipart/form-data">
				<ul>
					<li>
						<label for="nama">Nama</label>
						<input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" required>
					</li>
					<br>
					<li>
						<label for="nim">No. BP</label>
						<input type="text" name="nim" id="nim" placeholder="No. BP Mahasiswa" required>
					</li>
					<br>
					<li>
						<label for="jurusan">Jurusan</label>
						<input type="text" name="jurusan" id="jurusan" placeholder="Jurusan Mahasiswa" required>
					</li>
					<br>
					<li>
						<label for="fakultas">Fakultas</label>
						<input type="text" name="fakultas" id="fakultas" placeholder="Fakultas Mahasiswa" required>
					</li>
					<br>
					<li>
						<label for="email">Email</label>
						<input type="text" name="email" id="email" placeholder="Email Mahasiswa" required>
					</li>
					<br>
					<li>
						<?php $mhs["img"] = "user.png" ?>
						<label for="img">Gambar</label><br>
						<img src="img/<?= $mhs["img"]; ?>" width="100"><br>
						<input type="file" id="img" name="img">
					</li>
					<br>
					<li>
						<button type="submit" name="submit">Tambah</button>
					</li>
				</ul>
			</form>
		</div>
</body>
</html>