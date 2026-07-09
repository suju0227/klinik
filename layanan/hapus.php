<?php
include "../config/koneksi.php";

// Cek apakah ID dikirim
if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Hapus data layanan
    $hapus = mysqli_query($koneksi, "
        DELETE FROM layanan
        WHERE id_layanan = '$id'
    ");

    if ($hapus) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Berhasil</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>

        <script>

        Swal.fire({

            icon: 'success',

            title: 'Berhasil',

            text: 'Data layanan berhasil dihapus.',

            confirmButtonColor: '#198754'

        }).then(function(){

            window.location = 'index.php';

        });

        </script>

        </body>
        </html>
        <?php

    } else {

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Gagal</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </head>
        <body>

        <script>

        Swal.fire({

            icon: 'error',

            title: 'Gagal',

            text: 'Data layanan gagal dihapus.',

            confirmButtonColor: '#dc3545'

        }).then(function(){

            window.location = 'index.php';

        });

        </script>

        </body>
        </html>
        <?php

    }

} else {

    header("Location:index.php");

}
?>