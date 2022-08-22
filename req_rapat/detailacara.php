<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Meeting</title>

    <style>
        body {
            background-color: #F4F6F7;
            font-family: Arial;
        }

        #main_content {
            /* top: 160px;s */
            left: 50px;
            width: 1000px;
            /* min-height: 500px; */
            height: auto;
            background-color: #FFFFFF;
            position: relative;
            padding: 10px;
            padding-left: 15px;
            border-radius: 3px;
            box-shadow: 3px 3px 3px 3px grey;
            /* margin: auto; */
        }

        #container {
            width: 970px;
            /* height: auto; */
            padding-bottom: 10px;
            padding-top: 4px;
            padding-left: 20px;
            margin: 5px;
            position: relative;
            background-color: #F7F7F7;
            border-radius: 5px;
        }
    </style>

</head>
<body>
    <div id="main_content">
        <h1>Zoom Meeting BPS Kaltim</h1>
        <h3>Events Calendar</h3>
        <br>
        <hr>
        <br>
        <div id="container">
        
            <?php 
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // error reporting
                $dbConnection = new mysqli("localhost","u8152743_ipd","ipd@6400","u8152743_rapat");
                $dbConnection->set_charset('utf8mb4'); // charset
         
                $id = $_GET['id'];
                $newID = preg_replace("/'/i", '', $id);
                
                $stmt = $dbConnection->prepare("SELECT * FROM jadwal WHERE id=?");
                $stmt->bind_param('i', $newID); // 's' specifies the variable type => 'string'
                $stmt->execute();
                
                $result = $stmt->get_result();
                
                while($res = $result->fetch_assoc()) { 

                    echo "<p style='font-size:32px'>&nbsp;" . $res['deskripsi'] . "</p>";
                    $date = date_create($res['tanggal'] . " " . $res['waktu_mulai']);
                    $date2 = date_create($res['tanggal'] . " " . $res['waktu_selesai']);
                    
                    
                    echo "<p>&nbsp;" . date_format($date, "d/m/Y") . " s/d ". date_format($date2, "d/m/Y") . " [ " . $res['waktu_mulai'] . " ]</p>";
                    echo "<p>&nbsp;Host: " . $res['host']. "</p>";
                    echo "</br>";
                    // echo "<p style='text-transform:lowercase'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Contact: </b><a>". $res['pengguna']. "6400@bps.go.id</a></p>";    
    			    
                    mysqli_close($dbConnection);
                }
            
            ?>
        </div>
    </div>
    <br>
    <div class="c" style="padding-left:50px;"><p><a href="https://bpskaltim.com/rapat">Kembali</a></p></div>
</body>
</html>