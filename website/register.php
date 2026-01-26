<?php
session_start();

// Cek apakah pengguna sudah login. Jika sudah, alihkan ke halaman dashboard
if (isset($_SESSION['username_staff'])) {
  header('Location: dashboard.php');
  exit;
}

// Inisialisasi variabel error
$errors = array();

// Proses saat tombol "Daftar" diklik
if (isset($_POST['register'])) {
  // Ambil data yang dikirim dari formulir registrasi
  $nama_staff = $_POST['nama_staff'];
  $jabatan = $_POST['jabatan'];
  $username_staff = $_POST['username_staff'];
  $password_staff = $_POST['password_staff'];
  

  // Validasi data
  if (empty($username_staff)) {
    $errors[] = 'Nama pengguna harus diisi';
  }

  if (empty($password_staff)) {
    $errors[] = 'Kata sandi harus diisi';
  }

  // Jika tidak ada kesalahan, lakukan proses registrasi
  if (count($errors) === 0) {
    // Simpan data pengguna ke database (misalnya, ke tabel "users")

  include "connection.php";

  // Query untuk menyimpan data pengguna baru
    $sql = "INSERT INTO tb_admin (id_staff, nama_staff, jabatan, username_staff, password_staff) VALUES ('', '$nama_staff', '$jabatan', '$username_staff', '$password_staff')";

    // Jalankan query
    if (mysqli_query($conn, $sql)) {
      // Registrasi berhasil, alihkan ke halaman login
      header('Location: login.php');
      exit;
    } else {
      // Registrasi gagal, tampilkan pesan kesalahan
      $errors[] = 'Gagal melakukan registrasi. Silakan coba lagi.';
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
  }
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
  <h2>Registrasi</h2>

  <?php if (count($errors) > 0) { ?>
    <ul style="color: red;">
      <?php foreach ($errors as $error) { ?>
        <li><?php echo $error; ?></li>
      <?php } ?>
    </ul>
  <?php } ?>

  <table>

  <form action="register.php" method="POST">
  <tr>
  <td>
      <label for="nama">Nama :</label>
      <input type="text" id="nama_staff" name="nama_staff" maxlength="30" required>
  </td>
  </tr>

  <tr>
  <td>
      <label for="fruit">Jabatan :</label>
      <select id="jabatan" name="jabatan" required>
      <option value="CSO">CSO</option>
      <option value="Yanggan">Staff Yanggan</option>
      <option value="ADUM">Staff Administrasi dan Umum</option>
      </select>
  </td>
  </tr>

  <tr>
  <td>
      <label for="username">Username :</label>
      <input type="text" id="username_staff" name="username_staff" maxlength="20" required>
  </td>
  </tr> 

  <tr>
  <td>
      <label for="password">Password :</label>
      <input type="text" id="password_staff" name="password_staff" maxlength="20" required>
  </td>
  </tr>    

  </table>
  <div class="registercss table">
  <table>
  <tr>
  <td>
      <a href="login.php" >Kembali</a> 
  </td>
  <td>
      <input type="submit" name="register" value="Daftar">
  </td>
  </tr>
  </table>
  </div>

  </form>
  </div>
</body>
</html>