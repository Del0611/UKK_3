<?php

include "connection.php";

// Ambil nomor pelacakan dari formulir
if(isset($_GET['tracking'])){
$tracking_number = $_GET['tracking'];
}

$result = mysqli_query($conn, "SELECT * FROM tb_peserta WHERE nomor_pensiun LIKE '%$tracking_number%' ");

while ($row = mysqli_fetch_assoc($result)) {
$tracking_nama = $row['nama_peserta'];
$tracking_nrp = $row['nrp'];
$tracking_nomor_pensiun = $row['nomor_pensiun'];
$tracking_status = $row['status'];
$tracking_waktu = $row['waktu'];
$tracking_keterangan = $row['keterangan'];
}

?>

<!DOCTYPE html>
<html>
<head>
<style>

body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #000066;
    }

.gambar img {
	width: 100px;
	height: 100px;
}  		

.header {
      background-color: #f0f8ff;
      color: #fff;
      padding-top: 1px;
      padding-bottom: 12px;
      text-align: center;
    }

 .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0px;
    }

   .welcome-message {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      color: #fff;
    }

  .tomboldashboard a {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #002e5e;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

     .tomboldashboard a:hover {
      background-color: #45a049;
    }


</style>
  <title>Hasil Pelacakan</title>
</head>
<body>
 <div class="header">
    <h2><img src="gambar/logo 2.png" height="100" width="350"></h2>
    <div class="tomboldashboard">   
      <table width="100%">
        <tr>
          <td align="right">
            <a href="dashboard.php" >Kembali</a>
          </td></tr></table>
        </div>
      </div>

      <div class="container">
    <div class="welcome-message">
      <h3>Status Tracking</h3>
    </div>

<table border="1" bgcolor="#f0f8ff">
  <tr><td><b>Nama :<?php echo $tracking_nama ?></tr>
  <tr><td><b>NRP  :<?php echo $tracking_nrp ?></td>
  </table>
  

  <table align="center" cellspacing="40px">
  <tr>
  	
  <td>
  <div class="gambar" id="gambar1">
  <form action="cso.php" method="GET">
  <input type="hidden" name="nomor_pensiun" value="<?php echo $tracking_nomor_pensiun; ?>">
  <button type="submit" style="background-color:rgb(0, 0, 102); border: 0;"  href="cso.php"><img src="icon/<?php if($tracking_status == 11){
    echo "Valid.png";
  } elseif($tracking_status == 21) {
    echo "Valid.png";
  } elseif($tracking_status == 22) {
    echo "Valid.png";
  } elseif($tracking_status == 31) {
    echo "Valid.png";
  } elseif($tracking_status == 32) {
    echo "Valid.png";
  } else {
  echo "NoProgres.png";
  }
  ; ?>" alt=""></button>
  </form>
  <h2 align="center" style="color: #fff;">CSO</h2>
  </a>
  </div>
  </td>

  <td>
  <div class="gambar" id="gambar2">
  <form action="yanggan.php" method="GET">
  <input type="hidden" name="nomor_pensiun" value="<?php echo $tracking_nomor_pensiun; ?>">
  <button type="submit" style="background-color:rgb(0, 0, 102); border: 0;" href="yanggan.php"><img src="icon/<?php if($tracking_status == 21){
    echo "Valid.png";
  } elseif($tracking_status == 22) {
    echo "TidakValid.png";
  } elseif($tracking_status == 31) {
    echo "Valid.png";
  } elseif($tracking_status == 32) {
    echo "Valid.png";
  } else {
    echo "NoProgres.png";
  }
  ; ?>" alt=""></button>
  </form>
  <h2 align="center" style="color: #fff;">Yanggan</h2>
  </div>
  </td>

  <td>
  <div class="gambar" id="gambar3">
  <form action="adum.php" method="GET">
  <input type="hidden" name="nomor_pensiun" value="<?php echo $tracking_nomor_pensiun; ?>">
  <button type="submit" style="background-color:rgb(0, 0, 102); border: 0;" href="adum.php"><img src="icon/<?php if($tracking_status == 31){
    echo "Valid.png";
  } elseif($tracking_status == 32) {
    echo "TidakValid.png";
  } else {
    echo "NoProgres.png";
  }
  ; ?>" alt=""></button>
  </form>
  <h2 align="center" style="color: #fff;">ADUM</h2>
  </div>
  </td>

  <td>
  <div class="gambar" id="gambar4">
  <img src="icon/<?php if($tracking_status == 31){
    echo "Valid.png";
  } else {
    echo "NoProgres.png";
  }
  ;?>" alt="">
  <h2 align="center" style="color: #fff;">Selesai</h2>
  </div>
  </td>  
  </tr> 

  </table>

  <table border="2" align="center" bgcolor="#f0f8ff">
  <tr bgcolor="#cc9900">
  <td width="100px" align="center">
  <font size="4px"><b>Waktu</b></font>
  </td>
  <td width="800px" align="center">
  <font size="4px"><b>Keterangan</b></font>
  </td>
  </tr>
  <tr>
  <td><?php echo "$tracking_waktu";?></td>
  <td><?php echo "$tracking_keterangan";?></td>	
  </tr>
  </table>

</body>
</html>