<?php 
// isi nama host, username mysql, dan password mysql anda
$host = mysqli_connect("localhost","u8152743_ipd","ipd@6400");

if($host){
	// echo "koneksi host berhasil.<br/>";
}else{
	// echo "koneksi gagal.<br/>";
}
// isikan dengan nama database yang akan di hubungkan
$db = mysqli_select_db($host,"u8152743_rapat");

// if($db){
// 	echo "koneksi database berhasil.";
// }else{
// 	echo "koneksi database gagal.";
// }
?>