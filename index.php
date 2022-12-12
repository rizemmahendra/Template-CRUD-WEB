<?php  
require 'database.php';
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}


//pagination
$jumlahDataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["p"])) ? $halamanAktif = $_GET["p"]:$halamanAktif =1;
$dataAwal = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = mysqli_query($connect, "SELECT * FROM mahasiswa LIMIT $dataAwal, $jumlahDataPerHalaman");
$url = "?p=";
//logika search
if (isset($_GET["search"])) {
	if ($_GET["search"] == "") {
		header("Location: index.php");
	}
	$hasil = search($_GET["keyword"]);
	global $jumlahDataPerHalaman;
	$jumlahHasil = count($hasil);
	$jumlahHalaman = ceil($jumlahHasil / $jumlahDataPerHalaman);
	$halamanAktif = (isset($_GET["p"])) ? $halamanAktif = $_GET["p"]:$halamanAktif =1;
	$dataAwal = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
	$pagination = " LIMIT $dataAwal, $jumlahDataPerHalaman";
	$mahasiswa = query(searchpagination($_GET["keyword"]).$pagination);
	$url = "?keyword=".$_GET["keyword"]."&search=&p=";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header id="header" style="background-color:rgba(54,54,54,1);">
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
							<a href="logout.php"><li style="margin-left: -90px;margin-top: -1px;">logout</li></a>
						</ul>
					</li>
				</ul>
			</nav>
		</header>
		<div class="home">
			<h1 align="center" id="index">Tabel Data Mahasiswa</h1>
			<br>
			<a href="add.php"><button>Tambah data</button></a>

			<form action="" method="GET">
				<input type="text" name="keyword" placeholder="keyword" size="50"  autocomplete="off" id="keyword">
				<button type="submit" name="search" id="search">Search</button>
			</form>
			<br>
			<?php if($halamanAktif > 1): ?>
				<a href="<?= $url.($halamanAktif - 1); ?>">&laquo</a>
			<?php endif; ?>
			<?php for($i=1;$i<=$jumlahHalaman;$i++): ?>
				<?php if ($i==$halamanAktif): ?>
					<a href="?<?= $url.$i; ?>" style="color: red;"><?= $i; ?></a>
				<?php else: ?>
					<a href="<?= $url.$i; ?>"><?= $i; ?></a>
				<?php endif; ?>
			<?php endfor; ?>
			<?php if($halamanAktif < $jumlahHalaman): ?>
				<a href="<?= $url.($halamanAktif + 1); ?>">&raquo</a>
			<?php endif; ?>
			<br>
			<div id="container">
				<table border="1" cellpadding="10" cellspacing="0">
					<thead>
						<th>No.</th>
						<th>Action</th>
						<th>Gambar</th>
						<th>Nama</th>
						<th>No. BP</th>
						<th>Jurusan</th>
						<th>Fakultas</th>
						<th>Email</th>
					</thead>
					<?php $no = 1; ?>
					<?php foreach($mahasiswa as $mhs ) : ?>
					<tbody align="center">
							<td><?= $no; ?></td>
							<td>
								<a href="update.php?id=<?= $mhs["id"]; ?>">ubah</a> | <a href="delete.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('Yakin ingin menghapus data?');">hapus</a>
							</td>
							<td>
								<img src="img/<?= $mhs["img"]; ?>" width="100">
							</td>
							<td><?= $mhs["nama"]; ?></td>
							<td><?= $mhs["nim"]; ?></td>
							<td><?= $mhs["jurusan"]; ?></td>
							<td><?= $mhs["fakultas"]; ?></td>
							<td><?= $mhs["email"]; ?></td>
					</tbody>
					<?php $no++; ?>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
		<script type="text/javascript" src="javascript/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="javascript/script.js"></script>
	</body>
	<footer>
			<h5>Rizem Mahendra || copyright 2020</h5>
	</footer>
</html>