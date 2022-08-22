<html>
<head>
	<title>Client Zoom Request</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
	<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
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
        border:10px;
        /* padding:10px */
    }
    .modal-backdrop{
        z-index: 0;
    }
    


    .welcome{
        padding: 30px;    
    }

    #logout {
        color:black;
        text-align: right;
    }
	#divtabel{
		border:10px;
		padding:70px;
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
        <a class="navbar-brand" href="logout.php" id="logout">Logout</a>
      </ul>
    </div>
  </div>
</nav>


<?php 
include '../config.php';

$link = mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom");

// mengaktifkan session
session_start();

// cek apakah user telah login, jika belum login maka di alihkan ke halaman login
if($_SESSION['status'] !="login"){
	header("location:../index.php");
}

// menampilkan pesan selamat datang
echo "<div class='welcome' style='text-align:right'>" . " <p>Hai, selamat datang ". $_SESSION['username'] . "</p></div>";

$user = $_SESSION['username'];
if(isset($_POST['submit'])) {
	// ambil dari input user
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$tanggal_mulai = $_POST['zoom-start-date'];
		$tanggal_selesai = $_POST['zoom-end-date'];
		$waktu_mulai = $_POST['zoom-start-time'];
		$waktu_selesai = $_POST['zoom-end-time'];
		$pengguna = $_POST['zoom-pengguna'];
		$deskripsi = $_POST['zoom-deskripsi'];
		$radioval = $_POST["zoom-radio"];
		if($radioval == "<50"){
			$jumlah_peserta = $radioval;
		} else {
			$jumlah_peserta = $radioval;
		}
		$host = $_POST['zoom-host'];
		
		// insert db 
		$sql = "INSERT INTO jadwal_zoom (tanggal_mulai, tanggal_selesai, waktu_mulai, waktu_selesai, pengguna, deskripsi, jumlah_peserta, host, username) VALUES ('$tanggal_mulai', '$tanggal_selesai', '$waktu_mulai', '$waktu_selesai', '$pengguna', '$deskripsi','$jumlah_peserta','$host','$user')";

		if(mysqli_query($link, $sql)){
			
			echo "Data berhasil direkam";

		} else{
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
		}
		
	}
	// Close connection
// 	mysqli_close($link);

	header('Location: '.$_SERVER['PHP_SELF']);
	die;
	// $_POST['submit'] = array('');
}
	
?>



<br/>
<br/>




<div class="container">
  <h2>Form Request Zoom Meeting</h2>
  <br><br>
  <form id="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <div class="form-group">
      <label class="form-label mt-4" for="startdate">Tanggal Mulai:</label>
	  <div class="form-floating mb-3">
      	<input type="date" class="form-control" id="startdate" placeholder="Masukkan tanggal mulai" name="zoom-start-date">
	  </div>
    </div>
    <div class="form-group">
      <label class="form-label mt-4" for="enddate">Tanggal Selesai:</label>
      <input type="date" class="form-control" id="enddate" placeholder="Masukkan tanggal selesai" name="zoom-end-date">
    </div>
	<div class="form-group">
      <label class="form-label mt-4" for="starttime">Waktu Mulai:</label>
      <input type="time" class="form-control" id="starttime" placeholder="Masukkan waktu mulai" name="zoom-start-time">
    </div>
	<div class="form-group">
      <label class="form-label mt-4" for="endtime">Waktu Selesai:</label>
      <input type="time" class="form-control" id="endtime" placeholder="Masukkan waktu selesai" name="zoom-end-time">
    </div>
	<div class="form-group">
      <label class="form-label mt-4" for="pengguna">Pengguna:</label>
	  <div class="form-floating mb-3">
		<select id="pengguna" name="zoom-pengguna" required>
          <option value="IPDS">IPDS</option>
          <option value="Sosial">Bidang Statistik Sosial</option>
          <option value="Produksi">Bidang Statistik Produksi</option>
          <option value="Distribusi">Bidang Statistik Distribusi</option>
          <option value="Nerwilis">Bidang Neraca Wilayah dan Analisis Statistik</option>
          <option value="TU">Bagian Tata Usaha</option>
        </select>
	  </div>
    </div>
	<div class="form-group">
      <label class="form-label mt-4" for="deskripsi">Deskripsi:</label>
      <input type="text" class="form-control" id="deskripsi" placeholder="Masukkan deskripsi kegiatan" name="zoom-deskripsi">
    </div>
	<div class="">
      <label for="less50">Jumlah Peserta:</label><br>
      <input type="radio" class="" id="less50" name="zoom-radio" value="<50">
	  <label for="less50">Kurang dari 50 peserta</label><br>
	  <input type="radio" class="" id="more50" name="zoom-radio" value=">50">
	  <label for="more50">Lebih dari 50 peserta</label><br>
    </div>
	<div class="form-group">
      <label class="form-label mt-4" for="host">Host:</label>
      <input type="text" class="form-control" id="host" placeholder="Masukkan nama host kegiatan" name="zoom-host">
    </div>
	<br>
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
  </form>
