<?php
session_start();

  include "connection.php";


  if(isset($_GET['nomor_pensiun'])){
  $nomor_pensiun = $_GET['nomor_pensiun'];

  $result = mysqli_query($conn, "SELECT * FROM tb_peserta WHERE nomor_pensiun LIKE '$nomor_pensiun' ");

  while ($row = mysqli_fetch_assoc($result)) {
  $no_antrian = $row['no_antrian'];
  $nrp = $row['nrp'];
  $nama_peserta = $row['nama_peserta'];
  $nomor_pensiun = $row['nomor_pensiun'];
  $jenis_klaim = $row['jenis_klaim'];
  }


  if (isset($_POST['register'])) {
  // Ambil data yang dikirim dari formulir registrasi
  $no_antrian = $_POST['no_antrian'];
  $nrp = $_POST['nrp'];
  $nama_peserta = $_POST['nama_peserta'];
  $nomor_pensiun = $_POST['nomor_pensiun'];
  $jenis_klaim = $_POST['jenis_klaim'];


  // Query untuk menyimpan data pengguna baru
    $sql = "UPDATE tb_peserta SET (no_antrian, nrp, nama_peserta, nomor_pensiun, jenis_klaim, waktu, status) VALUES ('$no_antrian', '$nrp', '$nama_peserta', '$nomor_pensiun', '$jenis_klaim', '$waktu', '11') WHERE nomor_pensiun = '$nomor_pensiun'";

  // Jalankan query
    if (mysqli_query($conn, $sql)) {
      // Registrasi berhasil, alihkan ke halaman login
      header('Location: dashboard.php');
      exit;
    } else {
      // Registrasi gagal, tampilkan pesan kesalahan
      $errors[] = 'Gagal melakukan registrasi. Silakan coba lagi.';
    }


    // Tutup koneksi ke database
    mysqli_close($conn);
  }

  } 
  if (isset($_POST['register'])) {
  // Ambil data yang dikirim dari formulir registrasi
  $no_antrian = $_POST['no_antrian'];
  $nrp = $_POST['nrp'];
  $nama_peserta = $_POST['nama_peserta'];
  $nomor_pensiun = $_POST['nomor_pensiun'];
  $jenis_klaim = $_POST['jenis_klaim'];
  $waktu = $_POST['waktu'];

  // $sql = "UPDATE tb_peserta SET no_antrian = '$no_antrian', nrp = '$nrp', nama_peserta = '$nama_peserta', nomor_pensiun = '$nomor_pensiun', jenis_klaim = '$jenis_klaim' WHERE nomor_pensiun = '$nomor_pensiun'";

  // Query untuk menyimpan data pengguna baru
  $sql = "INSERT INTO tb_peserta (no_antrian, nrp, nama_peserta, nomor_pensiun, jenis_klaim, waktu, status) VALUES ('$no_antrian', '$nrp', '$nama_peserta', '$nomor_pensiun', '$jenis_klaim', '$waktu','11')";

  mysqli_query($conn, "DELETE FROM tb_peserta WHERE nrp = '$nrp' && jenis_klaim = '$jenis_klaim'")or die(mysql_error());

  // Jalankan query
    if (mysqli_query($conn, $sql)) {
      // Registrasi berhasil, alihkan ke halaman login
      header('Location: dashboard.php');
      exit;
    } else {
      // Registrasi gagal, tampilkan pesan kesalahan
      $errors[] = 'Gagal melakukan registrasi. Silakan coba lagi.';
    }


    // Tutup koneksi ke database
    mysqli_close($conn);
  }

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

  <title>Registrasi</title>
</head>
<body>

  <img src="gambar/logo.png" alt="PT Asabri" width="250" height="250"> 

  <div class="registercss">
  <h2>Data Peserta</h2>

  <table>

  <form id="cso" action="cso.php" method="POST">
  <tr>
  <td>
      <label for="nama">Nomor Antrian :</label>
      <input type="text" id="no_antrian" name="no_antrian" value="<?php if(isset($_GET['nomor_pensiun'])){ echo "$no_antrian";} else{echo "";}?>" maxlength="20" required>
  </td>
  </tr>

  <tr>
  <td>
      <label for="nama">NRP :</label>
      <input type="text" id="nrp" name="nrp" value="<?php if(isset($_GET['nomor_pensiun'])){ echo "$nrp";} else{echo "";}?>" maxlength="30" required>
  </td>
  </tr>

   <tr>
  <td>
      <label for="nama">Nama :</label>
      <input type="text" id="nama_peserta" name="nama_peserta" value="<?php if(isset($_GET['nomor_pensiun'])){ echo "$nama_peserta";} else{echo "";}?>" maxlength="30" required>
  </td>
  </tr>

   <tr>
  <td>
      <label for="nama">Nomor Pensiun :</label>
      <input type="text" id="nomor_pensiun" name="nomor_pensiun" value="<?php if(isset($_GET['nomor_pensiun'])){ echo "$nomor_pensiun";} else{echo "";}?>" maxlength="30" required>
  </td>
  </tr>

  <tr>
  <td>
      <label for="jenis_klaim">Jenis Klaim :</label>
      <select id="jenis_klaim" name="jenis_klaim" required>
      <option value="THT">Tunjangan Hari Tua</option>
      <option value="JKM">Jaminan Kematian</option>
      <option value="JKK">Jaminan Kecelakaan Kerja</option>
      <option value="PENSIUN">Pensiun</option>
      </select>

      <input type="hidden" id="waktu" name="waktu">
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
      <input type="submit" id="register" name="register" value="Daftar" onclick="tombol()">
  </td>
  </tr>
  </table>
  </div>

  </form>
  </div>

   <script>
        // Set tanggal default ke tanggal saat ini
        const today = new Date();
        const dateString = today.toISOString().split('T')[0]; // Format tanggal YYYY-MM-DD
        document.getElementById("waktu").value = dateString;
    </script>

</body>
</html>