  <?php

        include "connection.php";

        if (isset($_GET['hapus'])) {
        $menghapus = $_GET['hapus'];

        $result = mysqli_query($conn, "SELECT * FROM tb_peserta WHERE nomor_pensiun = $menghapus ");

        while ($row = mysqli_fetch_assoc($result)) {
        $hapus_nrp = $row['nrp'];
        $hapus_jenis_klaim = $row['jenis_klaim'];
      }

        // Mengeksekusi query pencarian
        mysqli_query($conn,"DELETE FROM tb_peserta WHERE nrp = '$hapus_nrp' && jenis_klaim = '$hapus_jenis_klaim'")or die(mysql_error());
 
        header("location:dashboard.php");
      }
      ?>