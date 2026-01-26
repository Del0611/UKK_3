<?php

include "connection.php";

$result = mysqli_query($conn, "SELECT * FROM tb_admin");

while ($row = mysqli_fetch_assoc($result)) {
$panggil_nama = $row['nama_staff'] . "<br>";
}

$result = mysqli_query($conn, "SELECT * FROM tb_admin");

while ($row = mysqli_fetch_assoc($result)) {
$panggil_jabatan = $row['jabatan'] . "<br>";
}



