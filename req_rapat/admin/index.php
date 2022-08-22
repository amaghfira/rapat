<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAMBAH JADWAL RAPAT TIM</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
    <!--DATATABLES SCRIPT & PLUGINS-->
     <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
     <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.0.0/js/dataTables.fixedColumns.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.0.0/css/fixedColumns.dataTables.min.css">
    <style>
    .container {
        border:3px;
        /* padding:10px */
    }

    .welcome{
        padding: 30px;    
    }

    #logout {
        color:black;
        text-align: right;
    }
    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    thead th {
        background-color:#161E54;
        color:white;
    }
    </style>


</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav ml-auto">
        <a class="navbar-brand" href="https://bpskaltim.com/rapat" id="logout">Kalender Rapat Tim</a>
      </ul>
    </div>
  </div>
</nav>

<?php 
include '../config.php';

$link = mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat");

// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login

if($_SESSION['status'] !="login"){
	header("location:../index.php");
}

// menampilkan pesan selamat datang
echo "<div class='welcome' style='text-align:right'>" . " <p>Hai, selamat datang ". $_SESSION['username'] . "</p></div>";
echo '<p data-placement="top" data-toggle="tooltip" title="Tambah Rapat" style="text-align:right; padding-right:30px"><button type="submit" name = "id" value="value" class="editId btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit2" >Tambahkan Jadwal</button></p>';

