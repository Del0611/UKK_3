<?php 
session_start(); 
include "connection.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }


    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: login.php?error=User Name is required");
        exit();
    }else if(empty($password)){
        header("Location: login.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM tb_admin WHERE username_staff ='$username' AND password_staff ='$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username_staff'] === $username && $row['password_staff'] === $password) {
                header("Location: dashboard.php?user=" . urlencode($row['username_staff']));
                exit();
            }else{
                header('Location: login.php?error=1');
                exit();
            }
        }else{
            header('Location: login.php?error=1');
            exit();
        }
    }
    
}else{
    header('Location: login.php?error=1');
    exit();
}