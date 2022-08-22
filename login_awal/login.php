<?php 
include 'config.php';

//connect mysqli
// $host = mysqli_connect("localhost","root","","kalender_zoom");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($host, "SELECT a.*, p.nama, p.id_org, p.id_satker  FROM autentifikasi a, master_pegawai p WHERE a.niplama = p.niplama AND a.username = '$username' AND a.password = '$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['status'] = "login";
	$_SESSION['isLogin'] = true;
	$_SESSION['nama'] = $cek['nama'];
	$_SESSION['id_satker'] = $cek['id_satker'];
	$_SESSION['role'] = $cek['id_org'];
	if ($_SESSION['username']) {
		header("location:../req_rapat/index.php?u=".$_SESSION['username']);
	} else {
		header("location:client/index.php");		
	}
} else {
	header("location:index.php");
}
?>