?>
<br/>
<br/>
<div class="">
    <div class="row" style="margin:2em">
    
        <div class="col-md-12">
            <h4 style="text-align: center;">Jadwal Rapat TIM</h4>
            <br><br><br>
            <div class="table-responsive">

                
                <table class="table table-hover table-striped data-table" id="tabel-master">
                    
                    <thead>
                        <th scope="col">Tgl. Mulai</th>
                        <th scope="col">Waktu Mulai</th>
                        <th scope="col">Waktu Selesai</th>
                        <th scope="col">Tim</th>
                        <th scope="col">Agenda</th>
                        <th scope="col">Pemimpin Rapat</th>
                        <th scope="col">Daftar Peserta</th>
                        <th scope="col">Ruang Rapat</th>
                        <th scope="col">Aksi</th>
                    </thead>
                    <tbody>
                        <?php 
                        $link = mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat");
                        
                        // SHOW FROM DB
                        $result = mysqli_query($link, "SELECT * FROM jadwal ORDER BY tanggal ASC"); // using mysqli_query instead
                        while($res = mysqli_fetch_array($result)) {         
                            echo "<tr class='table-info' id='" . $res['id'] . "'>";
                            // echo "<td>".$res['id']."</td>";
                            echo "<td>".$res['tanggal']."</td>";
                            echo "<td>".$res['waktu_mulai']."</td>";    
                            echo "<td>".$res['waktu_selesai']."</td>";
                            echo "<td>".$res['tim']."</td>";
                            echo "<td>".$res['agenda']."</td>";
                            echo "<td>".$res['pemimpin']."</td>";
                            echo "<td>".$res['daftar_peserta']."</td>";
                            echo "<td>".$res['ruang']."</td>";
								$id_unik = $res['id'] ;   
                                echo '<td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button type="submit" name = "id" value="value" class="editId btn btn-primary btn-xs" data-id="'.$res['id'].'" data-tanggalmulai="'.$res['tanggal'].'" data-waktumulai="'.$res['waktu_mulai'].'" data-waktuselesai="'.$res['waktu_selesai'].'" data-tim="'.$res['tim'].'" data-agenda="'.$res['agenda'].'" data-pemimpin="'.$res['pemimpin'].'" data-daftarpeserta="'.$res['daftar_peserta'].'" data-ruang="'.$res['ruang'].'" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button>
                                            <a href="#" class="btn btn-danger btn-xs btn-delete" data-id="'.$res['id'].'"><span class="glyphicon glyphicon-trash"></span></a>
                                            
                                        </p>
                                        
                                    </td>';
                            echo "</tr>";
                        }

							
							
								if(@$_POST['edit']){
                                    $id= $_POST['zoom-id'];
                                    $tglmulai = $_POST['tanggalmulai2'];
                                    $wktmulai = $_POST['waktumulai2'];
                                    $wktselesai = $_POST['waktuselesai2'];
                                    $tim = $_POST['tim2'];
                                    $agenda = $_POST['agenda2'];
                                    $pemimpin = $_POST['pemimpin2'];
                                    $daftar_peserta = $_POST['daftar_peserta2'];
                                    $ruang = $_POST['ruang2'];
									
									$sql = "UPDATE jadwal 
									        SET tanggal = '$tglmulai', waktu_mulai = '$wktmulai', waktu_selesai = '$wktselesai', tim= '$tim' , agenda= '$agenda', pemimpin= '$pemimpin', daftar_peserta='$daftar_peserta', ruang= '$ruang'
									        WHERE id = $id";
                                    
									if(mysqli_query(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat"), $sql)){
										

                                    echo '<div class="alert alert-dismissible alert-success">';
                                    
                                    header('Location: '.$_SERVER['PHP_SELF']);
                                    echo '</div>';
                                        
									} else{
										echo "ERROR: Could not able to execute $sql. " . mysqli_error(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat"));
									}	
								}

                                if(@$_POST['edit2']){ //ini tu insert knp namanya edit 2 bingungin aja dah ul -__-
                                    $tgl_mulai = $_POST['tanggal-mulai'];
                                    $wkt_mulai = $_POST['waktu-mulai'];
                                    $wkt_selesai = $_POST['waktu-selesai'];
                                    $tim = $_POST['tim'];
                                    $agenda = $_POST['agenda'];
                                    $pemimpin = $_POST['pemimpin'];
                                    $daftar_peserta = $_POST['daftar-peserta'];
                                    $ruang = $_POST['ruang'];
                                     
                                     $sql = "INSERT INTO jadwal(tanggal, waktu_mulai, waktu_selesai, tim, agenda, pemimpin, daftar_peserta, ruang) 
                                            VALUES ('$tgl_mulai','$wkt_mulai','$wkt_selesai','$tim','$agenda','$pemimpin','$daftar_peserta','$ruang')";
                                     
                                     if(mysqli_query(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat"), $sql)){
                                         
 
                                     echo '<div class="alert alert-dismissible alert-success">';
                                     header('Location: '.$_SERVER['PHP_SELF']);
                                     echo '</div>';
                                         
                                     } else{
                                         echo "ERROR: Could not able to execute $sql. " . mysqli_error(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat"));
                                     }	
                                 }
                                 
                                 if(@$_POST['deleteModal']){
                                     $id = $_POST['zoom-id'];
                                     $sql = "DELETE FROM jadwal WHERE id='$id'";
                                    
									if(mysqli_query(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat"), $sql)){
									    echo '<div class="alert alert-dismissible alert-success">';
                                        header('Location: '.$_SERVER['PHP_SELF']);
                                        echo '</div>';
                                            
    									} else{
    										echo "ERROR: Could not able to execute $sql. " . mysqli_error(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat"));
    									}
                                 }

							// close conn
							mysqli_close(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_rapat"));
                            
						?>
                        
                        
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Tgl. Mulai</th>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col">Waktu Selesai</th>
                            <th scope="col">Tim</th>
                            <th scope="col">Agenda</th>
                            <th scope="col">Pemimpin Rapat</th>
                            <th scope="col">Daftar Peserta</th>
                            <th scope="col">Ruang Rapat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
</div>

<!--MODAL EDIT-->

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input class="form-control " type="hidden" name="zoom-id" id="zoom-id">
				<div class="modal-header">
					<button type="submit" class="close" data-dismiss="modal" aria-hidden="true" onclick=""><span id="" class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Edit Detail Meeting</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="akun">Tanggal Mulai:</label>
						<input class="form-control " type="text" placeholder="Masukkan Tanggal Mulai" id="tanggalmulai2" name="tanggalmulai2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Tanggal Selesai:</label>
						<input class="form-control " type="text" placeholder="Masukkan Tanggal Selesai" id="tanggalselesai2" name="tanggalselesai2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Waktu Mulai:</label>
						<input class="form-control " type="text" placeholder="Masukkan Waktu Mulai" id="waktumulai2" name="waktumulai2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Waktu Selesai:</label>
						<input class="form-control " type="text" placeholder="Masukkan Waktu Selesai" id="waktuselesai2" name="waktuselesai2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Tim:</label>
						<input class="form-control " type="text" placeholder="Masukkan Tim" id="tim2" name="tim2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Agenda:</label>
						<input class="form-control " type="text" placeholder="Masukkan Agenda" id="agenda2" name="agenda2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Pemimpin:</label>
						<input class="form-control " type="text" placeholder="Masukkan Nama Pemimpin Rapat" id="pemimpin2" name="pemimpin2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Daftar Peserta:</label>
						<input class="form-control " type="text" placeholder="Daftar Peserta" id="daftar_peserta2" name="daftar_peserta2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Ruang:</label>
						<input class="form-control " type="text" placeholder="Masukkan Ruang yang akan dipakai" id="ruang2" name="ruang2" value="">
					</div>
				</div>
				<div class="modal-footer ">
					<input type="submit" class="btn btn-success" name="edit" value="Simpan" id="edit-button">
				</div>
			</form>
			
    
		</div>
		<!-- /.modal-content --> 
	</div>
    <!-- /.modal-dialog --> 
</div>
<!--END MODAL EDIT-->

<!--MODAL DELETE-->
<!-- Modal Delete Product-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="modal-dialog" role="document">
        <input class="form-control " type="hidden" name="zoom-id" id="zoom-id">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Jadwal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
         
           <h4>Apakah anda yakin akan menghapus Rapat?</h4>
         
        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" class="id">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Yes</button>
        </div>
        </div>
    </div>
    </form>
    </div>
<!-- End Modal Delete Product-->
<!--END MODAL DELETE-->


<!-- UNTUKK REQ JADWAL  -->
<div class="modal fade" id="edit2" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">

			

			<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input class="form-control " type="hidden" name="zoom-id" id="zoom-id">
				<div class="modal-header">
					<button type="submit" class="close" data-dismiss="modal" aria-hidden="true" onclick=""><span id="" class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
					<h4 class="modal-title custom_align" id="Heading">Tambahkan Meeting</h4>
				</div>
				<div class="modal-body">
                    <div class="form-group">
						<label for="akun">Tanggal Mulai:</label>
						<input class="form-control " type="date" placeholder="Masukkan Tanggal" id="tanggal-mulai" name="tanggal-mulai">
					</div>
                    <div class="form-group">
						<label for="akun">Waktu Mulai:</label>
						<input class="form-control " type="time" placeholder="Masukkan Waktu Mulai" id="waktu-mulai" name="waktu-mulai">
					</div>
					<div class="form-group">
						<label for="idmeeting">Waktu Selesai:</label>
						<input class="form-control " type="time" placeholder="" id="waktu-selesai" name="waktu-selesai">
					</div>
                    <div class="form-group">
						<label for="akun">Tim:</label>
						<input class="form-control " type="text" placeholder="Masukkan nama Tim" id="tim" name="tim" value="">
					</div>
					<div class="form-group">
						<label for="idmeeting">Agenda:</label>
						<input class="form-control " type="text" placeholder="Masukkan deskripsi meeting" id="agenda" name="agenda">
					</div>
					<div class="form-group">
						<label for="idmeeting">Pemimpin:</label>
						<input class="form-control " type="text" placeholder="Masukkan pemimpin meeting" id="pemimpin" name="pemimpin">
					</div>
					<div class="form-group">
						<label for="idmeeting">Daftar Peserta:</label>
						<input class="form-control " type="text" placeholder="Masukkan daftar peserta" id="daftar-peserta" name="daftar-peserta">
					</div>
					<div class="form-group">
						<label for="idmeeting">Ruang:</label>
						<input class="form-control " type="text" placeholder="Masukkan ruang rapat" id="ruang" name="ruang">
					</div>
				</div>
				<div class="modal-footer ">
					<input type="submit" class="btn btn-success" name="edit2" value="Simpan" id="edit-button">
					
				</div>
			</form>
			
    
		</div>
		<!-- /.modal-content --> 
	</div>
    <!-- /.modal-dialog --> 
</div>





<script>
    $('.editId').on('click',function(){
    var id = $(this).data('id');
    var tglMulai = $(this).data('tanggalmulai');
    var waktuMulai = $(this).data('waktumulai');
    var waktuSelesai = $(this).data('waktuselesai');
    var tim = $(this).data('tim');
    var agenda = $(this).data('agenda');
    var pemimpin = $(this).data('pemimpin');
    var daftarpeserta = $(this).data('daftarpeserta');
    var ruang = $(this).data('ruang');
    
    $('#zoom-id').val(id);
    
    // input value menu edit 
    $('#id2').val(id);
    $('#tanggalmulai2').val(tglMulai);
    $('#waktumulai2').val(waktuMulai);
    $('#waktuselesai2').val(waktuSelesai);
    $('#tim2').val(tim);
    $('#agenda2').val(agenda);
    $('#pemimpin2').val(pemimpin);
    $('#daftar_peserta2').val(daftarpeserta);
    $('#ruang2').val(ruang);
    
    //ng kene awkmu ngisi form e, njupuk tekan db trs dideleh ng form e 
    });
    
    $('.btn-delete').on('click', function() {
       const id = $(this).data('id');
       $('#zoom-id').val(id);
       $('#deleteModal').modal('show');
    });
</script>

<!--DATATABLES SCRIPT-->
<script>
  $(document).ready(function () {

    $('#tabel-master tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    var tabel = $("#tabel-master").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });

    tabel.buttons().container()
      .appendTo('#tabel-master_wrapper .col-md-6:eq(0)');

  });

</script>
<!--DATATABLES SCRIPT END-->
</body>
</html>