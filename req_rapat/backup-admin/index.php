<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Zoom Request</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
    <style>
    .container {
        border:10px;
        /* padding:10px */
    }

    .welcome{
        padding: 30px;    
    }

    #logout {
        color:black;
        text-align: right;
    }
    </style>


</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav ml-auto">
        <a class="navbar-brand" href="logout.php" id="logout">Logout</a>
      </ul>
    </div>
  </div>
</nav>

<?php 
include '../config.php';

$link = mysqli_connect("bpskaltim.com", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom");

// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
	header("location:../index.php");
}

// menampilkan pesan selamat datang
echo "<div class='welcome' style='text-align:right'>" . " <p>Hai, selamat datang ". $_SESSION['username'] . "</p></div>";

// // ambil dari input user
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
// 	$akun = $_POST['zoom-akun'];
// 	$id = $_POST['zoom-id-meeting'];
// 	$pass = $_POST['zoom-pass'];
// 	$link = $_POST['zoom-link'];
	
// 	// update db 
// 	$sql = "UPDATE jadwal_zoom SET akun_zoom='$akun', id_meeting='$id', password='$pass', link='$link' WHERE (id = $id_unik)";

// 	if(mysqli_query(mysqli_connect("localhost", "root", "", "kalender_zoom"), $sql)){
// 		echo "Data berhasil direkam";

// 	} else{
// 		echo "ERROR: Could not able to execute $sql. " . mysqli_error(mysqli_connect("localhost", "root", "", "kalender_zoom"));
// 	}	
// }

// $result = mysqli_query(mysqli_connect("localhost", "root", "", "kalender_zoom"), "SELECT * FROM jadwal_zoom ORDER BY id DESC"); // using mysqli_query instead


// // Close connection
// mysqli_close(mysqli_connect("localhost", "root", "", "kalender_zoom"));

?>
<br/>
<br/>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">

			

			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input class="form-control " type="hidden" name="zoom-id" id="zoom-id">
				<div class="modal-header">
					<button type="submit" class="close" data-dismiss="modal" aria-hidden="true" onclick=""><span id="" class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Edit Detail Meeting</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="akun">Akun Zoom:</label>
						<input class="form-control " type="text" placeholder="Masukkan Akun Zoom" id="akun" name="zoom-akun" required>
					</div>
					<div class="form-group">
						<label for="idmeeting">ID Meeting:</label>
						<input class="form-control " type="text" placeholder="Masukkan ID Meeting" id="idmeeting" name="zoom-id-meeting" required>
					</div>
					<div class="form-group">
						<label for="startdate">Password:</label>
						<input class="form-control " type="text" placeholder="Masukkan password zoom" id="passzoom" name="zoom-pass" required>
					</div>
					<div class="form-group">
						<label for="startdate">Link:</label>
						<input class="form-control " type="text" placeholder="Masukkan link zoom" id="link" name="zoom-link" required>
					</div>
				</div>
				<div class="modal-footer ">
					<input type="submit" class="btn btn-success" name="edit" value="Simpan" id="edit-button">
					<!-- <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button> -->
				</div>
			</form>
			
    
		</div>
		<!-- /.modal-content --> 
	</div>
    <!-- /.modal-dialog --> 
</div>

