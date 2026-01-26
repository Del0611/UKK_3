<?php
session_start();

  include "connection.php";

  if (isset($_GET['nomor_pensiun'])) {
  // Ambil data yang dikirim dari formulir registrasi
  $adum_nomor_pensiun = $_GET['nomor_pensiun'];
}
   if (isset($_POST['adum'])) {
  // Ambil data yang dikirim dari formulir registrasi  
  $adum_status = $_POST['status'];
  $adum_keterangan = $_POST['keterangan'];

 

  // Query untuk menyimpan data pengguna baru

     $sql = "UPDATE tb_peserta SET status = '$adum_status', keterangan = '$adum_keterangan' WHERE nomor_pensiun = '$adum_nomor_pensiun'";

  // Jalankan query
   if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
                exit();
    } else {
        echo "Error : " . $conn->error;
    }
    } else {
    echo "";
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
    
  ?>


<!DOCTYPE html>
<html>
<head>

   <style>

    body {
      background-color: #f2f2f2;
      margin: 0px;
      padding: 0px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .registercss {
      font-family: Arial, sans-serif;
      font-size: 16px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table {
      border-spacing: 20px;
      align-items: center;
    }

    .registercss table {
      width: 100%;
    }

    select {
      font-size: 16px;
    }

    .registercss input[type="text"] {
      width: 100%;
      height:10px;
      align-items: center;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .registercss input[type="submit"] ,
    .registercss a {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #002e5e;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .registercss input[type="submit"]:hover,
    .registercss a:hover {
      background-color: #45a049;
    }

  </style>

  <script>
    function goBack() {
    window.history.back();
  }
  </script>

  <title>ADUM</title>
</head>
<body>

  <img src="gambar/logo.png" alt="PT Asabri" width="250" height="250"> 

  <div class="registercss">
  <h2>Administrasi dan Umum</h2>

  <table>

  <form action="" method="POST">
  <tr>
 
  <td>
  <p2>Status Berkas :</p2>
  </td>
  <td>
  <input type="radio" id="Valid" name="status" value="31">
  <label for="Valid"><font style="padding: 5px; width: 25px; font-size: 20px; background-color: #002e5e; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Valid</font></label>
  </td>
  
  <td>
    <input type="radio" id="TidakValid" name="status" value="32">
  <label for="TidakValid"><font style="padding: 5px; width: 25px; font-size: 20px; background-color: #002e5e; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Tidak Valid</font></label>
  </td>
  </tr>

   <tr>
  <td>
      <label for="nama">Keterangan : </label>
      <input type="textarea" id="keterangan" name="keterangan" maxlength="150" required>
  </td>
  </tr>

  </table>
  <div class="registercss table">
  <table>
  <tr>
  <td>
      <a href="dashboard.php" >Kembali</a> 
  </td>
  <td>
      <input type="submit" name="adum" value="Kirim">
  </td>
  </tr>
  </table>
  </div>

  </form>
  </div>
</body>
</html>