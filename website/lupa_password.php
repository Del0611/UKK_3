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

    .lupapasscss {
      font-family: Arial, sans-serif;
      font-size: 16px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    table {
      border-spacing: 20px;
    }

    .lupapasscss input[type="submit"],
    .lupapasscss button {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #002e5e;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .lupapasscss input[type="submit"]:hover,
    .lupapasscss button:hover {
      background-color: #45a049;
    }

    a {
     width: 100%;
     padding: 10px;
     font-size: 16px;
     background-color: #002e5e;
     color: #fff;
     border: none;
     border-radius: 5px;
     cursor: pointer;
    }

    a:hover {
      background-color: #45a049;
    }

  </style>

  <script>
    function goBack() {
    window.history.back();
  }
  </script>

  <title>Lupa Password</title>
</head>
<body>
 <img src="gambar/logo.png" alt="PT Asabri" width="250" height="250"> 
<div class="lupapasscss">
   <h2>Pengigat</h2>
<table>
<form action="lupa_password.php" method="POST">
  <tr>
  <td>
  <label for="nama">Nama :</label>
  <input type="text" id="nama_staff" name="nama_staff" maxlength="30" required>
  </td>
  </tr>
</table>
<table>
  <tr>
  <td> 
  <a href="login.php">Kembali</a>
  </td>
  <td> 
  <input type="submit" name="lupa_password" value="Pengingat Password">
  </td>
  </tr>
  <tr>
  <td>
  <label type="text" id="password" name="password" ></label>
  </td>
  </tr>
</form>
  <tr>
    <td>

<?php
session_start();

include "connection.php";

if (isset($_POST['lupa_password'])) {
  // Ambil data yang dikirim dari formulir registrasi
  $nama_staff = $_POST['nama_staff'];

// Query untuk mengambil password pengguna berdasarkan nama pengguna

$sql = "SELECT password_staff FROM tb_admin WHERE nama_staff = '$nama_staff'";
$result = mysqli_query($conn, $sql);

// Periksa apakah query berhasil dijalankan
if (!$result) {
  die('Error: ' . mysqli_error($conn));
}

// Ambil password dari hasil query
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $password_staff = $row['password_staff'];
} else {
  // Tidak ada pengguna dengan nama pengguna yang diberikan
  $password_staff = null;
} if ($password_staff !== null) {
  // Lakukan sesuatu dengan password (misalnya, verifikasi)
  echo 'Password pengguna: ' . $password_staff;
} else {
  echo "Tidak ada pengguna";
}

// Tutup koneksi ke database
mysqli_close($conn);
}
?>
 

    </td>
  </tr>
</table>
</div>
</body>
</html>