<div class="container">
    <div class="row">
        
        
        <div class="col-md-12">
            <h4 style="text-align: center;">Jadwal Zoom Meeting BPS Kaltim</h4>
            <br><br><br>
            <div class="table-responsive">

                
                <table id="mytable" class="table table-hover table-striped">
                    
                    <thead>
                        <th scope="col">No.</th>
                        <th scope="col">Tanggal Mulai</th>
                        <th scope="col">Tanggal Selesai</th>
                        <th scope="col">Waktu Mulai</th>
                        <th scope="col">Waktu Selesai</th>
                        <th scope="col">Pengguna</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Jumlah Peserta</th>
                        <th scope="col">Host</th>
                        <th scope="col">Akun Zoom</th>
                        <th scope="col">Id Meeting</th>
                        <th scope="col">Password</th>
                        <th scope="col">Link</th>
                        <th scope="col">Edit</th>
                    </thead>
                    <tbody>

                        
                        <?php 
                        $link = mysqli_connect("bpskaltim.com", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom");
                        
                        // SHOW FROM DB
                        $result = mysqli_query($link, "SELECT * FROM jadwal_zoom ORDER BY tanggal_mulai ASC"); // using mysqli_query instead
                        while($res = mysqli_fetch_array($result)) {         
                            echo "<tr class='table-info' id='" . $res['id'] . "'>";
                            echo "<td>".$res['id']."</td>";
                            echo "<td>".$res['tanggal_mulai']."</td>";
                            echo "<td>".$res['tanggal_selesai']."</td>";
                            echo "<td>".$res['waktu_mulai']."</td>";    
                            echo "<td>".$res['waktu_selesai']."</td>";
                            echo "<td>".$res['pengguna']."</td>";
                            echo "<td>".$res['deskripsi']."</td>";
                            echo "<td>".$res['jumlah_peserta']."</td>";
                            echo "<td>".$res['host']."</td>";
                            
                                echo "<td>".$res['akun_zoom']."</td>";
                                echo "<td>".$res['id_meeting']."</td>";
                                echo "<td>".$res['password']."</td>";			
                                echo "<td>".$res['link']."</td>";			
								$id_unik = $res['id'] ;   
                                echo '<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button type="submit" name = "id" value="value" class="editId btn btn-primary btn-xs" data-id="'.$res['id'].'" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>';
								// echo "<td>" . "<a href='index.php?edit=" . $id_unik . "' data-target='#edit'>" . "Edit</a>";
                            
                            echo "</tr>";
                        }

							
							
								if(@$_POST['edit']){
                                   $id= $_POST['zoom-id'];
									$akun = $_POST['zoom-akun'];
									$id_meeting = $_POST['zoom-id-meeting'];
									$pass = $_POST['zoom-pass'];
									$link = $_POST['zoom-link'];
									
									$sql = "UPDATE jadwal_zoom SET akun_zoom='$akun', id_meeting='$id_meeting', `password`='$pass', link='$link' WHERE id = $id";
                                    //$sql = "INSERT INTO jadwal_zoom(akun_zoom, id_meeting, password, link) VALUES ('$akun', '$id_meeting', '$pass','$link') WHERE id = $id";
									if(mysqli_query(mysqli_connect("bpskaltim.com", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom"), $sql)){
										

                                    echo '<div class="alert alert-dismissible alert-success">';
                                    echo '<strong>Data Berhasil Direkam.</strong> Silakan <a href="../admin/index.php"> Refresh </a> Browser Anda.';
                                    echo '</div>';
                                        
									} else{
										echo "ERROR: Could not able to execute $sql. " . mysqli_error(mysqli_connect("bpskaltim.com", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom"));
									}	
								}

								// if ($_SERVER["REQUEST_METHOD"] == "POST") {
								// 	$akun = $_POST['zoom-akun'];
								// 	$id_meeting = $_POST['zoom-id-meeting'];
								// 	$pass = $_POST['zoom-pass'];
								// 	$link = $_POST['zoom-link'];
									

								// 	$sql = "INSERT INTO jadwal_zoom(akun_zoom, id_meeting, password, link) VALUES ('$akun', '$id_meeting', '$pass','$link') WHERE $id = ";
									
								
							
							// close conn
							mysqli_close(mysqli_connect("bpskaltim.com", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom"));
                            
						?>
                        
                        
                        
                    </tbody>
                    
                </table>

                <!-- <a href="logout.php">LOGOUT</a> -->
            </div>
            
        </div>
    </div>
</div>
<script>
    $('.editId').on('click',function(){
    var zoomId = $(this).data('id');
    console.log(zoomId);
    $('#zoom-id').val(zoomId);

    //ng kene awkmu ngisi form e, njupuk tekan db trs dideleh ng form e 
    });
</script>
</body>
</html>