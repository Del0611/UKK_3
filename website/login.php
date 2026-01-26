<?php

session_start();

// Cek apakah pengguna sudah login. Jika sudah, alihkan ke halaman dashboard
if (isset($_SESSION['username_staff'])) {
  header('Location: dashboard.php');
  exit;
}


?>

<!DOCTYPE html>
<html>

<head>

    <style>

    body {
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    table {
        border-spacing: 20px;
    }

    .login-container {
      font-family: Arial, sans-serif;
      font-size: 16px;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      height:10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 2px;
    }

    .login-container input[type="submit"],
    .login-container_1 a {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      background-color: #002e5e;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .login-container_1 a:hover {
      background-color: #45a049;
    }

    .login-container input[type="submit"]:hover {
      background-color: #45a049;
    }

    .password-toggle label {
      align-items: center;
      font-size: 12px;
      margin-top: 10px;
    }

    .password-toggle input[type="checkbox"] {
      margin-right: 1px;
    }

  </style>

  <script>
    function togglePasswordVisibility() {
      var passwordInput = document.getElementById("password");
      var passwordToggle = document.getElementById("password-toggle");

      if (passwordToggle.checked) {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }
  </script>

  <title>Login Asabri</title>
</head>
<body>
    
    <img src="gambar/logo.png" alt="PT Asabri" width="250" height="250">   
    
    <div class="login-container">
         <h2>Login</h2>

      <?php
  // Tampilkan pesan kesalahan (jika ada)
  if (isset($_GET['error'])) {
    echo '<p style="color: red;">Nama pengguna atau kata sandi salah!</p>';
  }
  ?>

    <table>
    <form action="proses_login.php" onsubmit="return isvalid()" method="POST">
    
    <tr>
    <td>
      <label for="username">Username :</label>
      <input type="text" id="username" name="username" maxlength="20" required>
    </td>
    </tr>

    <tr>
    <td>
      <label for="password">Password :</label>
      <input type="password" id="password" name="password" maxlength="20" required>
    <div class="password-toggle">   
      <input type="checkbox" id="password-toggle" onchange="togglePasswordVisibility()">
      <label for="password-toggle">Tampilkan Kata Sandi</label>
    </div>
    </td>
    </tr>

    <tr>
    <td>
    <a class="small" href="lupa_password.php">Lupa Password?</a>
    </td>

    <td>
    <div class="login-container_1">
    <a class="small" href="register.php">Register</a>
    </div>
    </td>
    
    <td>        
      <input type="submit" value="Login" id="tombol">
    </td>
    </tr>

    </form>
    </table>
    </div>    

</body>
</html>