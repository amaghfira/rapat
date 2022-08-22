<?php
 
 include "../config.php";
 $i=0;
 $cek = mysqli_query($host,"SELECT * FROM jadwal_zoom ORDER BY tanggal_mulai ASC");

// utk jam, ambil jam paling pagi dan paling malam
$empty_array = array();
while($b = mysqli_fetch_assoc($cek)){
    $i = $i + 1;
    $empty_array[] = [
        0 => $b['id'],
        1 => $b['tanggal_mulai'],
        2 => $b['tanggal_selesai'],
        3 => $b['waktu_mulai'],
        4 => $b['waktu_selesai'],
        5 => $b['pengguna'],
        6 => $b['deskripsi'],
        7 => $b['jumlah_peserta'],
        8 => $b['host'],
        9 => $b['akun_zoom'],
        10 => $b['id_meeting'],
        11 => $b['password'],
        12 => $b['link'],
        13 => '<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button type="submit" name = "id" value="value" class="editId btn btn-primary btn-xs" data-id="'.$res['id'].'" data-akunzoom="'.$res['akun_zoom'].'" data-tanggalmulai="'.$res['tanggal_mulai'].'" data-tanggalselesai="'.$res['tanggal_selesai'].'" data-waktumulai="'.$res['waktu_mulai'].'" data-waktuselesai="'.$res['waktu_selesai'].'" data-idmeeting="'.$res['id_meeting'].'" data-password="'.$res['password'].'" data-link="'.$res['link'].'" data-host="'.$res['host'].'" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>'
        
    ];

}

// JSON objects 
$json_data = json_encode($empty_array);

$json_data2 = '{ "data" : ' . $json_data . '}';
header('Content-type: application/json');
echo $json_data2;

mysqli_close($host);
 ?>