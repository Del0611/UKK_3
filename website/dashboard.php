<?php
include "connection.php";
include "panggil_data.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #000066;
    }

    .header {
      background-color: #f0f8ff;
      color: #fff;
      padding-top: 1px;
      padding-bottom: 12px;
      text-align: center;
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

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .welcome-message {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
      color: #fff;
    }

    .user-info {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
      text-decoration: underline;
      color: #fff;
    }

    .user-info span {
      font-weight: bold;
    }

    .menu a {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #002e5e;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .menu a:hover {
      background-color: #45a049;
    }

    .logout a {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #002e5e;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .logout a:hover {
      background-color: #45a049;
    }



  </style>
</head>
<body>
  <div class="header">
    <h2><img src="gambar/logo 2.png" height="100" width="350"></h2>

    <div class="tomboldashboard">    
    <table>
      <tr>
        <td>
          <a href="cso.php">Tambah</a>
        </td>
          <form action="" method="GET">
        <td>
          <input type="text" name="keyword" placeholder="nomor NRP...">
        </td>
        <td>
          <input type="submit" value="Cari">
        </td>
        <td width="100%" align="right">
          <a href="tunda.php">Tunda</a>
        </td>
        <td width="100%" align="right">  
        <div class="logout">
          <a href="logout.php">Logout</a>
        </div>
      </td>
          </form>
      </tr>
    </table>
    </div>
  </div>

  <div class="container">
    <div class="welcome-message">
      <h3>Sahabat Perjuangan Anda Sepanjang Masa</h3>
    </div>
    <div class="user-info">

      <span>Nama Pengguna: <?php echo $panggil_nama ?> </span>
      <span>Jabatan: <?php echo $panggil_jabatan ?> </span>
    </div>

    <table align="center" border="1" bgcolor="#f0f8ff" ;>
    <tr bgcolor="#cc9900">
      <div>
      <td><b><center>Nomor Antrian</td>
      <td><b><center>NRP</td>
      <td><b><center>Nama</td>
      <td><b><center>Nomor Pensiun</td>   
      <td><b><center>Jenis Klaim</td>
      <td><b><center>Tracking</td>
      <td><b><center>Edit</td>
      <td><b><center>Hapus</td>
      </div>
    </tr>  

    <tr>
    <?php

    include "connection.php";

    if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    // Mengeksekusi query pencarian
    $ambildata = mysqli_query($conn,"SELECT * FROM tb_peserta WHERE nrp LIKE '%$keyword%'");

    // Memeriksa apakah ada hasil pencarian
    if (mysqli_num_rows($ambildata) > 0) {
        // Menampilkan hasil pencarian dalam bentuk daftar
      while ($tampil = mysqli_fetch_array($ambildata)) {
      echo"
      <tr>
      <td>$tampil[no_antrian]</td>
      <td>$tampil[nrp]</td>
      <td>$tampil[nama_peserta]</td>
      <td>$tampil[nomor_pensiun]</td>
      <td>$tampil[jenis_klaim]</td>"
    ?>

      <td><form action="tracking.php" method="GET">
      <input type="hidden" name="tracking" value="<?php echo $tampil['nomor_pensiun']; ?>">
      <button type="submit"><font style="padding: 5px; width: 80%; font-size: 16px; background-color: #002e5e; color: #fff; border: none; border-radius: 5px; cursor: pointer;" href="tracking.php">Tracking</font></button>
      </form></td>

      <td><form action="cso.php" method="GET">
      <input type="hidden" name="nomor_pensiun" value="<?php echo $tampil['nomor_pensiun']; ?>">
      <input type="image" src="icon/edit.png" alt="edit" width="24" href="cso.php">
      </form></td>


      <td align="center"><form action="hapus.php" method="GET">
      <input type="hidden" name="hapus" value="<?php echo $tampil['nomor_pensiun']; ?>">
      <input type="image" src="icon/delete.png" alt="hapus" width="24" name="hapus">
      
      </form></td>
      </tr>
    <?php } 
        }

    }else {
        
    
    include "connection.php";

    $ambildata = mysqli_query($conn,"SELECT * FROM tb_peserta");

    while ($tampil = mysqli_fetch_array($ambildata)) {
      echo"
      <tr>
      <td>$tampil[no_antrian]</td>
      <td>$tampil[nrp]</td>
      <td>$tampil[nama_peserta]</td>
      <td>$tampil[nomor_pensiun]</td>
      <td>$tampil[jenis_klaim]</td>"
    ?>

      <td><form action="tracking.php" method="GET">
      <input type="hidden" name="tracking" value="<?php echo $tampil['nomor_pensiun']; ?>">
      <button type="submit"><font style="padding: 5px; width: 80%; font-size: 16px; background-color: #002e5e; color: #fff; border: none; border-radius: 5px; cursor: pointer;" href="tracking.php">Tracking</font></button>
      </form></td>

      <td><form action="cso.php" method="GET">
      <input type="hidden" name="nomor_pensiun" value="<?php echo $tampil['nomor_pensiun']; ?>">
      <input type="image" src="icon/edit.png" alt="edit" width="24" href="cso.php">
      </form></td>


      <td align="center"><form action="hapus.php" method="GET">
      <input type="hidden" name="hapus" value="<?php echo $tampil['nomor_pensiun']; ?>">
      <input type="image" src="icon/delete.png" alt="hapus" width="24" name="hapus">
      
      </form></td>
      </tr>
    <?php } 
    } ?>
   
    </tr>

    </table>


  
  </div>
</body>
</html>