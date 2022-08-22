<?php

$link = mysqli_connect("localhost", "root", "", "kalender_zoom");

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];


?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <?php
    $sql = "SELECT * FROM jadwal_zoom ";
    $result = mysqli_query($link, $sql); // using mysqli_query instead
    while($res = mysqli_fetch_array($result)) {    
        $tanggalmulai = $res['tanggal_mulai'] ;
        $tanggalselesai = $res['tanggal_selesai'];
        $waktumulai = $res['waktu_mulai'];
        $waktuselesai = $res['waktu_selesai'];
        $pengguna = $res['pengguna'];
        $deskripsi = $res['deskripsi'];
        $jmlpeserta = $res['jumlah_peserta'];
        $host = $res['host'];
        

        echo "<p>id:</p>";
        echo '<input type="text" name="id-zoom" value="'. $id . '">';
        echo "<p>Tanggal Mulai:</p>";
        echo '<input type="text" name="tglmulai-zoom" value="'. $tanggalmulai . '">';
        echo "<p>Tanggal Selesai:</p>";
        echo '<input type="text" name="tglselesai-zoom" value="'. $tanggalselesai . '">';
        echo "<p>Waktu Mulai:</p>";
        echo '<input type="text" name="waktumulai-zoom" value="'. $waktumulai . '">';
        echo "<p>Waktu Selesai:</p>";
        echo '<input type="text" name="waktuselesai-zoom" value="'. $waktuselesai . '">';
        echo "<p>Pengguna:</p>";
        echo '<input type="text" name="pengguna-zoom" value="'. $pengguna . '">';
        echo "<p>Deskripsi Meeting:</p>";
        echo '<input type="text" name="des-zoom" value="'. $deskripsi . '">';
        echo "<p>Jumlah Peserta:</p>";
        echo '<input type="text" name="jml-zoom" value="'. $jmlpeserta . '">';
        echo "<p>Host:</p>";
        echo '<input type="text" name="host-zoom" value="'. $host . '">';
    }
    ?>
        <p>Akun:</p>
        <input type="text" name="akun-zoom">
        <p>ID Meeting:</p>
        <input type="text" name="idmeeting-zoom">
        <p>Password:</p>
        <input type="text" name="pass-zoom">
        <p>Link:</p>
        <input type="text" name="link-zoom">
        <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>


<?php 
if(isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $akun = $_POST['akun_zoom'];
        $idmeeting = $_POST['idmeeting-zoom'];
        $pass = $_POST['pass-zoom'];
        $link = $_POST['link-zoom'];
    
        // update db 
        $sql = "UPDATE jadwal_zoom SET (akun_zoom='$akun', id_meeting='$idmeeting', password='$pass', link='$link') WHERE id=$id";
        if(mysqli_query($link, $sql)){
                    
            echo "Data berhasil direkam";
            
    
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
    
    // Close connection
    mysqli_close($link);
    header("location:../index.php");
}

// header('Location: '.$_SERVER['PHP_SELF']);


?>
<?php }; ?>




