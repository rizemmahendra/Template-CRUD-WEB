var keyword = document.getElementById('keyword');
var search = document.getElementById('search');
var container = document.getElementById('container');

keyword.addEventListener('keyup', function() {
	//membuat objek ajax
	var xhr = new XMLHttpRequest();
	//mengecek kesiapan ajax
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			container.innerHTML = xhr.responseText;
		}
	}
	//eksekusi ajax
	xhr.open('GET', 'ajax/mahasiswa.php?search='+keyword.value, true);
	xhr.send();
});