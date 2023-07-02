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
    <div class="container">
        <div class="row align-center">
            <h2>Generate database</h2>
            <ul>
                <?php
                try {
                    // Connect Ke Database
                    $mysqli = new mysqli("localhost", "", "", "");

                    // Membuat Database Jika Tidak Ada
                    $query = "CREATE DATABASE IF NOT EXISTS stock_manager";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->errno . $mysqli->error);
                    } else {
                        echo "<li>Database Berhasil Di Buat</li>";
                    }

                    // Pilih Database
                    $mysqli->select_db("stock_manager");
                    if ($mysqli->error) {
                        throw new Exception($mysqli->errno . $mysqli->error);
                    } else {
                        echo "<li>Database Berhasil Di Pilih</li>";
                    }

                    // Hapus Table Barang Jika Ada
                    $query = "DROP TABLE IF EXISTS barang";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysql->error . $mysqli->errno);
                    }

                    // Buat Table "Barang" Jika Tidak Ada
                    $query = "CREATE TABLE IF NOT EXISTS barang(
                            id_barang      INT PRIMARY KEY AUTO_INCREMENT,
                            nama_barang    VARCHAR(50),
                            jumlah_barang  INT,
                            harga_barang   DEC,
                            path VARCHAR(255),
                            tanggal_update TIMESTAMP
                            )";
                    $mysqli->query($query);
                    if ($mysqli->error) { //Validasi
                        throw new Exception($mysqli->errno . $mysqli->error);
                    } else {
                        echo "<li>Table Barang Berhasil Di Buat</li>";
                    }

                    // Isi Table Barang
                    $sekarang  = new DateTime("now", new DateTimeZone("asia/jakarta"));
                    $timestamp = $sekarang->format("Y-m-d H:i:s");

                    $query     = "INSERT INTO barang (nama_barang, jumlah_barang, harga_barang ,path ,tanggal_update) VALUES
                                    ('Solar Panel', 10, 20000 ,'img/SPRO095.png' ,'$timestamp'),
                                    ('Pemetik Buah Buahan', 10 ,20000 , 'img/didihou-jaring-net-pemetik-buah-garden-fruit-picker-collection-head-a48.jpg','$timestamp'),
                                    ('Pisau Dapur', 10, 30000 , 'img/pisau_dapur.png' ,'$timestamp')";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error . $mysqli->errno);
                    } else {
                        echo "<li>Mengisi Table Barang Berhasil {$mysqli->affected_rows} Baris Data Berhasil Di Tambah Kan</li>";
                    }

                    // Hapus Table User Jika Ada
                    $query = "DROP TABLE IF EXISTS user";
                    $mysqli->query($query);
                    if ($mysqli->error) { //Validasi
                        throw new Exception($mysqli->errno . $mysqli->error);
                    }

                    //Buat Table User
                    $query = "CREATE TABLE user (
                        username VARCHAR(50) PRIMARY KEY,
                        password VARCHAR(255),
                        email VARCHAR(100)
                        )";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error, $mysqli->errno);
                    } else {
                        echo "<li>Table User Berhasil Di Buat</li>";
                    }

                    // Isi Table User
                    $passwordAdmin = password_hash('rahasia', PASSWORD_DEFAULT);
                    $query = "INSERT INTO user (username, password, email) VALUES
                    ('admin','$passwordAdmin','admin@gmail.com');";
                    $mysqli->query($query);
                    if ($mysqli->error) {
                        throw new Exception($mysqli->error, $mysqli->errno);
                    } else {
                        echo "<li>Table User Berhasil Di Isi {$mysqli->affected_rows} Data Telah Di Tambahkan</li>";
                    }
                } catch (Exception $th) {
                    die("<b>Kesalahan Query / Koneksi Dengan Database Gagal</b>" . $th->getMessage());
                } finally {
                    if (isset($mysqli)) {
                        $mysqli->close();
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>