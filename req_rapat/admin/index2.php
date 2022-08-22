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

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    

</head>
<body>

<?php 

$link = mysqli_connect("localhost", "root", "", "kalender_zoom");

// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
	header("location:../index.php");
}

// menampilkan pesan selamat datang
echo "Hai, selamat datang ". $_SESSION['username'];

?>
<br/>
<br/>


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">

			

			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<div class="modal-header">
					<button type="submit" class="close" data-dismiss="modal" aria-hidden="true" onclick=""><span id="" class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Edit Detail Meeting</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="akun">Akun Zoom:</label>
						<input class="form-control " type="text" placeholder="Masukkan Akun Zoom" id="akun" name="zoom-akun">
					</div>
					<div class="form-group">
						<label for="idmeeting">ID Meeting:</label>
						<input class="form-control " type="text" placeholder="Masukkan ID Meeting" id="idmeeting" name="zoom-id-meeting">
					</div>
					<div class="form-group">
						<label for="startdate">Password:</label>
						<input class="form-control " type="text" placeholder="Masukkan password zoom" id="passzoom" name="zoom-pass">
					</div>
					<div class="form-group">
						<label for="startdate">Link:</label>
						<input class="form-control " type="text" placeholder="Masukkan link zoom" id="link" name="zoom-link">
					</div>
				</div>
				<div class="modal-footer ">
					<input type="submit" class="btn btn-success" name="edit" value="Simpan">
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
            <h4>Jadwal Zoom Meeting BPS Kaltim</h4>
            <div class="table-responsive">

                
                <table id="mytable" class="table table-bordred table-striped">
                    
                    <thead>
                        <th>No.</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Pengguna</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Peserta</th>
                        <th>Host</th>
                        <th>Akun Zoom</th>
                        <th>Id Meeting</th>
                        <th>Password</th>
                        <th>Link</th>
                        <th>Edit</th>
                    </thead>
                    <tbody>

                        
                        <?php 
                        $link = mysqli_connect("localhost", "root", "", "kalender_zoom");
                        
                        // SHOW FROM DB
                        $result = mysqli_query($link, "SELECT * FROM jadwal_zoom ORDER BY id DESC"); // using mysqli_query instead
                        while($res = mysqli_fetch_array($result)) {         
                            echo "<tr id='" . $res['id'] . "'>";
                            echo "<td>".$res['id']."</td>";
                            echo "<td>".$res['tanggal_mulai']."</td>";
                            echo "<td>".$res['tanggal_selesai']."</td>";
                            echo "<td>".$res['waktu_mulai']."</td>";    
                            echo "<td>".$res['waktu_selesai']."</td>";
                            echo "<td>".$res['pengguna']."</td>";
                            echo "<td>".$res['deskripsi']."</td>";
                            echo "<td>".$res['jumlah_peserta']."</td>";
                            echo "<td>".$res['host']."</td>";
                            if ($res['akun_zoom'] != '') {
                                echo "<td>".$res['akun_zoom']."</td>";
                                echo "<td>".$res['id_meeting']."</td>";
                                echo "<td>".$res['password']."</td>";			
                                echo "<td>".$res['link']."</td>";			    
                                echo '<td><p data-placement="top" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-ok"></span></p></td>';
                            } else {
                                echo "<td>".$res['akun_zoom']."</td>";
                                echo "<td>".$res['id_meeting']."</td>";
                                echo "<td>".$res['password']."</td>";			
                                echo "<td>".$res['link']."</td>";			
								$id_unik = $res['id'] ;   
								echo "<td>" . "<a href='editin.php?edit=" . $id_unik . "' data-target='#edit'>" . "Edit</a>";
                            }
                            echo "</tr>";
                        }

							// close conn
							mysqli_close(mysqli_connect("localhost", "root", "", "kalender_zoom"));

						?>
                        
                        <script>
                            function MyWindow(id) {
                                window.open('index.php?edit=<?php ?>','MyWindow','width=700','height=800');
                                return false;
                            }
                        </script>
                        
                        
                    </tbody>
                    
                </table>

                <a href="logout.php">LOGOUT</a>
            </div>
            
        </div>
    </div>
</div>
</body>
</html>