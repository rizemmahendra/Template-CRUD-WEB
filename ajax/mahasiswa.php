<?php 
require '../database.php';
$keyword = $_GET["search"];
$query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR fakultas LIKE '%$keyword%' OR email LIKE '%$keyword%'";
$mahasiswa = query($query);
 ?>
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