</div>

<br><br><br>

<div id="divtabel">
	<h3 style="text-align:center;">Jadwal Zoom Meeting BPS Kaltim</h3>
	<br><br>
	<table class="table table-hover table-striped data-table" id="tabel-master">
		<thead class="thead-dark">
			<!--<th>ID</th>-->
			<th>Tgl. Mulai</th>
			<th>Tgl. Selesai </th>
			<th>Waktu Mulai </th>
			<!--<th>Waktu Selesai</th>-->
			<!--<th>Pengguna</th>-->
			<th>Deskripsi</th>
			<!--<th>Jumlah Peserta</th>-->
			<th>Host</th>
			<th>Akun Zoom</th>
			<th>Id Meeting</th>
			<th>Password</th>
			<th>Link</th>
			<th>Aksi</th>
		</thead>
		
		<?php 
// 		$link = mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom");
		$user = $_SESSION['username'];
		
		
		/*$result = mysqli_query($link, "SELECT * FROM u8152743_kalender_zoom.jadwal_zoom ORDER BY id ASC"); // using mysqli_query instead
		while($res = mysqli_fetch_array($result)) {         
			echo "<tr>";
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
			echo "<td><a href='".$res['link']."'>". $res['link'] ."</a></td>";
			echo '<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button type="submit" name = "id" value="value" class="editId btn btn-primary btn-xs" data-id="'.$res['id'].'" data-akunzoom="'.$res['akun_zoom'].'" data-tanggalmulai="'.$res['tanggal_mulai'].'" data-tanggalselesai="'.$res['tanggal_selesai'].'" data-waktumulai="'.$res['waktu_mulai'].'" data-waktuselesai="'.$res['waktu_selesai'].'" data-host="'.$res['host'].'"  data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>';
			echo "</tr>";				
		} */
		
		$orang = mysqli_query($link, "SELECT * FROM u8152743_lk.master_pegawai WHERE u8152743_lk.master_pegawai.niplama = (SELECT u8152743_lk.autentifikasi.niplama FROM u8152743_lk.autentifikasi WHERE u8152743_lk.autentifikasi.username = '$user')");
		
		while ($org = mysqli_fetch_array($orang)){
		    if ($org['id_org'] == '92820' || $org['id_org'] == '92200' || $org['id_org'] == '92220' || $org['id_org'] == '92210' || $org['id_org'] == '92230') {
		        $result = mysqli_query($link, "SELECT * FROM jadwal_zoom WHERE pengguna = 'Sosial'");
		    } else if ($org['id_org'] == '92860' || $org['id_org'] == '92610' || $org['id_org'] == '92600' || $org['id_org'] == '92620' || $org['id_org'] == '92630') {
		        $result = mysqli_query($link, "SELECT * FROM jadwal_zoom WHERE pengguna = 'IPDS'");
		    } else if ($org['id_org'] == '92300' || $org['id_org'] == '92830' || $org['id_org'] == '92310' || $org['id_org'] == '92320' || $org['id_org'] == '92330') {
		        $result = mysqli_query($link, "SELECT * FROM jadwal_zoom WHERE pengguna = 'Produksi'");
		    } else if ($org['id_org'] == '92500' || $org['id_org'] == '92510' || $org['id_org'] == '92520' || $org['id_org'] == '92850' || $org['id_org'] == '92530') {
		        $result = mysqli_query($link, "SELECT * FROM jadwal_zoom WHERE pengguna = 'Nerwilis'");
		    } else if ($org['id_org'] == '92840' || $org['id_org'] == '92400' || $org['id_org'] == '92410' || $org['id_org'] == '92420' || $org['id_org'] == '92430') {
		        $result = mysqli_query($link, "SELECT * FROM jadwal_zoom WHERE pengguna = 'Distribusi'");
		    } else if ($org['id_org'] == '92810' || $org['id_org'] == '92100' || $org['id_org'] == '92110' || $org['id_org'] == '92120' || $org['id_org'] == '92130' || $org['id_org'] == '92140' || $org['id_org'] == '92150') {
		        $result = mysqli_query($link, "SELECT * FROM jadwal_zoom WHERE pengguna = 'TU'");
		    }
		    
		    while ($res = mysqli_fetch_array($result)) {
		        echo "<tr>";
    // 			echo "<td>".$res['id']."</td>";
    			echo "<td>".$res['tanggal_mulai']."</td>";
    			echo "<td>".$res['tanggal_selesai']."</td>";
    			echo "<td>".$res['waktu_mulai']."</td>";    
    // 			echo "<td>".$res['waktu_selesai']."</td>";
    // 			echo "<td>".$res['pengguna']."</td>";
    			echo "<td>".$res['deskripsi']."</td>";
    // 			echo "<td>".$res['jumlah_peserta']."</td>";
    			echo "<td>".$res['host']."</td>";
    			echo "<td>".$res['akun_zoom']."</td>";
    			echo "<td>".$res['id_meeting']."</td>";
    			echo "<td>".$res['password']."</td>";
    			echo "<td><a href='".$res['link']."'>". $res['link'] ."</a></td>";
    			echo '<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button type="submit" name = "id" value="value" class="editId btn btn-primary btn-xs" data-id="'.$res['id'].'" data-akunzoom="'.$res['akun_zoom'].'" data-tanggalmulai="'.$res['tanggal_mulai'].'" data-tanggalselesai="'.$res['tanggal_selesai'].'" data-waktumulai="'.$res['waktu_mulai'].'" data-waktuselesai="'.$res['waktu_selesai'].'" data-host="'.$res['host'].'"  data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>';
    			echo "</tr>";	
		    }
		}
		
		if(@$_POST['edit']){
            $id= $_POST['zoom-id'];
            $tglmulai = $_POST['zoom-tanggalmulai2'];
            $tglselesai = $_POST['zoom-tanggalselesai2'];
            $wktmulai = $_POST['zoom-waktumulai2'];
            $wktselesai = $_POST['zoom-waktuselesai2'];
			$akun = $_POST['zoom-akun'];
			$id_meeting = $_POST['zoom-id-meeting'];
			$pass = $_POST['zoom-pass'];
			$link = $_POST['zoom-link'];
			$host2 = $_POST['zoom-host2'];
			
			$sql = "UPDATE jadwal_zoom SET tanggal_mulai = '$tglmulai', tanggal_selesai = '$tglselesai', waktu_mulai = '$wktmulai', waktu_selesai = '$wktselesai', host = '$host2' WHERE id = $id";
            //$sql = "INSERT INTO jadwal_zoom(akun_zoom, id_meeting, password, link) VALUES ('$akun', '$id_meeting', '$pass','$link') WHERE id = $id";
			if(mysqli_query(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom"), $sql)){
				

            echo '<div class="alert alert-dismissible alert-success">';
            // echo '<strong>Data Berhasil Direkam.</strong> Silakan <a href="../client/index.php"> Refresh </a> Browser Anda.';
            echo '</div>';
            header('Location: '.$_SERVER['PHP_SELF']);
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error(mysqli_connect("localhost", "u8152743_ipd", "ipd@6400", "u8152743_kalender_zoom"));
			}	
		}

		mysqli_close($link);
		?>
		<tfoot>
            <tr>
                <!--<th scope="col">No.</th>-->
                <!--<th>ID</th>-->
    			<th>Tanggal Mulai</th>
    			<th>Tanggal Selesai </th>
    			<th>Waktu Mulai </th>
    			<!--<th>Waktu Selesai</th>-->
    			<!--<th>Pengguna</th>-->
    			<th>Deskripsi</th>
    			<!--<th>Jumlah Peserta</th>-->
    			<th>Host</th>
    			<th>Akun Zoom</th>
    			<th>Id Meeting</th>
    			<th>Password</th>
    			<th>Link</th>
    			<th>Aksi</th>
            </tr>
        </tfoot>
	</table>
</div>
<!-- <a href="logout.php">LOGOUT</a> -->

<!--MENU EDIT-->

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
						<label for="akun">Tanggal Mulai:</label>
						<input class="form-control " type="text" placeholder="Masukkan Tanggal Mulai" id="tanggalmulai2" name="zoom-tanggalmulai2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Tanggal Selesai:</label>
						<input class="form-control " type="text" placeholder="Masukkan Tanggal Selesai" id="tanggalselesai2" name="zoom-tanggalselesai2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Waktu Mulai:</label>
						<input class="form-control " type="text" placeholder="Masukkan Waktu Mulai" id="waktumulai2" name="zoom-waktumulai2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Waktu Selesai:</label>
						<input class="form-control " type="text" placeholder="Masukkan Waktu Selesai" id="waktuselesai2" name="zoom-waktuselesai2" value="">
					</div>
					<div class="form-group">
						<label for="akun">Host:</label>
						<input class="form-control " type="text" placeholder="Masukkan Nama Host" id="host2" name="zoom-host2" value="">
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

<script>
    $('.editId').on('click',function(){
    var zoomId = $(this).data('id');
    var zoomHost = $(this).data('host');
    var zoomTglMulai = $(this).data('tanggalmulai');
    var zoomTglSelesai = $(this).data('tanggalselesai');
    var zoomWaktuMulai = $(this).data('waktumulai');
    var zoomWaktuSelesai = $(this).data('waktuselesai');
    
    console.log(zoomId);
    $('#zoom-id').val(zoomId);
    
    // input value menu edit 
    $('#tanggalmulai2').val(zoomTglMulai);
    $('#tanggalselesai2').val(zoomTglSelesai);
    $('#waktumulai2').val(zoomWaktuMulai);
    $('#waktuselesai2').val(zoomWaktuSelesai);
    $('#host2').val(zoomHost);
    
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
