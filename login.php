<?php
require("init.php");

if (!empty($_SESSION)) {
    header("Location: tampilkan_barang.php");
    die;
}

$user = new User();

if (!empty($_POST)) {
    $pesan_error = $user->validasiLogin($_POST);
    if (empty($pesan_error)) {
        $user->login();
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <link rel="stylesheet" href="../css/style.css">
</head>

<style>
    body {
        background-color: #F0F2F5;
    }

    .container {
        margin-top: 100px;
    }
</style>

<body>
    <div class="container d-flex align-items-center justify-content-around mt-5">

        <div class="kiri mt-3">
            <h1 class="mt-5">Aplikasi Stock Manager</h1>
            <p>Kelola Seluruh Operasi Gudang & Fulfillment dengan Satu Platform</p>
        </div>

        <div class="kanan w-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-9">

                        <div class="card shadow">
                            <!-- jika ada error, tampilkan pesan error -->
                            <?php
                            if (!empty($pesan_error)) :
                            ?>

                                <div id="divPesanError" class="container w-100 float" style="margin-top: 10px; margin-bottom: -22px;">
                                    <div class="">
                                        <div class="alert alert-danger" role="alert">
                                            <ul class="mb-0">
                                                <?php
                                                foreach ($pesan_error as $pesan) {
                                                    echo "<li style='list-style : none;'>$pesan</li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            endif;
                            ?>
                            <div class="card-body">
                                <form method="post">
                                    <div class="mb-2">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="mb-1">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary py-2 w-100 mt-3">Log in</button>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a href="buat_akun.php" class="btn btn-success py-2 w-50">Buat Akun</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<footer>

</footer>