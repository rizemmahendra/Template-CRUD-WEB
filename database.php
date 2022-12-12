<?php
//koneksi ke database
$connect = mysqli_connect("localhost", "usergempa", "rafki", "belajarphp");


function query($query){
	global $connect;
	//ambil/query data dari databases
	$result = mysqli_query($connect, $query);
	//pengecekan konek ke database
	if (!$result) {
		echo "Tidak terhubung ke databases";
	}
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function add($data){
	global $connect;
	//ambil data tiap element
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$fakultas = htmlspecialchars($data["fakultas"]);
	$email = htmlspecialchars($data["email"]);
	// cek upload gambar
	if ($_FILES["img"]["error"] == 4) {
		$img = "user.png";
	}
	else{
		$img = upload($nama);
	}
	if (!$img) {
		return false;
	}
	//query insert data
	$query = "INSERT INTO mahasiswa VALUES 
		('', '$nama', '$nim', '$jurusan', '$fakultas', '$email', '$img')";
	mysqli_query($connect, $query);

	return mysqli_affected_rows($connect);
}

function update($data){
	global $connect;
	//ambil data tiap element
	$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$fakultas = htmlspecialchars($data["fakultas"]);
	$email = htmlspecialchars($data["email"]);
	$old_img = htmlspecialchars($data["old_img"]);
	// cek upload gambar
	if ($_FILES["img"]["error"] == 4) {
		$img = $old_img;
	}
	else{
		$img = upload($nama);
	}
	//query insert data
	$query = "UPDATE mahasiswa SET 
			nama = '$nama',
			nim = '$nim',
			jurusan = '$jurusan',
			fakultas = '$fakultas',
			email = '$email',
			img = '$img' WHERE id = $id";
	mysqli_query($connect, $query);
	return mysqli_affected_rows($connect);
}

function upload($nameFile){
	// ambil data
	$name = $_FILES['img']["name"];
	$size = $_FILES['img']["size"];
	$error = $_FILES['img']["error"];
	$temp = $_FILES['img']["tmp_name"];

	// pengecekan apakah gambar belum dupload
	if ($error == 4) {
		echo "
		<script>
			alert('Silahkan pilih gambar!');
		</script>";
		return false;
	}

	//pengecekan file
	$extension = ["jpg", "jpeg", "png"];
	$extension_image = explode(".", $name);
	$extension_image = strtolower(end($extension_image));
	if (!in_array($extension_image, $extension)) {
		echo "
		<script>
			alert('Format file gambar salah!');
		</script>";
		return false;
	}
	// pengecekan ukuran
	if ($size > 1500000 || $size == 0) {
		echo "
		<script>
			alert('Ukuran file terlalu besar!');
		</script>";
		return false;
	}
	// genarate random nama
	$random = uniqid();
	$newName = $random."-".$nameFile.".".$extension_image;

	//gambar siap di upload
	move_uploaded_file($temp, "img/".$newName);
	return $newName;

}

function search($keyword){
	$query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR fakultas LIKE '%$keyword%' OR email LIKE '%$keyword%'";
	return query($query);
}
function searchpagination($keyword){
	$query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR fakultas LIKE '%$keyword%' OR email LIKE '%$keyword%'";
	return $query;
}
function delete($id){
	global $connect;
	mysqli_query($connect, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($connect);
}

function register($data){
	global $connect;
	$username = stripslashes($_POST["username"]);
	$password = mysqli_real_escape_string($connect, $_POST["password"]);
	$re_password = mysqli_real_escape_string($connect, $_POST["re_password"]);

	// cek username
	$user = mysqli_query($connect, "SELECT username FROM user WHERE username = '$username'");
	if (mysqli_fetch_assoc($user)) {
		echo "
		<script>
			alert('Username has taked';
		</script>";
		return false;
	}
	if ($password != $re_password) {
		echo "
		<script>
				alert('your password not same!');
		</script>
		";
		return false;
	}
	// enkrispsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	// insert data to database
	$insert = "INSERT INTO user VALUES ('', '$username', '$password')";
	mysqli_query($connect, $insert);

	return mysqli_affected_rows($connect);
}

?>