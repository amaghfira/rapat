<?php
session_start();
?>
<html>
<head>
	<title>Dokumen</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!--<br/>-->
	<!--<br/>-->
	<!--<center><h2>Request Jadwal Zoom</h2></center>	-->
	<!--<br/>-->
	<!--<div class="login">-->
	<!--<br/>-->
	<!--	<form action="login.php" method="post" onSubmit="return validasi()">-->
	<!--		<div>-->
	<!--			<label>Username:</label>-->
	<!--			<input type="text" name="username" id="username" />-->
	<!--		</div>-->
	<!--		<div>-->
	<!--			<label>Password:</label>-->
	<!--			<input type="password" name="password" id="password" />-->
	<!--		</div>			-->
	<!--		<div>-->
	<!--			<input type="submit" value="Login" class="tombol">-->
	<!--		</div>-->
	<!--	</form>-->
	<!--</div>-->
	
	<?php
		$host = mysqli_connect("localhost","root","","lk");

		if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  exit();
		}
		if (isset($_SESSION['username'])) {
			$username = $_SESSION['username'];
			$_SESSION['status'] = "login";
			
			$id_org = mysqli_query($host, "SELECT * FROM master_pegawai WHERE niplama = (SELECT niplama FROM autentifikasi WHERE username = '$username') "); 
			while ($res = mysqli_fetch_array($id_org)) {
                header("location:admin/index.php");
			}
			
		} else {
			header('location:../login_awal');
		}

	?>
</body>

<script type="text/javascript">
	function validasi() {
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;		
		
		if (username != "" && password!="") {
			return true;
		}else{
			alert('Username dan Password harus diisi!');
			return false;
		}
	}

</script>
</html>