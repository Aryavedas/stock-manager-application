<?php
try {
    mysqli_report(MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost", "", "", "");

    // Cek Database Stockk_manager Apakah Tersedia
    $mysqli->select_db("stock_manager");
    if ($mysqli->error) {
        throw new Exception();
    }

    // Cek Tabel Barang Apakah Tersedia
    $query = "SELECT 1 FROM barang";
    $mysqli->query($query);
    if ($mysql->error) {
        throw new Exception();
    }

    // Cek Tabel user Apakah Tersedia
    $query = "SELECT 1 FROM user";
    $mysqli->query($query);
    if ($mysql->error) {
        throw new Exception();
    }

    // Tutup Koneksi Mysql
    if (isset($mysqli)) {
        $mysqli->close();
    }
} catch (Exception $th) {
?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <link rel="stylesheet" href="/css/style.css">
    </head>

    <body>
        <div class="container" class="py-5">
            <div class="row">
                <div class="col-12 py-4 mx-auto text-center">
                    <h3 class="mt-5">
                        Selamat datang di Aplikasi <strong>Stock Manager</strong>
                    </h3>
                    <hr class="w-50 mx-auto">
                    <p class="lead mt-5">Sistem kami mendeteksi database /
                        tabel belum tersedia, apakah ingin dibuat sekarang?</p>
                    <a href="generate_tabel_barang_user.php" class="btn btn-info text-white">Ya</a>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
}
