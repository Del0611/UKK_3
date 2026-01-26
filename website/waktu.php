<?php

include "connection.php";

// Menerima data dari JavaScript
$data = json_decode(file_get_contents("php://input"), true);

$waktu = $waktu['waktu']

// Menyimpan data ke database
$sql = "INSERT INTO tb_peserta (waktu) VALUES ('$waktu')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan ke database.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>